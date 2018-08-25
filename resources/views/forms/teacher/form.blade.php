@extends('components.site_forms.form_layout')


@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/tag.css')}}">
<script src="{{asset('js/tag.js')}}"></script>
<div>
    <div class="container" id="form-holder">
        <div class="text-center">
            <form role="form" class="form-horizontal" id="a" method="post" action="teacherForm" enctype="multipart/form-data" >
                {{ csrf_field() }}
                            <div>
                                <h1 id='formtitle'>Create Your Identity</h1>
                            </div>   
                    
                            <div >
                            <img id="profileImageEg" src="{{asset('/storage/profileImage/default.png')}}" class="img-circle">
                                <p>Upload profile picture</p>
                            </div>
                            <input id="imageUpload" type="file" name="profile_img" placeholder="Photo" capture>
                            <script src="{{asset('js/imagePreview.js')}}"></script>

                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <div class="col-sm-6">
                                        <label >First Name</label>
                                        <input id="name" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autofocus>

                                        @if ($errors->has('fname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            <div class="col-sm-6{{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label>Last name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Last Name" value="{{ old('lname') }}" required="">
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
                                <input type="text" class="form-control" id="TextArea" name="qualifications" placeholder="Enter degree"value="{{ old('qualifications') }}"  required="">
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
                                <input class="form-control" id="TextArea" name="Pursuing"  value="{{old('Pursuing')}}" placeholder="any pursuing degree "></div>
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
                                        SycosFunctions::MarkSelected(old('sex'),SycosFunctions::PutList("sex"));
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
                                        
                                        SycosFunctions::MarkSelected(old('age'),SycosFunctions::PutList('age'));
                                        
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
                                        if(sizeof(old('subjects'))==0){
                                            $dummyArray = array('none');
                                            SycosFunctions::MarkSelectedArrayReturn($dummyArray,SycosFunctions::PutList('subject'));
                                        }else{
                                            SycosFunctions::MarkSelectedArrayReturn( old('subjects') ,SycosFunctions::PutList('subject'));
                                        }

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
                                        
                                        if(sizeof(old('class'))==0){
                                            $dummyArray = array('none');
                                            SycosFunctions::MarkSelectedArrayReturn($dummyArray,SycosFunctions::PutList('class'));
                                        }else{
                                            SycosFunctions::MarkSelectedArrayReturn( old('class') ,SycosFunctions::PutList('class'));
                                        }
                                        
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
                            <input type="text" class="form-control" name="contactNo" placeholder="Enter 10-digit mobile number" value="{{old('contactNo')}}" required/>
                                @if ($errors->has('contactNo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('contactNo') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <label>Experience(In year, If any)</label>
                                <input type="numeric" class="form-control" name="exp" value="{{old('exp')}}" placeholder="Enter experience">
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
                                        SycosFunctions::MarkSelected(old('state').',',SycosFunctions::PutList('state'));
                                        
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
                                <input type="numeric" class="form-control" name="pincode" placeholder="Enter 6-digit picode" required="" value="{{old('pincode')}}" />
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
                                <input type="text" class="form-control" name="locations" id="TextArea"  value="{{old('locations')}}" placeholder="Eg: Laxmi nagar,C.p.,Okhla etc">
                                    @if ($errors->has('locations'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('locations') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <script>$('input[name="locations"]').amsifySuggestags();</script>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Something About you  </label>
                                <textarea type='text' class="form-control" rows="5" name="description" value="{{old('description')}}"  placeholder="Any thing that you have achived or you good at, your speciality . . . . . . .  ."></textarea>
                                @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-danger" id="submit" name="SubmitForm">Submit</button>
                        </div>
            
        
            </form>
        </div>
    </div>
</div>

  @endsection('content')