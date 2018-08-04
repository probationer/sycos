@extends('components.site_forms.form_layout')

@section('content')

<?php


    if(old('fname'))
        $fname = old('fname'); 
    else
        $fname = $userData->first_name;

    if(old('lname'))
        $lname = old('lname'); 
    else
        $lname = $userData->last_name;

    if(old('qualifications'))
        $qualifications = old('qualifications'); 
    else
        $qualifications = $userData->qualifications;

    if(old('Pursuing'))
        $Pursuing = old('Pursuing'); 
    else
        $Pursuing = $userData->pursuing;    
                                            
    if(old('sex'))
        $sex = old('sex'); 
    else
        $sex = $userData->sex;
           
    if(old('age'))
        $age = old('age'); 
    else
        $age = $userData->age;

    if(old('subjects'))
        $subject = old('subjects'); 
    else
        $subject = explode(',',$userData->subjects);

    if(old('class'))
        $class = old('class'); 
    else
        $class = explode(',',$userData->classes);
        
    
    if(old('contactNo'))
        $contactNo = old('contactNo'); 
    else
        $contactNo = $userData->contact;

    if(old('exp'))
        $exp = old('exp'); 
    else
        $exp = $userData->experience;
        
    if(old('state'))
        $state = old('state'); 
    else
        $state = $userData->state;
    
    if(old('pincode'))
        $pincode = old('pincode'); 
    else
        $pincode = $userData->pincode;

    if(old('locations'))
        $locations = old('locations'); 
    else
        $locations = $userData->locations;
    
    if(old('description'))
        $description = old('description'); 
    else
        $description = $userData->description;

        if(old('status')){
            $status = old('status');
            if($status == '1'){
                $actualStatus = 'Available';
                $markAs = 'checked';
            }else{
                $actualStatus = 'Unavailable';
                $markAs = ' ';
            }
        }
        else{
            $status =$userData->status;
            if($status == '1'){
                $actualStatus = 'Available';
                $markAs = 'checked';
            }else{
                $actualStatus = 'Unavailable';
                $markAs = ' ';
            }
        }
            

