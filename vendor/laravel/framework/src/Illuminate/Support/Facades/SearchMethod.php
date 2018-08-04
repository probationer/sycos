<?php

namespace Illuminate\Support\Facades;

use Illuminate\Support\Facades\SycosFunctions;

class SearchMethod extends Facade
{   

    public static function studentProfileCard($data){
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
                                <p>'.$data->subjects.'</p>
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
                                <p>'.$data->subjects.'</p>
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
                                <p>'.$data->subjects.'</p>
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
}

    ?>