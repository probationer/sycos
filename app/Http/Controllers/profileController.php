<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\singup;

use App\AccountDataModel\teacherData;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            return redirect('/profile/'.Auth::user()->name);
        }else{
            return redirect('/');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name){
        if(DB::table('signup')->where('name', $name)->first()){
            $id = DB::table('signup')->where('name', $name)->first()->id;
        }else{
            return 'profile not exists';
        }

        if(singup::find($id)){
            $details = singup::find($id);
            $type = $details->usertype;
            $email = $details->email;

            $tab = 'detail';
            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $data = DB::table('studenttable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.Student.'.$tab)->with('userData',$array);
                break;

                case 'Teacher':

                    $data = DB::table('teachertable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.Teacher.'.$tab)->with('userData',$array);
                    
                    
                break;

                case 'Coaching Institute':
                    $data = DB::table('coachingtable')->where('user_id', $id)->first();

                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.Institute.'.$tab)->with('userData',$array);
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.Guardian.'.$tab)->with('userData',$array);
                break;

                default:
                    return redirect('/');
                break;
            }

        }else{
            return redirect('/');
        }

    }

    public static function checkEmailVeified(){
        if(Auth::user()){
            if(DB::table('account_verifications')->where('email',Auth::user()->email)->first()){
                if(DB::table('account_verifications')->where('email',Auth::user()->email)->first()->verified){
                    return '1';
                }else{
                    return '0';
                } 
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        
        if(DB::table('signup')->where('name', $name)->first()){

            if(!Auth::user()){
                return redirect('/login');
            }
            
            $data = DB::table('signup')->where('name', $name)->first();
            $type = $data->usertype;
            $id = $data->id;

            $userId = Auth::user()->id;
            if($userId!=$id){
                return redirect('/profile/'.$userId);
            }

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $data = DB::table('studenttable')->where('user_id', $id)->first();
                    return view('forms.student.updateForm')->with('userData',$data);
                break;

                case 'Teacher':

                    $data = DB::table('teachertable')->where('user_id', $id)->first();
                    return view('forms.teacher.updateForm')->with('userData',$data);
                break;

                case 'Coaching Institute':
                    $data = DB::table('coachingtable')->where('user_id', $id)->first();
                    return view('forms.coaching.updateForm')->with('userData',$data);
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    return view('functional.profile.guardianProfile')->with('userData',$data);
                break;

                default:
                    return redirect('/');
                break;
            }

        }else{
            return redirect('/');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userTypeByUserName($data){
    }

    public function setting($name){
        if(DB::table('signup')->where('name', $name)->first()){
            $id = DB::table('signup')->where('name', $name)->first()->id;
        }else{
            return 'profile not exists';
        }

        if(singup::find($id)){
            $details = singup::find($id);
            $type = $details->usertype;
            $email = $details->email;

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $data = DB::table('studenttable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.setting')->with('userData',$array);
                break;

                case 'Teacher':

                    $data = DB::table('teachertable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.setting')->with('userData',$array);
                    
                    
                break;

                case 'Coaching Institute':
                    $data = DB::table('coachingtable')->where('user_id', $id)->first();

                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.setting')->with('userData',$array);
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.setting')->with('userData',$array);
                break;

                default:
                    return redirect('/');
                break;
            }

        }else{
            return redirect('/');
        }
        
    }

    public function request($name){
        if(DB::table('signup')->where('name', $name)->first()){
            $id = DB::table('signup')->where('name', $name)->first()->id;
        }else{
            return 'profile not exists';
        }

        if(singup::find($id)){
            $details = singup::find($id);
            $type = $details->usertype;
            $email = $details->email;

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $data = DB::table('studenttable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.request')->with('userData',$array);
                break;

                case 'Teacher':

                    $data = DB::table('teachertable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.request')->with('userData',$array);
                    
                    
                break;

                case 'Coaching Institute':
                    $data = DB::table('coachingtable')->where('user_id', $id)->first();

                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.request')->with('userData',$array);
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.request')->with('userData',$array);
                break;

                default:
                    return redirect('/');
                break;
            }

        }else{
            return redirect('/');
        }
    }


    public function pageTabs($name,$tab){
        if(DB::table('signup')->where('name', $name)->first()){
            $id = DB::table('signup')->where('name', $name)->first()->id;
        }else{
            return 'profile not exists';
        }

        if(singup::find($id)){
            $details = singup::find($id);
            $type = $details->usertype;
            $email = $details->email;

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $data = DB::table('studenttable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    if($tab == 'detail'){
                        return view('functional.profile.Student.'.$tab)->with('userData',$array);
                    }else{
                        return view('functional.profile.common.'.$tab)->with('userData',$array);
                    }
                    
                break;

                case 'Teacher':

                    $data = DB::table('teachertable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    if($tab == 'detail'){
                        return view('functional.profile.Teacher.'.$tab)->with('userData',$array);
                    }else{
                        return view('functional.profile.common.'.$tab)->with('userData',$array);
                    }
                    //return view('functional.profile.teacherProfile')->with('userData',$array);
                    
                    
                break;

                case 'Coaching Institute':
                    $data = DB::table('coachingtable')->where('user_id', $id)->first();

                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    if($tab == 'detail'){
                        return view('functional.profile.Institute.'.$tab)->with('userData',$array);
                    }else{
                        return view('functional.profile.common.'.$tab)->with('userData',$array);
                    }
                   // return view('functional.profile.coachingProfile')->with('userData',$array);
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$details->usertype];
                    return view('functional.profile.guardianProfile')->with('userData',$array);
                break;

                default:
                    return redirect('/');
                break;
            }

        }else{
            return redirect('/');
        }
    }
}
