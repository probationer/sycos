@extends('functional.profile.teacherProfile')


@section('detail')
        
        <div id="Detail"  class="tabcontent" style="display:block;" >
            <div class="row">
                <div class="col-sm-2">
                    <p id="boldDetials" style=" margin-top:40px;"><b>Name:</b></p>  
                </div>  
                <p class="formated2" id="formated2" >{{$userData['detail']->studentName}}</p>
                        
            </div>
                <div class="row">
                <div class="col-sm-2">
                    <p id="boldDetials" style=""><b>Age:</b></p>  
                    </div>  
                    <p id="formated2"> {{$userData['detail']->age}} years</p>
                        
            </div>
            
            <div class="row">
                <div class="col-sm-2">
                    <p id="boldDetials" style=""><b>Subject:</b></p>  
                </div>  
                <div class="col-sm-9" id="settelTags">
                    <?php SycosFunctions::CreateTagFromString($userData['detail']->subjects); ?>
                </div>    
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <p id="boldDetials" style=""><b>Classes:</b></p>  
                </div>  
                <div class="col-sm-9" id="settelTags">
                    <?php SycosFunctions::CreateTagFromString($userData['detail']->classes); ?>
                </div>          
            </div>     
            

            <div class="row">
                <div class="col-sm-3">
                    <p id="boldDetials" style=""><b>Address :</b></p>  
                    </div> 
                    <div class="col-sm-8">
                    <p id="formated2">{{$userData['detail']->address}}</p>
                        
                </div>
            </div> 
            <div class="row" style="margin-top:10px;">
                <div class="col-sm-3">
                    <p id="boldDetials" style=""><b>Location:</b></p>  
                </div>  
                <div class="col-sm-8" id="settelTags">
                    <?php echo $userData['detail']->area; ?>
                </div>       
            </div>
            
            <div class="row">
                <div class="col-sm-3">
                    <p id="boldDetials" style=""><b>Pincode :</b></p>  
                    </div> 
                    <div class="col-sm-3">
                    <p id="formated2">{{$userData['detail']->pincode}} </p>
                        
                </div>
            </div>


            <div class="row">
                <div class="col-sm-3">
                    <p id="boldDetials" style=""><b>About me:</b></p>  
                </div> 
                <div class="col-sm-8">
                    <p id="formated2"><small>{{$userData['detail']->description}}</small></p>
                </div>        
            </div>   
            
        </div>

@endsection('detail')

