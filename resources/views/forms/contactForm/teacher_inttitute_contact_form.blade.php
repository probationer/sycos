@extends('components.profile.tempLayout')

@section('content')



<center>
<div class="col-md-6 text-left" id="contactForm">

        <form  method="post"  class="form-horizontal userlogin-container animate" id="Form_contactMe" action="{{asset('/profile/'.$userData['detail']->profilePage.'/contact')}}">
            <div class="container-fluid">
                <div class="form-group">
                    {{ csrf_field() }}
                    <div class="col-md-12" id="form_header1">
                        <H2 id="getInTouch">Get In Touch</H2>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 {{ $errors->has('Student_Name') ? ' has-error' : '' }}">
                        <label id="contactnameHeading">Your Name</label>
                        <input type="text" id="contactnameInput" class="form-control" name="Student_Name" value="{{ old('Student_Name') }}" placeholder=" Full Name" required>
                        @if ($errors->has('Student_Name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Student_Name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" >
                        <label id="contactsubjectHeading" >Subjects you want to study</label>
                        <select id="contactsubjectInput" name="subjects[]" required="" class="selectpicker show-menu-arrow form-control" required="" multiple data-max-options="24" data-live-search="true">
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

                    <div class="col-md-12" >
                        <label id="contactclassHeading">Your Class / Course </label>
                        <select id="contactclassInput" class="selectpicker show-menu-arrow form-control" name="class[]" required="" multiple data-max-options="5">
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
                    <div class="col-md-12" >
                        <label id="contactBudgetHeading">Budget</label>
                        <input type="text" id="contactBudgetInput"  class="form-control" name="budget" value="{{ old('budget') }}" placeholder="Enter your budget per month or per hours">
                        
                        @if ($errors->has('budget'))
                            <span class="help-block">
                                <strong>{{ $errors->first('budget') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" >
                        <label id="contactAreaHeading">Location(or Area) </label>
                        <input type="text" id="contactAreaInput"  class="form-control" name="area" value="{{ old('area') }}" placeholder=" Where you want class" required>

                        @if ($errors->has('area'))
                            <span class="help-block">
                                <strong>{{ $errors->first('area') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" >
                        <label id="ContactInfoHeading">Any Message</label>
                        <textarea type='text' id="ContactInfoInput" class="form-control" rows="5" name="message" placeholder="Enter your message" >{{ old('message') }}</textarea>                       
                        @if ($errors->has('message'))
                            <span class="help-block">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" >
                        <button type="submit" class="btn btn-primary "  id="submitContactForm" name="submitContactInfo">Send Request</button>
                    </div>
                </div>
                
            </div>
        </form>

    </div>


</center>

    @endsection('content')