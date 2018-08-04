@extends('components.site_forms.form_layout')

<?php

    if(old('Institute-Name'))
        $name = old('Institute-Name'); 
    else
        $name = $userData->Institute_name;

    if(old('Head-of-institute'))
        $hod = old('Head-of-institute'); 
    else
        $hod = $userData->head_of_institute;
    

    if(old('Address-of-institute'))
        $address = old('Address-of-institute'); 
    else
        $address = $userData->address;

         
    if(old('opening-year'))
        $opening = old('opening-year'); 
    else
        $opening = $userData->opening_year;

    if(old('subjects'))
        $subjects = old('subjects'); 
    else
        $subjects = explode(',',$userData->subjects);

    if(old('classes'))
        $class = old('classes'); 
    else
        $class = explode(',',$userData->classes);
        
    
    if(old('contactNo'))
        $contactNo = old('contactNo'); 
    else
        $contactNo = $userData->contactNo;

    
    if(old('state'))
        $state = old('state'); 
    else
        $state = $userData->state;
    
    if(old('pincode'))
        $pincode = old('pincode'); 
    else
        $pincode = $userData->pincode;

    if(old('location'))
        $location = old('location'); 
    else
        $location = $userData->location;

    if(old('landmark'))
        $landmark = old('landmark'); 
    else
        $landmark = $userData->landmark;
    


    if(old('description'))
        $description = old('description'); 
    else
        $description = $userData->description;


    
?>
@section('content')
<div class="middle">
    <div class="container" id="form-holder">
  <div class="text-center">
        {!! Form::open(['class'=>'form-horizontal','role'=>'from','action'=> ['dataEntries\coachingDataController@update',$userData->user_id],'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        {{Form::hidden('_method','PUT')}}
            {{ csrf_field() }}
          <div style="text-align: center; margin-top:3%;">
              <h3 id='formtitle'>Create Your Identity</h3>
          </div> 
  <div id="profile-container" id="img">
      <image id="profileImageEg" src="{{asset('/showUserImage/'.$userData->imageLink)}}"  class="img" style="width:75%; heigth:auto;"/>
     <p id="below_profile">Upload a image of your Institute banner or Board</p>
  </div>
  <input id="imageUpload" type="file" name="profile_img" placeholder="Photo" capture>
  <script src="{{asset('js/imagePreview.js')}}"></script>
      <div class="form-group{{ $errors->has('Institute-Name') ? ' has-error' : '' }}">
          <div class="col-sm-6">
                <label>Name Of Institute<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="Institute-Name" value="{{$name}}" placeholder="Enter Institute Name" required>
                @if ($errors->has('Institute-Name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Institute-Name') }}</strong>
                    </span>
                @endif
          </div>
          <div class="col-sm-6">
              <label>Head Of Institute</label>
          <input type="text" class="form-control" name="Head-of-institute" value="{{$hod}}" placeholder="Enter Head's Name ">
              @if ($errors->has('Head-of-institute'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Head-of-institute') }}</strong>
                    </span>
                @endif
          </div>
      </div>
      <div class="form-group{{ $errors->has('Address-of-institute') ? ' has-error' : '' }}">
              <label class="col-sm-12" for="TextArea">Address<span style="color: red;">*</span></label>
              <div class="col-sm-12">
              <input class="form-control" id="TextArea" name="Address-of-institute" value="{{$address}}" placeholder="Enter Address" required>
                    @if ($errors->has('Address-of-institute'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Address-of-institute') }}</strong>
                        </span>
                    @endif
                </div>
          </div>
          <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
              <div class="col-sm-6">
                  <label>State<span style="color: red;">*</span></label>
                 
                    <select class="selectpicker show-menu-arrow form-control" name="state" value="{{$state}}" required="" multiple data-max-options="1" data-live-search="true">
                        <?php
                            SycosFunctions:: MarkSelected($state,SycosFunctions::PutList('state'));
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
                  <input type="numeric" class="form-control" name="pincode" placeholder="Enter 6-digit picode" value="{{$pincode}}" required="" onchange="PincodeCheck()"/>
                  @if ($errors->has('pincode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pincode') }}</strong>
                        </span>
                    @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
              <div class="col-sm-6">
                  <label>Location<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="location" placeholder="Enter locality" value="{{$location}}" required>
                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="col-sm-6">
                  <label>Any Landmark</label>
                  <input type="text" class="form-control" name="landmark" placeholder="Enter Landmark" value="{{$landmark}}" required>
                    @if ($errors->has('landmark'))
                        <span class="help-block">
                            <strong>{{ $errors->first('landmark') }}</strong>
                        </span>
                    @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('subjects') ? ' has-error' : '' }}">
              <label class="col-sm-12" for="TextArea">Select Subject(s) <span style="color: red;">*</span></label>
              <div class="col-sm-12">
                  <select class="selectpicker show-menu-arrow form-control" name="subjects[]" required="" multiple data-max-options="24" data-live-search="true">
                      <?php
                            
                                SycosFunctions::MarkSelectedArrayReturn( $subjects ,SycosFunctions::PutList('subject'));
                            
                      ?>
                  </select>

                  @if ($errors->has('subjects'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subjects') }}</strong>
                        </span>
                    @endif
          </div>
          </div>
          <div class="form-group{{ $errors->has('classes') ? ' has-error' : '' }}">
              <label class="col-sm-12" for="TextArea">Select Class/Classes<span style="color: red;">*</span></label>
              <div class="col-sm-12">
                  <select class="selectpicker show-menu-arrow form-control" name="classes[]" required="" multiple data-max-options="16" data-live-search="true">
                    <?php
                         
                                SycosFunctions::MarkSelectedArrayReturn( $class ,SycosFunctions::PutList('class'));
                            
                    ?>
                  </select>
                  </select>
                     @if ($errors->has('classes'))
                        <span class="help-block">
                            <strong>{{ $errors->first('classes') }}</strong>
                        </span>
                    @endif
              </div>
          </div>
          
          <div class="form-group{{ $errors->has('opening-year') ? ' has-error' : '' }}">
                <div class="col-sm-6"><label>Opening Year</label>
                    <input type="text" class="form-control" name="opening-year" placeholder="Enter year" value="{{$opening}}">
                </div>
              <div class="col-sm-6{{ $errors->has('contactNo') ? ' has-error' : '' }}">
                  <label>Contact Number</label>
                      <input type="numeric" class="form-control" name="contactNo" placeholder="Enter 10-digit mobile number" value="{{$contactNo}}" required/>
                        @if ($errors->has('contactNo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contactNo') }}</strong>
                            </span>
                        @endif
                </div>
          </div>
      
          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <div class="col-sm-12"><label>About your institute </label>
                <textarea type='text' class="form-control" rows="5" name="description" placeholder="Something about your institute" >{{$description}}"</textarea>
            </div>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
          </div>
      </div>
        
          
          
      <div class="text-center">
              <button type="submit" class="btn btn-info btn-danger" id="submit" name="SubmitForm" >Create</button>
      </div>
    </div>
      
  </form>
  </div>
@endsection('content')