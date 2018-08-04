<?php

namespace App\Http\Controllers\dataEntries;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\validation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\SycosFunctions;
use App\AccountDataModel\coachingData;


class coachingDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            return view('forms.coaching.form');
        }else{
            return redirect('/login');
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
        if(strcmp(Auth::user()->usertype,'Coaching Institute')==0){
	
            $this->validation($data)->validate();
            $userId = Auth::user()->id;
            $status = '1';
            $subjectString =  SycosFunctions::ArryaToString($data['subjects']);
            $classString =  SycosFunctions::ArryaToString($data['classes']);
            
            if($data->hasFile('profile_img')){
                $fileNameWithExt = $data->file('profile_img')->getClientOriginalName();
                
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $data->file('profile_img')->getClientOriginalExtension();
            
                $NameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $data->file('profile_img')->storeAs('public/profileImage',$NameToStore);
            }else{
                $NameToStore = 'banner.png';
            }

            $profilePage =  Auth::user()->name;
            coachingData::create([
                'user_id' => $userId,
                'Institute_name' => $data['Institute-Name'],
                'head_of_institute' => $data['Head-of-institute'],
                'address' => $data['Address-of-institute'],
                'subjects' => $subjectString,
                'classes' =>$classString,
                'opening_year'=>$data['opening-year'],
                'contactNo' => $data['contactNo'],
                'location' => $data['locality'],
                'pincode' => $data['pincode'],
                'status' => $status,
                'landmark' => $data['landmark'],
                'location' => $data['location'],
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
    public function validation(Request $request){
        return Validator::make($request->all(), [
            'Institute-Name' => 'required|string|max:255|min:3',
            'Head-of-institute' => 'required|string|max:255|min:3',
            'Address-of-institute' => 'required|string|max:255|min:2',
            'landmark' => 'required|string|max:7|min:4',
            'subjects' => 'required|array',
            'classes' => 'required|array',
            'opening-year' => 'required|numeric|max:2018',
            'contactNo' => 'required|numeric|min:7777777777|max:9999999999',
            'location' => 'required|string|max:255|min:3',
            'pincode' => 'required|numeric|min:100001|max:999999 ',
            'landmark' => 'required|string|max:255|min:2',
            'state' => 'required|string|max:20|min:3',
            'description' => 'max:255|min:0',
        ]);
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
        if(strcmp(Auth::user()->usertype,'Coaching Institute')==0){
            
            $this->validation($data)->validate();
            $userId = Auth::user()->id;
            $profilpage = Auth::user()->name;
            
            $SerialNoInTeacherTable = DB::table('coachingtable')->where('user_id', $id)->first()->id;
            $subjectString =  SycosFunctions::ArryaToString($data->input('subjects'));
            $classString =  SycosFunctions::ArryaToString($data->input('classes'));

            if($data->hasFile('profile_img')){
                $fileNameWithExt = $data->file('profile_img')->getClientOriginalName();
                
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $data->file('profile_img')->getClientOriginalExtension();
            
                $NameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $data->file('profile_img')->storeAs('public/profileImage',$NameToStore);
            }else{
                $NameToStore = 'banner.png';
            }
            
            $dataInTable = coachingData::find($SerialNoInTeacherTable);
                
                $dataInTable->Institute_name = $data->input('Institute-Name');
                $dataInTable->head_of_institute = $data->input('Head-of-institute');
                $dataInTable->address = $data->input('Address-of-institute');
                $dataInTable->subjects = $subjectString;
                $dataInTable->classes = $classString;
                $dataInTable->location = $data->input('location');
                $dataInTable->contactNo = $data->input('contactNo');
                $dataInTable->pincode = $data->input('pincode');
                $dataInTable->landmark = $data->input('landmark');
                $dataInTable->state = $data->input('state');
                $dataInTable->description = $data->input('description');
                $dataInTable->imageLink = $NameToStore;
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

    
}
