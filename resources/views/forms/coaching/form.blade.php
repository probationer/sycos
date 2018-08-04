@extends('components.site_forms.form_layout')

@section('content')
<div>
    <div class="container" id="form-holder">
  <div class="text-center">
      <form role="form" class="form-horizontal" id="a" method="post" action="coachingForm" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div style="text-align: center; margin-top:3%;">
              <h3 id='formtitle'>Create Your Identity</h3>
          </div> 
  <div id="profile-container" id="img">
      <image id="profileImageEg" src="{{asset('/storage/profileImage/banner.png')}}"  class="img-square" style="width:50%;"/>
     <p id="below_profile">Upload a image of your Institute banner or Board</p>
  </div>
  <input id="imageUpload" type="file" name="profile_img" placeholder="Photo" capture>
  <script src="{{asset('js/imagePreview.js')}}"></script>
      <div class="form-group{{ $errors->has('Institute-Name') ? ' has-error' : '' }}">
          <div class="col-sm-6">
                <label>Name Of Institute<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="Institute-Name" value="{{old('Institute-Name')}}" placeholder="Enter Institute Name" required>
                @if ($errors->has('Institute-Name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Institute-Name') }}</strong>
                    </span>
                @endif
          </div>
          <div class="col-sm-6">
              <label>Head Of Institute</label>
          <input type="text" class="form-control" name="Head-of-institute" value="{{old('Head-of-institute')}}" placeholder="Enter Head's Name ">
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
              <input class="form-control" id="TextArea" name="Address-of-institute" value="{{old('Address-of-institute')}}" placeholder="Enter Address" required>
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
                 
                    <select class="selectpicker show-menu-arrow form-control" name="state" value="{{old('state')}}" required="" multiple data-max-options="1" data-live-search="true">
                        <?php
                            SycosFunctions:: MarkSelected(old('state'),SycosFunctions::PutList('state'));
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
                  <input type="numeric" class="form-control" name="pincode" placeholder="Enter 6-digit picode" value="{{old('pincode')}}" required="" onchange="PincodeCheck()"/>
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
                  <input type="text" class="form-control" name="location" placeholder="Enter locality" value="{{old('location')}}" required>
                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="col-sm-6">
                  <label>Any Landmark</label>
                  <input type="text" class="form-control" name="landmark" placeholder="Enter Landmark" value="{{old('landmark')}}" required>
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
                            if(sizeof(old('subjects'))===0){
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
          <div class="form-group{{ $errors->has('classes') ? ' has-error' : '' }}">
              <label class="col-sm-12" for="TextArea">Select Class/Classes<span style="color: red;">*</span></label>
              <div class="col-sm-12">
                  <select class="selectpicker show-menu-arrow form-control" name="classes[]" required="" multiple data-max-options="16" data-live-search="true">
                    <?php
                            if(sizeof(old('classes'))===0){
                                $dummyArray = array('none');
                                SycosFunctions::MarkSelectedArrayReturn($dummyArray,SycosFunctions::PutList('class'));
                            }else{
                                SycosFunctions::MarkSelectedArrayReturn( old('classes') ,SycosFunctions::PutList('class'));
                            }
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
                    <input type="text" class="form-control" name="opening-year" placeholder="Enter year" value="{{old('opening-year')}}">
                </div>
              <div class="col-sm-6{{ $errors->has('contactNo') ? ' has-error' : '' }}">
                  <label>Contact Number</label>
                      <input type="numeric" class="form-control" name="contactNo" placeholder="Enter 10-digit mobile number" value="{{old('contactNo')}}" required/>
                        @if ($errors->has('contactNo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contactNo') }}</strong>
                            </span>
                        @endif
                </div>
          </div>
      
          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <div class="col-sm-12"><label>About your institute </label>
                <textarea type='text' class="form-control" rows="5" name="description" placeholder="Something about your institute" >{{old('description')}}"</textarea>
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