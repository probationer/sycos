@extends('components.profile.tempLayout')

@section('content')


    <div class="col-md-6">
        <div class="userlogin" id="contactForm">

            <form  method="post"  class="form-horizontal" id="Form_contactMe" action="{{asset('/profile/'.$userData['detail']->profilePage.'/contactStudent')}}">
                <div class="container-fluid">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <div class="col-xs-12" id="form_header1">
                            <h2 id="getInTouch" >Get In Touch</h2>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12{{ $errors->has('name') ? ' has-error' : '' }}" >
                            <label id="contactnameHeading" style="margin-top:10px;" >Your Name</label>
                            <input type="text" id="contactnameInput" class="form-control" name="name" placeholder=" Full Name" required value="{{ old('name') }}">
                            
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label id="contactsubjectHeading" >Subject(s) you teach</label>
                        
                            <select id="contactsubjectInput" style=" z-index:auto" class="selectpicker show-menu-arrow form-control" name="subjects[]" required="" multiple data-max-options="24">
                                <?php
                                    echo SycosFunctions::ShowProfileOptions($userData['detail']->subjects);
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
                        <div class="col-xs-12">
                            <label id="contactclassHeading">Class/Course </label>
                            
                            <select id="contactclassInput" class="selectpicker show-menu-arrow form-control" name="class[]" required="" data-max-options="24">
                                <?php
                                    echo SycosFunctions::ShowProfileOptions($userData['detail']->classes);
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
                        <div class="col-xs-12">
                            <label id="contactChargeHeading">Your charges (Per hours/Per month)</label>
                            <input type="text" id="contactChargeInput"  class="form-control" name="charges" placeholder="Enter you charges" value="{{ old('charges') }}" required>

                            @if ($errors->has('charges'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('charges') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label id="ContactInfoHeading">Any Message</label>
                            <textarea type='text' id="ContactInfoInput" class="form-control" rows="5" name="message"  placeholder="Enter your message" >{{ old('message') }}</textarea>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div>
                        <button type="submit" class="btn btn-primary" name="submitContactInfo">Send Message</button>
                    </div>

                    <script>
                        $('#submitContactForm').click(function() {
                                $(this).attr('disabled','disabled');
                        });
                    </script>
                </div>

            </form>

        </div>
    </div>

    @endsection('content')