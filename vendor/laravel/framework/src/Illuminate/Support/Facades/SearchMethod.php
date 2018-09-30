<?php

namespace Illuminate\Support\Facades;

use Illuminate\Support\Facades\SycosFunctions;
use Illuminate\Support\Facades\DB;
class SearchMethod extends Facade
{   

    public static function studentProfileCard($data){
        $subject = str_replace(',',', ',$data->subjects);
        return '<div class="container-fluid" style="background-color:white; border:1px solid gray; margin:5px;">
                <div class="row">
                    <!--image section----------->
                    <div class="col-sm-4 text-center">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <img src="'.asset('/showUserImage/'.$data->imageLink).'" class="img-circle " width="100px" height="100px"/> 
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="col-xs-12" style="margin-bottom:10px;">
                                <button class="btn btn-info" onclick="location.assign(\''.asset('/profile/'.$data->profilePage).'\');">View Profile</button>
                            </div>
                        </div>
                    </div>
                    
                    <!--image section end----------->
                    
                    <!--Information----------->
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p style="font:500 22px roboto;">'.$data->studentName.'<br>
                                    <span style="font:400 15px roboto; font-style: italic;">Student</span><br>
                                    <span style="font:400 13px roboto; font-style: italic;">'.$data->state.'</span>
                                </p>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$subject.'</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$data->classes.'</p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--Information end----------->
                </div>
            </div>';
    }

    public static function teacherProfileCard($data){
        $subject = str_replace(',',', ',$data->subjects);
        return '<div class="container-fluid" style="background-color:white; border:1px solid gray; margin:5px;">
                <div class="row">
                    <!--image section----------->
                    <div class="col-sm-4 text-center">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <img src="'.asset('/showUserImage/'.$data->imageLink).'" class="img-circle " width="100px" height="100px"/> 
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="col-xs-12" style="margin-bottom:10px;">
                                <button class="btn btn-info" onclick="location.assign(\''.asset('/profile/'.$data->profilePage).'\');">View Profile</button>
                            </div>
                        </div>
                    </div>
                    
                    <!--image section end----------->
                    
                    <!--Information----------->
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p style="font:500 22px roboto;">'.$data->first_name.' '.$data->last_name.'<br>
                                    <span style="font:400 15px roboto; font-style: italic;">Teacher</span><br>
                                    <span style="font:400 13px roboto; font-style: italic;">'.$data->state.'</span>
                                </p>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$subject.'</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$data->classes.'</p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--Information end----------->
                </div>
            </div>';
    }

    public static function instituteProfileCard($data){
        $subject = str_replace(',',', ',$data->subjects);
        return '<div class="container-fluid" style="background-color:white; border:1px solid gray; margin:5px;">
                <div class="row">
                    <!--image section----------->
                    <div class="col-sm-4 text-center">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <img src="'.asset('/showUserImage/'.$data->imageLink).'" class="img-circle " width="100px" height="100px"/> 
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="col-xs-12" style="margin-bottom:10px;">
                                <button class="btn btn-info" onclick="location.assign(\''.asset('/profile/'.$data->profilePage).'\');">View Profile</button>
                            </div>
                        </div>
                    </div>
                    
                    <!--image section end----------->
                    
                    <!--Information----------->
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p style="font:500 22px roboto;">'.$data->Institute_name.'<br>
                                    <span style="font:400 15px roboto; font-style: italic;">Coaching Institute</span><br>
                                    <span style="font:400 13px roboto; font-style: italic;">'.$data->state.'</span>
                                </p>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$subject.'</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$data->classes.'</p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--Information end----------->
                </div>
            </div>';
    }

    public static function articleCard($data){

        $body = strip_tags($data->body);
        $subStr = substr($body,0,200).'....';
        $name = DB::table('signup')->where('id',$data->writer_id)->first()->name;
        
        return '<div class="container-fluid" style="background-color:white; border:1px solid gray; margin:5px;">
                <div class="row">
                    <!--image section----------->
                    <div class="col-sm-1">
                        
                    </div>
                    
                    <!--image section end----------->
                    
                    <!--Information----------->
                    <div class="col-sm-11">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p style="font:500 24px roboto;">'.$data->title.'<br>
                                    <span style="font:400 12px roboto; font-style: italic;">Article </span><br>
                                    <span style="font:400 14px roboto; font-style: normal;">Written By: '.$name.'</span>
                                </p>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$subStr.'</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p><a href="'.asset("/article/".$data->link).'">Read this article</a></p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--Information end----------->
                </div>
            </div>';
    }

    public static function videoCard($data){

        $body = strip_tags($data->description);
        $subStr = substr($body,0,200).'....';
        $name = DB::table('signup')->where('id',$data->user_id)->first()->name;
        return '<div class="container-fluid" style="background-color:white; border:1px solid gray; margin:5px;">
                <div class="row">
                    <!--image section----------->
                    <div class="col-sm-1">
                        
                    </div>
                    
                    <!--image section end----------->
                    
                    <!--Information----------->
                    <div class="col-sm-11">
                        <div class="row">
                            <div class="col-xs-12">
                                &nbsp;
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p style="font:500 24px roboto;">'.$data->title.'<br>
                                    <span style="font:400 12px roboto; font-style: italic;">Video</span><br>
                                    <span style="font:400 14px roboto; font-style: normal;">Uploaded By: '.$name.'</span>
                                </p>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p>'.$subStr.'</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <p><a href="'.asset("/video/".$data->link).'">Watch video</a></p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--Information end----------->
                </div>
            </div>';
    }

    public static function Noresult($data){
        return "<h4>Sorry no result found for <i>".$data."</i><br>
                Please write a <a href='".asset('/suggestions')."'>Feedback</a> or any <a href='".asset('/suggestions')."'>Suggestion for improvement<a></h4>";
    }
}

    ?>