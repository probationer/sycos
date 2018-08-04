@extends('functional.profile.teacherProfile')


@section('detail')   

<div id="Detail" class="tabcontent" style="display:block;">
                    
            <div class="row" >
            <div class="col-sm-4" >
                <p id="boldDetials" style=" margin-top:40px;"><b>Institute Name </b></p>  
                </div>  
                <p class="formated2" id="formated2" > {{$userData['detail']->Institute_name}} </p>
                    
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <p id="boldDetials" style=" "><b>Head Of Institute: </b></p>  
                    </div>  
                    <p  id="formated2" > {{$userData['detail']->head_of_institute}} </p>
                        
            </div>

            <div class="row">
            <div class="col-sm-4">
                <p id="boldDetials" style=""><b>Opening Year: </b></p>  
                </div>  
                <p id="formated2"> {{$userData['detail']->opening_year}} years</p>   
            </div>

            <div class="row">
            <div class="col-sm-4">
                <p id="boldDetials" style=""><b>Address: </b></p>  
                </div>  
                <p id="formated2">{{$userData['detail']->address}}</p>
                    
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <p id="boldDetials" style=""><b>Location:</b></p>  
                    </div>  
                <p id="formated2"> {{$userData['detail']->location}}</p>
                    
            </div> 

            <div class="row">
                <div class="col-sm-4">
                    <p id="boldDetials" style=""><b>Landmark: </b></p>  
                </div>
                    <p id="formated2">{{$userData['detail']->landmark}}</p>
            </div> 

            <div class="row" style="margin-top:10px;">
                <div class="col-sm-4">
                    <p id="boldDetials" style=""><b>Pincode: </b></p>  
                </div>  
                <p id="formated2">{{$userData['detail']->pincode}}</p>         
            </div>

        <div class="row">
            <div class="col-sm-4">
                <p id="boldDetials" style=""><b>Subject:</b></p>  
            </div>  
            <div class="col-sm-8" id="settelTags">
                <?php SycosFunctions::CreateTagFromString($userData['detail']->subjects); ?>
            </div>    
        </div>

        <div class="row">
            <div class="col-sm-4">
                <p id="boldDetials" style=""><b>Classes:</b></p>  
            </div>  
            <div class="col-sm-8" id="settelTags">
                <?php SycosFunctions::CreateTagFromString($userData['detail']->classes); ?>
            </div>          
        </div>     
         
        <div class="row">
            <div class="col-sm-4">
                <p id="boldDetials" style=""><b>About Our Institute </b></p>  
                </div>  
            <p class="col-sm-8" id="settelTags">{{$userData['detail']->description}}</p>
                    
        </div>   

</div>

@endsection('detail')