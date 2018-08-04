@extends('components.site_forms.form_layout')
<?php

    if(old('Name'))
        $name = old('Name'); 
    else
        $name = $userData->studentName;

    if(old('address'))
        $address = old('address'); 
    else
        $address = $userData->address;

         
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
        $contactNo = $userData->contactNo;

    
    if(old('state'))
        $state = old('state'); 
    else
        $state = $userData->state;
    
    if(old('pincode'))
        $pincode = old('pincode'); 
    else
        $pincode = $userData->pincode;

    if(old('locality'))
        $locality = old('locality'); 
    else
        $locality = $userData->area;
    
    if(old('description'))
        $description = old('description'); 
    else
        $description = $userData->description;


    
?>

@section('content')

<div class="middle">
    <div class="container" id="form-holder">
        <div class="text-center">
                {!! Form::open(['class'=>'form-horizontal','role'=>'from','action'=> ['dataEntries\studentDataController@update',$userData->user_id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                {{Form::hidden('_method','PUT')}}
                    {{ csrf_field() }}
                <div style="text-align: center; margin-top:3%;">
                        <h1 id='formtitle'>Update Details</h1>
                </div> 

        <div id="profile-container">
           <image id="profileImageEg" src="{{asset('/storage/profileImage/'.$userData->imageLink)}}" class="img-circle" />
           <p id="below_profile">Upload Your Image</p>
           
        </div>
        <input id="imageUpload" type="file"name="profile_img" placeholder="Photo" capture>
        <script src="{{asset('js/imagePreview.js')}}"></script>

            <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }}">
                <div class="col-sm-12 col-xs-12">
                     <label>Name of Student </label>
                    <input type="text" class="form-control" name="Name" placeholder="Enter Name" value="{{$name}}" required autofocus>
                        @if ($errors->has('Name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Name') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                <div class="col-sm-12 col-xs-12">
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
            
            
            <div class="form-group{{ $errors->has('subjects') ? ' has-error' : '' }}">
                <label class="col-sm-12" for="TextArea">Select Your Subject(s)</label>
                <div class="col-sm-12">
                    <select class="selectpicker show-menu-arrow form-control" name="subjects[]" required="" multiple  data-live-search="true" data-max-options="24">
                        <?php 
                            
                            SycosFunctions::MarkSelectedArrayReturn($subject,SycosFunctions::PutList('subject'));
                            
                        ?>
                    </select>

                    @if ($errors->has('subjects'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subjects') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                <label for="TextArea" class="col-sm-12" >Select Your Class</label>
                <div class="col-sm-12">
                    <select class=" form-control" name="class[]" required="">
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
            
            
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <div class="col-sm-12">
                    <label>Address<span style="font-weight: 400;font-size: 13px;color:blue;"> ( not compulsory )</span></label>
                    <input type="text" class="form-control" name="address" value={{$address}} placeholder="Enter complete Address" >
                    @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('locality') ? ' has-error' : '' }}">
                <div class="col-sm-6">
                    <label>Your Location<span style="font-size: 12px; font-style: italic; color:blue;"> (eg: Laxmi Nagar)</span></label>
                <input type="text" class="form-control" name="locality" value="{{$locality}}" placeholder="Enter your location or locality" >
                    @if ($errors->has('locality'))
                        <span class="help-block">
                            <strong>{{ $errors->first('locality') }}</strong>
                        </span>
                    @endif
                </div>
                
                
                <div class="col-sm-6">
                  <label>State/City</label>
                  <select class="selectpicker show-menu-arrow form-control" name="state" required="" value="{{old('state')}}"  data-live-search="true" >
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
                  
            </div>
            <div class="form-group{{ $errors->has('contactNo') ? ' has-error' : '' }}">
                <div class="col-sm-6">
                    <label>Mobile Number<span style="font-weight: 400;font-size: 12px;color:blue;"> (this will not shown to other)</span></label>
                <input type="numeric" class="form-control" name="contactNo" value="{{$contactNo}}" placeholder="Enter 10-digit mobile number" required/>
                    @if ($errors->has('contactNo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('contactNo') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-6">
                    <label>Pin-code</label>
                <input type="numeric" class="form-control" name="pincode" value="{{$pincode}}" placeholder="Enter 6-digit picode" required="" />
                    @if ($errors->has('pincode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pincode') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <div class="col-sm-12"><label>Something About you </label>
                <textarea type='text' class="form-control" rows="5" name="description" placeholder="Why you need teacher ? about your weak subjects or anything else. . . . . . .  .">
                        {{$description}}
                </textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            
            <div class="text-center">
                <button type="submit" class="btn btn-info btn-danger" id="submit"  name="SubmitForm" >Create</button>
            </div>
	
	
            </form>
        </div>
    </div>
</div>
@endsection('content')