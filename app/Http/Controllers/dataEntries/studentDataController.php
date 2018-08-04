<?php


namespace App\Http\Controllers\dataEntries;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\validation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\AccountDataModel\studentData;
use Illuminate\Support\Facades\SycosFunctions;

class studentDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            return view('forms.student.form');
        }else{
            return redirect('/login')->with("error",'Please Login Again');
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
    public function store(Request $data)
    {
        if(strcmp(Auth::user()->usertype,'Student')==0){
	
            $this->validation($data)->validate();
            $userId = Auth::user()->id;
            $status = '1';
            $subjectString = SycosFunctions::ArryaToString($data['subjects']);
            $classString = SycosFunctions::ArryaToString($data['class']);
            $profilePage =  Auth::user()->name;

            $SerialNoInStudentTable = DB::table('studenttable')->where('user_id', $userId)->first()->id;
            if($data->hasFile('profile_img')){
                $fileNameWithExt = $data->file('profile_img')->getClientOriginalName();
                
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $data->file('profile_img')->getClientOriginalExtension();
            
                $NameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $data->file('profile_img')->storeAs('public/profileImage',$NameToStore);
            }else{
                $NameToStore = 'default.png';
            }


            $dataInTable = studentData::find($SerialNoInStudentTable);
                
                $dataInTable->studentName = $data->input('Name');
                
                $dataInTable->age = $data->input('age');
                $dataInTable->subjects = $subjectString;
                $dataInTable->classes = $classString;
                $dataInTable->address = $data->input('address');
                $dataInTable->contactNo = $data->input('contactNo');
                $dataInTable->area = $data->input('locality');
                $dataInTable->pincode = $data->input('pincode');
                $dataInTable->state = $data->input('state');
                $dataInTable->description = $data->input('description');
                $dataInTable->imageLink = $NameToStore;
                $dataInTable->status = '1';
               // $dataInTable->status = '0';//$data->input('status');
                
                
                $dataInTable->save();

            return redirect('/profile/'.$profilePage)->with('success','Your Account is created');
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
        if(strcmp(Auth::user()->usertype,'Student')==0){
            
            $this->validationUpdate($data)->validate();
            $userId = Auth::user()->id;
            $profilpage = Auth::user()->name;
            
            $SerialNoInTeacherTable = DB::table('studenttable')->where('user_id', $id)->first()->id;
            $subjectString =  SycosFunctions::ArryaToString($data->input('subjects'));
            $classString =  SycosFunctions::ArryaToString($data->input('class'));
            if($data->hasFile('profile_img')){
                $fileNameWithExt = $data->file('profile_img')->getClientOriginalName();
                
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $data->file('profile_img')->getClientOriginalExtension();
            
                $NameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $data->file('profile_img')->storeAs('public/profileImage',$NameToStore);
            }else{
                $NameToStore = 'default.png';
            }


            if($data->input('status') == "on"){
                $Tstatus = "1";
                
            }else{
                $Tstatus = "0";
            }

            $dataInTable = studentData::find($SerialNoInTeacherTable);
                
                $dataInTable->studentName = $data->input('Name');
                $dataInTable->age = $data->input('age');
                $dataInTable->subjects = $subjectString;
                $dataInTable->classes = $classString;
                $dataInTable->address = $data->input('address');
                $dataInTable->contactNo = $data->input('contactNo');
                $dataInTable->area = $data->input('locality');
                $dataInTable->pincode = $data->input('pincode');
                $dataInTable->state = $data->input('state');
                $dataInTable->description = $data->input('description');
                $dataInTable->imageLink = $NameToStore;
                $dataInTable->status = $status;
               // $dataInTable->status = '0';//$data->input('status');
                
                
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
            'Name' => 'required|string|max:255|min:3',
            'age' => 'required|numeric|max:99|min:2',
            'subjects' => 'required|array',
            'class' => 'required|array',
            'address' => 'required|String|max:255|min:3',
            'contactNo' => 'required|numeric|min:7777777777|max:9999999999',
            'locality' => 'required|string|max:255|min:3',
            'pincode' => 'required|numeric|min:100001|max:999999 ',
            'state' => 'required|string|max:20|min:3',
            'description' => 'max:255|min:0',
        ]);
    }

    public function validation(Request $request){
        return Validator::make($request->all(), [
            'Name' => 'required|string|max:255|min:3',
            'age' => 'required|numeric|max:99|min:2',
            'subjects' => 'required|array',
            'class' => 'required|array',
            'address' => 'required|String|max:255|min:3',
            'contactNo' => 'required|numeric|min:7777777777|max:9999999999',
            'locality' => 'required|string|max:255|min:3',
            'pincode' => 'required|numeric|min:100001|max:999999 ',
            'Email' => 'required|string|email|max:255|exists:signup',
            'state' => 'required|string|max:20|min:3',
            'description' => 'max:255|min:0',
        ]);
    }
}
