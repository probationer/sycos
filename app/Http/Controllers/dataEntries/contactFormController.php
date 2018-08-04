<?php

namespace App\Http\Controllers\dataEntries;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\validation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\SycosFunctions;
use App\AccountDataModel\coachingData;
use App\studentContactModel;
use App\TeachingContactModel;
use App\Http\Controllers\profileController;

class contactFormController extends Controller
{
    public function showStudentForm($name){

        if(DB::table('signup')->where('name', $name)->exists() && Auth::user()){

            if(!Auth::user()){
                return redirect('/profile/'.$name)->with('login','Please Login to sendRequest');
            }
            $userDataSignup = DB::table('signup')->where('name', $name)->first();
            
            $type = $userDataSignup->usertype;
            $id = $userDataSignup->id;

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $data = DB::table('studenttable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$type];
                    return view('forms.contactForm.studentContactForm')->with('userData',$array);

                break;

                default:
                    return redirect('/');
                break;
            }

        }else{
            return redirect('/profile/');
        }
        
    }

    public function storeDataStudent(Request $request,$page){
        if(!Auth::user()){
            return redirect('/login');
        }

        $this->validate($request ,[
            'name'=>'required',
            'class'=>'required',
            'subjects'=>'required',
            'charges'=>'required|integer',
            'message'=>'max:127'
        ]);


        if(DB::table('signup')->where('name', $page)->first()){
            $data = DB::table('signup')->where('name', $page)->first();
            $type = $data->usertype;
            $id = $data->id;


            $subjectString =  SycosFunctions::ArryaToString($request['subjects']);
            $classString =  SycosFunctions::ArryaToString($request['class']);

            studentContactModel::create([
                'profilePage' => $page,
                'requesterUserId' => Auth::user()->id,
                'requesterName' => $request['name'],
                'class' => $subjectString,
                'subjects' => $classString,
                'charges' => $request['charges'],
                'message' => $request['message'],
                'viewed' =>'0',
            ]);

            return redirect('/profile/'.$page)->with('success',"Contact information is send");

        }
    }

    public function showTeachersForm($name){
        if(DB::table('signup')->where('name', $name)->exists()){

            if(!Auth::user()){
                return redirect('/profile/'.$name)->with('login','Please Login to sendRequest');
            }

            $userDataSignup = DB::table('signup')->where('name', $name)->first();
            $type = $userDataSignup->usertype;
            $id = $userDataSignup->id;

            switch($type){
                case 'Teacher':
                    //return $data->usertype;
                    $data = DB::table('teachertable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$type];
                    return view('forms.contactForm.teacher_inttitute_contact_form')->with('userData',$array);
                break;

                case 'Coaching Institute':
                    //return $data->usertype;
                    $data = DB::table('coachingtable')->where('user_id', $id)->first();
                    $array = ['detail'=>$data,'verified'=>profileController::checkEmailVeified(),'type'=>$type];
                    return view('forms.contactForm.teacher_inttitute_contact_form')->with('userData',$array);
                break;

                default:
                    return redirect('/');
                break;
            }

        }else{
            return redirect('/');
        }
    }

    public function storeDataTeacher(Request $request,$page){
        if(!Auth::user()){
            return redirect('/login');
        }

        $this->validate($request ,[
            'Student_Name'=>'required',
            'class'=>'required',
            'subjects'=>'required',
            'budget'=>'required|integer',
            'area' => 'required|max:30',
            'message'=>'max:128'
        ]);


        if(DB::table('signup')->where('name', $page)->first()){
            $data = DB::table('signup')->where('name', $page)->first();
            $type = $data->usertype;
            $id = $data->id;


            $subjectString =  SycosFunctions::ArryaToString($request['subjects']);
            $classString =  SycosFunctions::ArryaToString($request['class']);

            TeachingContactModel::create([
                'profilePage' => $page,
                'requesterUserId' => Auth::user()->id,
                'requesterName' => $request['Student_Name'],
                'class' => $subjectString,
                'subjects' => $classString,
                'Budget' => $request['budget'],
                'area' => $request['area'],
                'message' => $request['message'],
                'viewed' =>'0',
            ]);

            return redirect('/profile/'.$page)->with('success',"Contact information is send");

        }
    }

    public function showDataTeacher($en_link){

        $id = SycosFunctions::En_De_crypt($en_link,'d');
       
        $userData = TeachingContactModel::find($id);
        $userData->viewed ='1';
        $userData->save();


        $type = DB::table('signup')->where('id',$userData->requesterUserId)->first()->usertype;
        switch($type){
            case 'Student':
                //return $data->usertype;
                $data = DB::table('studenttable')->where('user_id',$userData->requesterUserId)->first();
                $detail = ['name'=>$data->studentName,'contactNo'=>$data->contactNo,'type'=>$type,'imageLink'=>$data->imageLink,'profile'=>$data->profilePage];
                $array = ['detail'=>$detail,'cardDetail'=>$userData,'title'=>$data->studentName];
                return view('functional.contactCard.teacherData')->with('userData',$array);
            break;

            default:
                return redirect('/');
            break;
        }

        //return view('functional.contactCard.teacherData')->with('userData',$userData);
    }

    public function showDataStudent($en_link){

        $id = SycosFunctions::En_De_crypt($en_link,'d');
       
        $userData = studentContactModel::find($id);
        $userData->viewed ='1';
        $userData->save();

        $type = DB::table('signup')->where('id',$userData->requesterUserId)->first()->usertype;
        switch($type){
            case 'Teacher':
                //return $data->usertype;
                $data = DB::table('teachertable')->where('user_id',$userData->requesterUserId)->first();
                $detail = ['name'=>$data->first_name,'contactNo'=>$data->contact,'type'=>$type,'imageLink'=>$data->imageLink,'profile'=>$data->profilePage];
                $array = ['detail'=>$detail,'cardDetail'=>$userData,'title'=>$data->first_name];
                return view('functional.contactCard.studentData')->with('userData',$array);
            break;

            case 'Coaching Institute':
                //return $data->usertype;
                $data = DB::table('coachingtable')->where('profilePage',$userData->profilePage)->first();
                $detail = ['name'=>$data->institute_Name,'contactNo'=>$data->contactNo,'type'=>$type,'imageLink'=>$data->imageLink,'profile'=>$data->profilePage];
                $array = ['detail'=>$data,'cardDetail'=>$userData,'title'=>$data->institute_Name];
                return view('functional.contactCard.studentData')->with('userData',$array);
            break;

            default:
                return redirect('/');
            break;
        }

        $data = DB::table('studenttable')->where('profilePage',$userData->profilePage)->first();
        $array = ['detail'=>$data,'cardDetail'=>$userData,'title'=>$data->studentName];
        
    }
}