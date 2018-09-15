<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\validation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\SycosFunctions;


class searchController extends Controller
{
    public function search(Request $request){

        if($request->input('query') != NULL){
            
            $statingtime = microtime();
            $actualInput = $request->input('query');
            $inputstring = SycosFunctions::input_validate($request->input('query'));
            
           // $gendersArray = explode(',', SycosFunctions::PutList('sex'));
        
           if(isset($_GET['type'])){
                $type = $_GET['type'];
            }else{
                $type = 'all';
            }


            if(isset($_GET['state'])){
                if($_GET['state']=='None' || $_GET['state']== NULL  ){
                    $FilterState = '%';
                }else{
                    $FilterState = $_GET['state'];
                }
            }else{
                $FilterState = '%';
            }

            $stringArray = explode(' ',$inputstring);
            $stringArray = array_filter($stringArray, "SycosFunctions::checkspace"); //removing the space from the array
            $exceptionWords = array('Garden','Rani','garden','GARDEN','nagar','NAGAR','Nagar','colony','COLONY','Colony','Park','park','PARK');
            
            $search_table_name = array('coachingtable','teachertable','studenttable','state');
            $coloumArray_coachingtable = array('Institute_name','address','location','landmark','subjects','classes','state');
            $coloumArray_teachertable = array('first_name','last_name','qualifications','sex','subjects','classes','state');
            $coloumArray_studnetTable = array('studentName','subjects','classes','area','state');
        
            $dataReturnTeacher = array();
            $dataReturnStudent = array();
            $dataReturnCoaching = array();


            switch ($type){
                case 'Students':
                    $dataReturnStudent = searchController::studentSearch($stringArray,$coloumArray_studnetTable,$FilterState);
                    break;
                
                case 'Institutes':
                    $dataReturnCoaching = searchController::coachingSearch($stringArray,$coloumArray_coachingtable,$FilterState);
                    break;
                
                case 'Teachers':
                    $dataReturnTeacher = searchController::teacherSearch($stringArray,$coloumArray_teachertable,$FilterState);
                    break;
                
                case 'all':
                    $dataReturnStudent = searchController::studentSearch($stringArray,$coloumArray_studnetTable,$FilterState);
                    $dataReturnTeacher = searchController::teacherSearch($stringArray,$coloumArray_teachertable,$FilterState);
                    $dataReturnCoaching = searchController::coachingSearch($stringArray,$coloumArray_coachingtable,$FilterState);
                    break;
                default :
                    $dataReturnStudent = searchController::studentSearch($stringArray,$coloumArray_studnetTable,$FilterState);
                    $dataReturnTeacher = searchController::teacherSearch($stringArray,$coloumArray_teachertable,$FilterState);
                    $dataReturnCoaching = searchController::coachingSearch($stringArray,$coloumArray_coachingtable,$FilterState);
                break;
            }


            $UserIdArray = array();
            foreach($dataReturnTeacher as $v){
                array_push($UserIdArray, $v->user_id);
            }

            foreach($dataReturnStudent as $v){
                array_push($UserIdArray, $v->user_id);
            }

            foreach($dataReturnCoaching as $v){
                array_push($UserIdArray, $v->user_id);
            }
            
            $SortedArray = array_count_values($UserIdArray);
           // print_r($SortedArray);
            arsort($SortedArray);

            $finalArray = array_keys($SortedArray);
            $checkArray = array();
            $dataReturn =array();

            $typeWithUser_id = array();
            //print_r($finalArray);

            $dataReturn['student'] = $dataReturnStudent;
            $dataReturn['institute'] = $dataReturnCoaching;
            $dataReturn['teacher'] = $dataReturnTeacher;

            if(count($finalArray)>0){
                foreach($finalArray as $f){
                    if(!(in_array($f, $checkArray))){
                        array_push($checkArray, $f);
                        $type = DB::table('signup')->where('id',$f)->first()->usertype;
                        switch ($type){
                            case 'Student':
                                $typeWithUser_id[$f] = 'Student';
                                break;
                            
                            case 'Coaching Institute':
                                $typeWithUser_id[$f] = 'Institute';
                                break;
                            
                            case 'Teacher':
                                $typeWithUser_id[$f] = 'Teacher';
                                break;
                            
                            default :
                                break;
                        }

                    }
                    
                }
                $dataReturn['UserIdLIst'] = $typeWithUser_id;
                $dataReturn['query'] = $actualInput;
                return view('functional.search.searchResultPage')->with('result',$dataReturn);
            }else{
                $dataReturn['UserIdLIst'] = NULL;
                $dataReturn['query'] = $actualInput;
                return view('functional.search.searchResultPage')->with('result',$dataReturn);
            }
            
            //print_r($typeWithUser_id);
            
        }else{
            $dataReturn = null;

            return view('functional.search.searchResultPage')->with('result',$dataReturn);
        }
 
    }


    public function teacherSearch($stringArray,$coloumArray_teachertable,$FilterState){
        $user = array();
        foreach ($stringArray as $word) {
            foreach($coloumArray_teachertable as $coloumnName){
                //echo $coloumnName."<br>";
                if(DB::table('teachertable')->where($coloumnName,'like','%'.$word.'%')->where('state','like',$FilterState)->where('status','1')->exists()){
                    $user = DB::table('teachertable')->where($coloumnName,'like','%'.$word.'%')->where('status','1')->where('state','like',$FilterState)->get();
                    
                }
            }
        }
        return $user;
    }

    function studentSearch($stringArray,$coloumArray_studnetTable,$FilterState){
        $user = array();
        foreach ($stringArray as $word) {
            foreach($coloumArray_studnetTable as $coloumnName){
                //echo $coloumnName."<br>";
                if(DB::table('studenttable')->where($coloumnName,'like','%'.$word.'%')->where('status','1')->where('state','like',$FilterState)->exists()){

                    $user = DB::table('studenttable')->where($coloumnName,'like','%'.$word.'%')->where('status','1')->where('state','like',$FilterState)->get();

                }
            }
        }
        return $user;
        
    }

    function coachingSearch($stringArray,$coloumArray_coachingtable,$FilterState){
        $user = array();
        foreach ($stringArray as $word) {
            foreach($coloumArray_coachingtable as $coloumnName){
                //echo $coloumnName."<br>";
                if(DB::table('coachingtable')->where($coloumnName,'like','%'.$word.'%')->where('status','1')->where('state','like',$FilterState)->exists()){
                    $user = DB::table('coachingtable')->where($coloumnName,'like','%'.$word.'%')->where('status','1')->where('state','like',$FilterState)->get();
                    
                }
            }
        }
        return $user;
        
    }

    function callAll($stringArray,$coloumArray_studnetTable,$coloumArray_coachingtable,$coloumArray_teachertable,$FilterState){
        InstituteSearch($stringArray,$coloumArray_coachingtable,$FilterState);
        teacherSearch($stringArray,$coloumArray_teachertable,$FilterState);
        studentSearch($stringArray,$coloumArray_studnetTable,$FilterState);
    
    }

}

