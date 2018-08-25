<?php
//https://www.youtube.com/watch?v=vBzg0Us5MDk
namespace App\Http\Controllers\dataEntries;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\validation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\AccountDataModel\teacherData;
use Illuminate\Support\Facades\SycosFunctions;

class teacherDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.teacher.form')->with('title','Teacher Profile');
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
    public function store(Request $data)
    {

        if(strcmp(Auth::user()->usertype,'Teacher')==0){
	
            $this->validation($data)->validate();
            $userId = Auth::user()->id;
            $status = '1';
            $subjectString =  SycosFunctions::ArryaToString($data['subjects']);
            $classString =  SycosFunctions::ArryaToString($data['class']);
            
            if($data->hasFile('profile_img')){
                $fileNameWithExt = $data->file('profile_img')->getClientOriginalName();
                
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $data->file('profile_img')->getClientOriginalExtension();
            
                $NameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $data->file('profile_img')->storeAs('public/profileImage',$NameToStore);
            }else{
                $NameToStore = 'default.png';
            }

            $profilePage =  Auth::user()->name;
            teacherData::create([
                'user_id' => $userId,
                'first_name' => $data['fname'],
                'last_name' => $data['lname'],
                'qualifications' => $data['qualifications'],
                'sex' => $data['sex'],
                'age' => $data['age'],
                'subjects' => $subjectString,
                'classes' =>$classString,
                'experience' => $data['exp'],
                'contact' => $data['contactNo'],
                'locations' => $data['locations'].',',
                'pincode' => $data['pincode'],
                'status' => $status,
                'pursuing' => $data['Pursuing'],
                'state' => $data['state'],
                'description' => $data['description'],
                'imageLink' => $NameToStore,
                'profilePage' =>$profilePage,
                
            ]);
            return redirect('/profile/'.$profilePage);//->with('Your Account is created');
        }else{
            return redirect('/login')->with('please login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        
        if(strcmp(Auth::user()->usertype,'Teacher')==0){
            
            $this->validation($data)->validate();
            $userId = Auth::user()->id;
            $profilpage = Auth::user()->name;

            if($data->input('status') == "on"){
                $Tstatus = "1";
                
            }else{
                $Tstatus = "0";
            }
            
            $TeacherTableContent = DB::table('teachertable')->where('user_id', $id)->first();
            $subjectString =  SycosFunctions::ArryaToString($data->input('subjects'));
            $classString =  SycosFunctions::ArryaToString($data->input('class'));
            
            if($data->hasFile('profile_img')){
                $fileNameWithExt = $data->file('profile_img')->getClientOriginalName();
                
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $data->file('profile_img')->getClientOriginalExtension();
            
                $NameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $data->file('profile_img')->storeAs('public/profileImage',$NameToStore);
            }else{
                $NameToStore = $TeacherTableContent->imageLink;
            }

                $dataInTable = teacherData::find($TeacherTableContent->id);
                
                $dataInTable->first_name = $data->input('fname');
                $dataInTable->last_name = $data->input('lname');
                $dataInTable->qualifications = $data->input('qualifications');
                $dataInTable->sex = $data->input('sex');
                $dataInTable->age = $data->input('age');
                $dataInTable->subjects = $subjectString;
                $dataInTable->classes = $classString;
                $dataInTable->experience = $data->input('exp');
                $dataInTable->contact = $data->input('contactNo');
                $dataInTable->locations = $data->input('locations').',';
                $dataInTable->pincode = $data->input('pincode');
                $dataInTable->pursuing = $data->input('Pursuing');
                $dataInTable->state = $data->input('state');
                $dataInTable->description = $data->input('description');
                $dataInTable->imageLink = $NameToStore;
                $dataInTable->status = $Tstatus;
                
                
                $dataInTable->save();
                
            return redirect('/profile/'.$profilpage)->with('success','Your profile has been updated');

        }else{
            return redirect('/login')->with('please login');
        }

        
        
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

    public function validationUpdate(Request $request){
        return Validator::make($request->all(), [
            'fname' => 'required|string|max:255|min:3',
            'lname' => 'required|string|max:255|min:3',
            'qualifications' => 'required|string|max:255|min:2',
            'sex' => 'required|string|max:7|min:4',
            'age' => 'required|numeric|max:99|min:16',
            'subjects' => 'required|array',
            'class' => 'required|array',
            'exp' => 'required|numeric|max:99',
            'contactNo' => 'required|numeric|min:7777777777|max:9999999999',
            'locations' => 'required|string|max:255|min:3',
            'pincode' => 'required|numeric|min:100001|max:999999 ',
            'Pursuing' => 'required|string|max:255|min:2',
            'state' => 'required|string|max:20|min:3',
            'description' => 'max:255|min:0',
            
        ]);
    }

    public function validation(Request $request){
        return Validator::make($request->all(), [
            'fname' => 'required|string|max:255|min:3',
            'lname' => 'required|string|max:255|min:3',
            'qualifications' => 'required|string|max:255|min:2',
            'sex' => 'required|string|max:7|min:4',
            'age' => 'required|numeric|max:99|min:16',
            'subjects' => 'required|array',
            'class' => 'required|array',
            'exp' => 'required|numeric|max:99',
            'contactNo' => 'required|numeric|min:7777777777|max:9999999999',
            'locations' => 'required|string|max:255|min:3',
            'pincode' => 'required|numeric|min:100001|max:999999 ',
            'Pursuing' => 'required|string|max:255|min:2',
            'state' => 'required|string|max:20|min:3',
            'description' => 'max:255|min:0',
            'profile_img'=>'image|nullable|max:19999',
        ]);
    }

}
