<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\validation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\singup;
use App\account_verification;
use App\AccountDataModel\teacherData;
use App\AccountDataModel\studentData;
use App\AccountDataModel\coachingData;
use Illuminate\Support\Facades\Mail;
use App\Mail\SycosMail;
use App\feedbackModel;
use App\article;
use App\Content_group;
use File;

class SycosAuthController extends Controller
{
    public function showRegistrationForm(){
        return view('Auth_sycos.signup');
    }

    public function submitRegistrationForm(Request $data){
        
        $this->validation($data)->validate();
        
        User::create([
            'name' => $data['name'],
            'usertype' => $data['usertype'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'articlePrivacy'=>'0',
            'videoPrivacy'=>'0',
            'commentPrivacy'=>'0',
        ]);

        $code =  rand(10,10000);
        
        account_verification::create([
            'email' => $data['email'],
            'verification_code' =>$code,
            'verified' => '0',
        ]);

        $this->sendMail($data['email'],$code);
        
        return $this->Login_Redirect_AccountForm($data);

        
        //return redirect('/')->with('Success','You are registered!');
        //$data->all();
    }


    //after registration of user this will dectect and account type and direct 
    // to its appropirate form.

    public function Login_Redirect_AccountForm($data){

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $type = $data['usertype'];
            switch($type){
                case 'Student':
                    //return $data->usertype;
                    studentData::create([
                        'user_id' =>Auth::user()->id,
                        'profilePage'=>$data['name'],
                    ]);
                    return redirect('/studentForm');//->with('userData',$data);
                break;

                case 'Teacher':
                    teacherData::create([
                        'user_id' =>Auth::user()->id,
                        'profilePage'=>$data['name'],
                    ]);
                    return redirect('/teacherForm');//->with('userData',$data);
                break;

                case 'Coaching Institute':
                    coachingData::create([
                        'user_id' =>Auth::user()->id,
                        'profilePage'=>$data['name'],
                    ]);
                    return redirect('/coachingForm');//->with('userData',$data);
                break;

                case 'Guardian or Parents':
                
                    return view('forms.guardian.form');//->with('userData',$data);
                break;

                default:
                    return redirect('/');
                break;
            }
        }else{
            return redirect('/')->with('Sorry some error happens ! ');
        }

    }

    public function showLoginForm(){
        return view('Auth_sycos.login');
    }

    public function submitLoginForm(Request $data){


        $credentials = $data->only('email', 'password');

        $this->validate($data ,[
            'email'=>'required|email|exists:signup',
            'password'=>'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            /*
            $type = Auth::user()->usertype;

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    return view('forms.student.form');//->with('userData',$data);
                break;

                case 'Teacher':
                
                    return view('forms.teacher.form');//->with('userData',$data);
                break;

                case 'Coaching Institute':
                
                    return view('forms.coaching.form');//->with('userData',$data);
                break;

                case 'Guardian or Parents':
                
                    return view('forms.guardian.form');//->with('userData',$data);
                break;

                default:
                    return redirect('/');
                break;
            }
            */
            return redirect()->intended('profile/'.Auth::user()->name);
        }else{
            return redirect('/login')->with('error','Wrong User email and password combination');
        }
        
        
        
        //$request->all();
    }

    //this function redirect to the current page
    public function submitLoginForm_viaAnyPage(Request $data,$link){

        $credentials = $data->only('email', 'password');

       if(DB::table('signup')->where('name',$link)->exists()){
            $link = '/profile/'.$link;
        }else{
            $link = '/article/'.$link;
        }

        if (Auth::attempt($credentials)) {
            return redirect($link);
        }else{
            return redirect($link)->with('error','Wrong User email and password combination');
        }
    }

