@extends('functional.profile.teacherProfile')


@section('detail')
<div id="Detail"  class="tabcontent" style="display:block;">
                    
            
        <div class="row">
            <div class="col-sm-2">
            <p id="boldDetials" style=" margin-top:40px;"><b>Name:</b></p>  
            </div>  
            <p class="formated2" id="formated2" >{{$userData['detail']->first_name}} {{$userData['detail']->last_name}}</p>
                
        </div>
            <div class="row">
            <div class="col-sm-2">
                <p id="boldDetials"><b>Age:</b></p>  
                </div>  
                <p id="formated2"> {{$userData['detail']->age .' years'}}</p>
                    
        </div>
            <div class="row">
            <div class="col-sm-3">
                <p id="boldDetials"><b>Qualifiacton:</b></p>  
                </div>  
                <p id="formated2">{{$userData['detail']->qualifications}}</p>
                    
        </div>
        <div class="row">
            <div class="col-sm-3">
                <p id="boldDetials"><b>Pursuing:</b></p>  
                </div>  
            <p id="formated2">{{$userData['detail']->pursuing}}</p>
                    
        </div> 
            <div class="row">
            <div class="col-sm-3">
                <p id="boldDetials"><b>Experience:</b></p>  
                </div> 
                <div class="col-sm-3">
                <p id="formated2">{{$userData['detail']->experience}} years</p>
                    
        </div>
            </div>  
        <div class="row">
            <div class="col-sm-2" id="boldDetials">
                <p ><b>Subject:</b></p>  
            </div>  
            <div class="col-sm-9" id="settelTags">
                <?php SycosFunctions::CreateTagFromString($userData['detail']->subjects); ?>
            </div>    
        </div>

        <div class="row">
            <div class="col-sm-2" id="boldDetials">
                <p><b>Classes:</b></p>  
            </div>  
            <div class="col-sm-9" id="settelTags">
                <?php SycosFunctions::CreateTagFromString($userData['detail']->classes); ?>
            </div>          
        </div>     
        <div class="row" style="margin-top:10px;">
            <div class="col-sm-3" id="boldDetials">
                <p><b>Location can reach:</b></p>  
            </div>  
            <div class="col-sm-8" id="settelTags">
                <?php SycosFunctions::CreateTagFromString($userData['detail']->locations); ?>
            </div> 
            
                    
        </div> 
        <div class="row">
            <div class="col-sm-2" id="boldDetials">
                <p ><b>About me:</b></p>  
            </div>
            <div class="col-sm-9" >
                <p id="formated2"><small>{{$userData['detail']->description}}</small></p>
            </div>          
        </div>   

</div>

@endsection('detail')