@extends('components.profile.tempLayout')

@section('content')

<?php

if(Auth::user()){
    if(old('articlePrivacy'))
        $articlePrvc = old('articlePrivacy'); 
    else
        $articlePrvc = Auth::user()->articlePrivacy;

    if(old('videoPrivacy'))
        $videoPrvc = old('videoPrivacy'); 
    else
        $videoPrvc = Auth::user()->videoPrivacy;
    
    if(old('commentPrivacy'))
        $commentPrvc = old('commentPrivacy'); 
    else
        $commentPrvc = Auth::user()->commentPrivacy;
}
?>

    <div class="col-md-6">
            @guest
                
            @else
                <div id="settings" >
                    
                        <div class="row">
                            <div class="col-sm-12">
                            <h2 id="boldDetials" style=" margin-top:40px;"> Settings  </h2>  
                            </div>  
                                        
                        </div>

                        
                        <div class="row">
                            <div class="col-sm-12">
                            <h5 id="boldDetials" style=" margin-top:40px;">
                                <a class="btn btn-primary" href="{{asset('profile/'.$userData['detail']->profilePage.'/edit')}}"><span class="glyphicon glyphicon-user"></span> 
                                    Edit Profile Details
                                </a>
                            </h5>  
                            </div>  
                                    
                        </div>
                        <form style="margin-top:30px;"  id="passwordchange" action="{{asset('/changePassword/'.$userData['detail']->profilePage)}}" method="post">
                            {{csrf_field()}}
                            <div class="row">

                                <div class="col-sm-6" id="boldDetials" style="">
                                    <h4 >
                                            Change Password
                                    </h4> 
                                    
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="oldpassword" name="oldPassword" placeholder="Current Password"  required>
                                            <input type="password" class="form-control" id="pwd" name="password" placeholder="New Password" value="{{old('password')}}" required>
                                            <input type="password" class="form-control" id="pwd" name="password_confirmation" placeholder="Confirm  Password" required>
                                        </div>
                                        <button type="button" onclick="event.preventDefault();document.getElementById('passwordchange').submit();" class="btn btn-primary">Change Password</button>
                                    
                                </div>         
                            </div>
                        </form>

                        <form  id="privacysetting"  style="margin-top:40px;" action="{{asset('/privacy/'.$userData['detail']->profilePage)}}" method="post">
                            {{csrf_field()}}
                        <div id="boldDetials">
                            <h4>Content Privacy</h4>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>Who can read you Articles ?</h5>  
                                </div> 
                                
                                    <?php        
                                        SycosFunctions::MarkSelectedRadio($articlePrvc,SycosFunctions::PutList('privacy'),'articlePrivacy');
                                    ?> 
                                
                            </div>
                        
    
                            @if(Auth::user()->usertype!='Student')
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h5>Who can see your video list? </h5>  
                                    </div> 
                                    <?php        
                                            SycosFunctions::MarkSelectedRadio($videoPrvc,SycosFunctions::PutList('privacy'),'videoPrivacy');
                                    ?> 
                                </div>
                            @endif
                            
    
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>Who can comment on your profile? </h5>  
                                </div> 
                                <?php        
                                    SycosFunctions::MarkSelectedRadio($commentPrvc,SycosFunctions::PutList('privacy'),'commentPrivacy');
                                ?>  
                            </div> 
        
                            <div class="row">
                                <div class="col-sm-10">
                                    <button type="button" onclick="event.preventDefault();document.getElementById('privacysetting').submit();" class="btn btn-primary">Save Preferences</button>
                                </div>
                            </div>
                                
    
                        </div>
                        </form>
                    
                </div>  
    
                <div id="notify" class="tabcontent">
                        <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top:20px;">
                                        <h4>Requests Sent to you</h4>
                                    </div>
                                    
                                </div>
                                
                
                                <div class="row">
                                    <div class="col-md-12" style="margin-top:20px;">
                                            <table class="table table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Viewed</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                           <?php  SycosFunctions::RequestRecived(Auth::user()->name);?>
                                                    </tbody>
                                                  </table>
                                    </div>
                                </div>
                            </div>
                </div>
    
            @endguest
    </div>


@endsection('content')