?>
@include('includes.ImageEditWindow')
<div class="middle">
    <div class="container" id="form-holder" >
      <div class="text-center">
        {!! Form::open(['class'=>'form-horizontal','role'=>'from','action'=> ['dataEntries\teacherDataController@update',$userData->user_id],'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        {{Form::hidden('_method','PUT')}}
            {{ csrf_field() }}
                        <div style="text-align: center; margin-top:3%;">
                            <h1 id='formtitle'>Update Your Details</h1>
                        </div>   
                
                        <div id="profile-container">
                            <img id="profileImageEg" src="{{asset('/storage/profileImage/'.$userData->imageLink)}}" class="img-circle" style="width:100px; height:100px;">
                            <p id="below_profile">Upload profile picture</p>

                            <p id="below_profile_status"><?php echo $actualStatus; ?></p>
                            <div class="form-group" >
                                <div class="col-sm-12">
                                    <label class="switch">
                                        <input type="checkbox" id="StatusId" name="status" {{$markAs}} onclick="ChangeStatus()">
                                        <span class="slider round" ></span>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <input id="imageUpload" type="file" name="profile_img" placeholder="Photo" capture>
                        <script src="{{asset('js/imagePreview.js')}}"></script>
                        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                            <div class="col-sm-6">
                                    <label >First Name</label>
                                            
                            <input id="name" type="text" class="form-control" name="fname" value="{!!$fname!!}" required autofocus>

                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                          <div class="col-sm-6{{ $errors->has('fname') ? ' has-error' : '' }}">
                              <label>Last name</label>
                              <input type="text" class="form-control" name="lname" placeholder="Last Name" value="{!!$lname!!}" required="">
                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-sm-12">
                              <label for="TextArea">Enter last qualified exam and Degree:</label>
                              <input type="text" class="form-control" id="TextArea" name="qualifications" placeholder="Enter degree"value="{{$qualifications}}"  required="">
                              @if ($errors->has('qualifications'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qualifications') }}</strong>
                                    </span>
                                @endif
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-12" for="TextArea">Any Pursuing Degree ?(if any) </label>
                            <div class="col-sm-12">
                            <input class="form-control" id="TextArea" name="Pursuing"  value="{{$Pursuing}}" placeholder="any pursuing degree "></div>
                                @if ($errors->has('Pursuing'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Pursuing') }}</strong>
                                    </span>
                                @endif
                            
                            </div>
                      <div class="form-group">
                          <div class="col-sm-6">
                              <label>Gender</label>
                              <select name="sex" class="form-control"  required="">
                                <?php
                                    
                                    SycosFunctions::MarkSelected($sex,SycosFunctions::PutList('sex'));
                                ?>      
                              </select>

                              @if ($errors->has('sex'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                @endif
                          </div>
                          
                          <div class="col-sm-6">
                              <label>Age</label>
                              <select class="form-control" name="age" required>
                                <?php
                                    
                                    
                                    SycosFunctions::MarkSelected($age,SycosFunctions::PutList('age'));
                                    
                                ?>  
                              </select>

                              @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                          
                            </div>
                        </div>
                      
                     
                      <div class="form-group">
                           <div class="col-sm-12">
                              <label>Which Subject(s) you prefer to teach ?</label>
                              <?php print_r(old('subjects')); ?>
                              <select name="subjects[]" class="selectpicker show-menu-arrow form-control" required="" multiple data-max-options="24" data-live-search="true">    
                                <?php
                                    
                                    SycosFunctions::MarkSelectedArrayReturn( $subject ,SycosFunctions::PutList('subject'));
                                    

                                ?>  
                                
                              </select>

                              @if ($errors->has('subjects'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subjects') }}</strong>
                                    </span>
                                @endif
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-sm-12">
                              <label>Which Classes you prefer to teach ? </label>
                              <?php print_r(old('class')); ?>
                              <select name="class[]" class="selectpicker show-menu-arrow form-control" required="" multiple data-max-options="16" data-live-search="true">                                 
                                <?php
                                    
                                    SycosFunctions::MarkSelectedArrayReturn( $class ,SycosFunctions::PutList('class'));
                                    
                                    
                                ?>  
                              </select>

                              @if ($errors->has('class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                @endif
                          </div>
                      </div>
                      
                      
                      
                      
                      <div class="form-group">
                          <div class="col-sm-6">
                              <label>Mobile Number</label>
                          <input type="text" class="form-control" name="contactNo" placeholder="Enter 10-digit mobile number" value="{{$contactNo}}" required/>
                              @if ($errors->has('contactNo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contactNo') }}</strong>
                                    </span>
                                @endif
                          </div>
                          <div class="col-sm-6">
                              <label>Experience(In year, If any)</label>
                              <input type="numeric" class="form-control" name="exp" value="{{$exp}}" placeholder="Enter experience">
                              @if ($errors->has('exp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exp') }}</strong>
                                    </span>
                                @endif
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="col-sm-6">
                              <label>State/City </label>
                              
                              <select class="selectpicker show-menu-arrow form-control" name="state" required="" data-max-options="1" data-live-search="true">
                                <?php
                                    
                                    SycosFunctions::MarkSelected($state,SycosFunctions::PutList('state'));
                                    
                                ?>  
                              </select>

                              @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif   
                          </div>
                          <div class="col-sm-6">
                              <label>Pin-code</label>
                              <input type="numeric" class="form-control" name="pincode" placeholder="Enter 6-digit picode" required="" value="{{$pincode}}" />
                              @if ($errors->has('pincode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                @endif
                          </div>
                      </div>
  
                      <div class="form-group">
                          <label class="col-sm-12" for="TextArea">Locations you can give classes ? (Can write more than one separate by comma) </label>
                            <div class="col-sm-12">
                              <input type="numberic" class="form-control" name="locations" id="TextArea"  value="{{$locations}}" placeholder="Eg: Laxmi nagar,C.p.,Okhla etc">
                                @if ($errors->has('locations'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('locations') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="col-sm-12">
                            <label>Something About you  </label>
                            <textarea type='text' class="form-control" rows="5" name="description"  placeholder="Any thing that you have achived or you good at, your speciality . . . . . . .  .">{{$description}}</textarea>
                            @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      
                      <div class="text-center">
                          <button type="submit" class="btn btn-info" id="submit" name="SubmitForm">Submit</button>
                      </div>
          
      
          </form>
      </div>
  </div>
  </div>

  @endsection('content')