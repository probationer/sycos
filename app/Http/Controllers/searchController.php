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
    public function search(Request $request,$type = 'all'){
    
        if($request->input('query') != NULL){
            
            $statingtime = microtime();
            $actualInput = $request->input('query'); //query by user
            $inputstring = SycosFunctions::input_validate($request->input('query')); //removing the impurities
            
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
            $exceptionWords = array('Garden','garden','GARDEN','nagar','NAGAR','Nagar','colony','COLONY','Colony','Park','park','PARK');
            
            //table name and there coloumns to be search.
            $search_table_name = array('coachingtable','teachertable','studenttable','state');
            $coloumArray_coachingtable = array('Institute_name','address','location','landmark','subjects','classes','state');
            $coloumArray_teachertable = array('first_name','last_name','qualifications','sex','subjects','classes','state');
            $coloumArray_studnetTable = array('studentName','subjects','classes','area','state');
            $coloumArray_articleTable = array('title','body','tags','gname');
            $coloumArray_videoTable = array('title','description');
        
            $dataReturnTeacher = array();
            $dataReturnStudent = array();
            $dataReturnCoaching = array();
            $dataReturnArticle = array();
            $dataReturnVideo = array();

            //search and return the matches in array
            switch ($type){
                case 'student':
                    $dataReturnStudent = searchController::studentSearch($stringArray,$coloumArray_studnetTable,$FilterState);
                    break;
                
                case 'institute':
                    $dataReturnCoaching = searchController::coachingSearch($stringArray,$coloumArray_coachingtable,$FilterState);
                    break;
                
                case 'teacher':
                    $dataReturnTeacher = searchController::teacherSearch($stringArray,$coloumArray_teachertable,$FilterState);
                    break;
                
                case 'article':
                    $dataReturnArticle = searchController::articleSearch($stringArray,$coloumArray_articleTable);
                    break;

                case 'video':
                    $dataReturnVideo = searchController::videoSearch($stringArray,$coloumArray_videoTable);
                    break;

                case 'all':
                    $dataReturnVideo = searchController::videoSearch($stringArray,$coloumArray_videoTable);
                    $dataReturnArticle = searchController::articleSearch($stringArray,$coloumArray_articleTable);
                    $dataReturnStudent = searchController::studentSearch($stringArray,$coloumArray_studnetTable,$FilterState);
                    $dataReturnTeacher = searchController::teacherSearch($stringArray,$coloumArray_teachertable,$FilterState);
                    $dataReturnCoaching = searchController::coachingSearch($stringArray,$coloumArray_coachingtable,$FilterState);
                    break;
                default :
                    $dataReturnVideo = searchController::videoSearch($stringArray,$coloumArray_videoTable);
                    $dataReturnArticle = searchController::articleSearch($stringArray,$coloumArray_articleTable);
                    $dataReturnStudent = searchController::studentSearch($stringArray,$coloumArray_studnetTable,$FilterState);
                    $dataReturnTeacher = searchController::teacherSearch($stringArray,$coloumArray_teachertable,$FilterState);
                    $dataReturnCoaching = searchController::coachingSearch($stringArray,$coloumArray_coachingtable,$FilterState);
                break;
            }


            $UserIdArray = array();
            //print_r($dataReturnTeacher);
            foreach($dataReturnTeacher as $v){
                array_push($UserIdArray, $v->user_id);
            }

            foreach($dataReturnStudent as $v){
                
                array_push($UserIdArray, $v->user_id);
                
            }

            foreach($dataReturnCoaching as $v){
                array_push($UserIdArray, $v->user_id);
            }
            
            foreach($dataReturnArticle as $v){
                array_push($UserIdArray, $v->link);
            }
            
            foreach($dataReturnVideo as $v){
                array_push($UserIdArray, $v->link);
            }

            //print_r($UserIdArray);
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
            $dataReturn['article'] = $dataReturnArticle;
            $dataReturn['video'] = $dataReturnVideo;

            if(count($finalArray) > 0 ){
                foreach($finalArray as $f){
                    if(!(in_array($f, $checkArray))){
                        array_push($checkArray, $f);
                        if(DB::table('signup')->where('id',$f)->exists())
                            $type = DB::table('signup')->where('id',$f)->first()->usertype;
                        elseif(DB::table('articles')->where('link',$f)->exists()){
                            $type = 'Article';
                        }else{
                            $type = 'Video';
                        }
                            
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
                            
                            case 'Article':
                                $typeWithUser_id[$f] = 'Article';
                                break;

                            case 'Video':
                                $typeWithUser_id[$f] = 'Video';
                                break;

                            default :
                                break;
                        }

                    }
                    
                }
                $dataReturn['UserIdLIst'] = $typeWithUser_id;
                $dataReturn['query'] = $actualInput;
                $dataReturn['count'] = count($FilterState);
                return view('functional.search.searchResultPage3')->with('result',$dataReturn);
            }else{
                $dataReturn['UserIdLIst'] = NULL;
                $dataReturn['query'] = $actualInput;
                return view('functional.search.searchResultPage3')->with('result',$dataReturn);
            }
            
            //print_r($typeWithUser_id);
            
        }else{
            $dataReturn['UserIdLIst'] = null;
            $dataReturn['query'] = "Search Something";
            return view('functional.search.searchResultPage3')->with('result',$dataReturn);
        }
 
    }

    public function subtype(Request $request,$type){
        //$value = $request->input('query');
        return searchController::search($request,$type);
    }

    function teacherSearch($stringArray,$coloumArray_teachertable,$FilterState){
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
        //articleSearch($stringArray,$coloumArray_articleTable);
    }
    
    function articleSearch($stringArray,$coloumArray_articleTable){
        $article = array();
        foreach($stringArray as $word){
            foreach($coloumArray_articleTable as $coloumnName){
                if(DB::table('articles')->where($coloumnName,'like','%'.$word.'%')->exists()){
                    $article = DB::table('articles')->where($coloumnName,'like','%'.$word.'%')->get();
                }
            }
        }
        return $article;
    }

    function videoSearch($stringArray,$coloumArray_videoTable){
        $video = array();
        foreach($stringArray as $word){
            foreach($coloumArray_videoTable as $coloumnName){
                if(DB::table('video')->where($coloumnName,'like','%'.$word.'%')->exists()){
                    $video = DB::table('video')->where($coloumnName,'like','%'.$word.'%')->get();
                }
            }
        }
        return $video;
    }

}