    // validation for signup form
    public function validation(Request $request){
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3|unique:signup',
            'usertype' => ['required','string',
                        function($attribute, $value, $fail) {
                            if ($value == 'Student' || $value == 'Parent or Guardian' || $value == 'Coaching Institute' || $value == 'Teacher' ) {
                                
                            }else{
                                return $fail('Invalid Account Type');
                            }
                        }],
            'email' => 'required|string|email|max:255|unique:signup',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function changesetting(Request $request){
       
        
        $PasswordInTable = Auth::user()->password;
       // $parameter[0] = $PasswordInTable;
        $this->validate($request , [
            'password' => 'required|string|min:8|confirmed',
        ]);

            $currentPass = $request['oldPassword'];
            if(password_verify($currentPass,$PasswordInTable)){

                $userData = User::find(Auth::user()->id);
                $userData->password = bcrypt($request['password']);
                $userData->save();

                return redirect('/profile/'.Auth::user()->name.'/setting')->with('report','Password is changed');
             }else{
                return redirect('/profile/'.Auth::user()->name.'/setting' )->with('report','Current Pasword Not Match');
             }
        
        
    }

    public function privacySettings(Request $request){
        $this->validate($request ,[
            'articlePrivacy'=>'required',
            'videoPrivacy'=>'required',
            'commentPrivacy'=>'required'
        ]);

        //update privacy

        if(!Auth::user()){
            return redirect('/login')->with('error','Login to change settings');
        }
        $id = Auth::user()->id;

        $privacy = user::find($id);
        $privacy->articlePrivacy = SycosAuthController::PrivacySettingCheck($request->input('articlePrivacy'));
        $privacy->videoPrivacy = SycosAuthController::PrivacySettingCheck($request->input('videoPrivacy'));
        $privacy->commentPrivacy = SycosAuthController::PrivacySettingCheck($request->input('commentPrivacy'));
            $privacy->save();

            return redirect('profile/'.Auth::user()->name)->with('success','Your privacy setting is updated');
    }

    public function PrivacySettingCheck($input){
        if($input == 'Only Companions'){
            return true;
        }else{
            return false;
        }
    }

    public function VerifyEmail(Request $request){
        
        if(!Auth::user()){
            return redirect('/login')->with('error','Login Before Veification');
        }

        
        $this->validate($request ,[
            'verification_code'=>'required'
        ]);
        
        //check if not verified then show verification Form
        if(DB::table('account_verifications')->where('email',Auth::user()->email)->first()->verified == '0'){
            $id = DB::table('account_verifications')->where('email',Auth::user()->email)->first()->id;

            if(DB::table('account_verifications')->where('email',Auth::user()->email)->first()->verification_code == $request->input('verification_code') ){
                $verify = account_verification::find($id);
                $verify->verified = '1';
                $verify->save();
                
                return redirect('profile/'.Auth::user()->name)->with('success','Your Accoutn is verified. And veification badge is added.');
            }else{
                return redirect('profile/'.Auth::user()->name)->with('error','Verification Code not matched');
            }
            
        }else{
            return redirect('profile/'.Auth::user()->name)->with('error','Already Verified, Please Refresh This Page');
        }
        
    }

    public function resendVerificationCode(Request $request){
        
        if(!Auth::user()){
            return redirect('/login')->with('error','Login Before Veification');
        }

        $userMail = DB::table('signup')->where('id',Auth::user()->id)->first()->email;
        $code =  rand(10,10000);
        
        $verificationID = DB::table('account_verifications')->where('email',$userMail)->first()->id;

        $dataInTable = account_verification::find($verificationID);
        $dataInTable->verification_code = $code;
        $dataInTable->save();

        return SycosAuthController::sendMail($userMail,$code);
    }
    
    public function sendMail($mailId,$code){
        Mail::to($mailId)
              ->send(new SycosMail($code));

            return redirect()->back()->with('report','Verification Code is send');
    }
    public function sendMailDemo(Request $request){
        Mail::to($request->input('email'))
              ->send(new SycosMail('1111'));

            return redirect()->back();
    }

    public function showForm(){
        return view('emails.test');
    }



    //this will match the profilePage and name.signup and change the user id of related table;
    public function matchId(){
        $user = DB::table('signup')->where('usertype','Teacher')->get();

        foreach($user as $v){
            if(DB::table('teachertable')->where('profilePage',$v->name)->exists()){
                $data = teacherData::find(DB::table('teachertable')->where('profilePage',$v->name)->first()->id);

                $data->user_id = DB::table('signup')->where('name',$v->name)->first()->id;
                $data->save();
            }
        }

        return 'success';

    }


    public function feedback(Request $data){

        if(Auth::user()){
            $userid = Auth::user()->id;
        }else{
            $userid = '0';
        }

        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }

        feedbackModel::create([
            'name' => $data['name'],
            'message' => $data['message'],
            'client_ip' => $ip,
            'user_id' =>$userid,
        ]);

        return redirect()->back()->with('success','Thnaks For Feedback');
    }

    public function getUserFiles($fileName){
        $file = Storage::get('/public/profileImage/'.$fileName);
        return new Response($file,200);
    }
    
    public function getPdfFiles($fileName){
        $file = Storage::get('/public/docs/'.$fileName);//storage_path().'/docs/'.$fileName;
        //$file = File::get($path);
        //$type = mime_content_type('storage/docs/'.$fileName);//File::mimeType('storage/docs/'.$fileName);
        $response =new Response($file,200);
        $response->header("Content-Type", 'application/pdf');
        return $response;
    }

    public function createContentGroup(Request $gname){
        $this->validate($gname ,[
            'gname'=>'required|string|unique:content_group|min:3|max:100',
            'tags' => 'max:120',
        ]);
                
        if(Auth::user()){
            try{
                Content_group::create([
                    'user_id' => Auth::user()->id,
                    'gname' =>$gname['gname'],
                    'tags' => $gname['tags'],
                ]);
            }catch(Exception $e){
                return 'Not Proper content ';
            }
            
    
            if($gname['page']=='article'){

                if(DB::table('articles')->where('link',$gname['link'])->exists()){
                    $aid = DB::table('articles')->where('link',$gname['link'])->get()->first()->id;
                    $article = article::find($aid);
                    $article->gname = $gname['gname'];
                    $article->save();
                }
               
            }
            return redirect()->back()->with('success','New group is created and article is added');
        
        }else{
            return redirect()->back()->with('login','Please login');
        }
    }

    public function addContentGroup(Request $gname){
         
        if(Auth::user()){
    
            if($gname['page']=='article'){

                if(DB::table('articles')->where('link',$gname['link'])->exists()){
                    $aid = DB::table('articles')->where('link',$gname['link'])->get()->first()->id;
                    $article = article::find($aid);
                    $article->gname = $gname['group'];
                    $article->save();
                }
            }
            return redirect()->back()->with('success','Article is now added to '.trim($gname['group']).' group');
        
        }else{
            return redirect()->back()->with('login','Please login');
        }
    }

}
