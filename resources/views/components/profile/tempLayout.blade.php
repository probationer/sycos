<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">  
        <script src="{{asset('js/profileJs/tabFunctions.js')}}"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link  rel="stylesheet" href="{{asset('vendor/dist/css/bootstrap-select.css')}}"type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{asset('vendor/dist/js/bootstrap-select.js')}}"></script>
        <link href="{{asset('css/profileStyle/teacherProfile.css')}}" rel="stylesheet" type="text/css">
        
        @if($userData['type']=='Teacher')
            <title>{{$userData['detail']->first_name}} | Sycos</title>
        @elseif($userData['type'] == 'Student')
            <title>{{$userData['detail']->studentName}} | Sycos</title>  
        @elseif($userData['type'] == 'Coaching Institute')
            <title>{{$userData['detail']->Institute_name}} | Sycos</title>
        @else

        @endif
    </head>
    
<body>
    
    
    @include('includes.messages')
    @include('components.profile.navigationBarProfile')
    
<div class="container-fluid" style="margin-top:80px;">
    <div class="row">     
        <div class="col-lg-3">
            <div class="collapse navbar-collapse" id="myNavbar1">       
                <div class="left-side">
                    <div class="text-center">
                        <img  class="img-circle" id="profileImage" src="{{asset('/showUserImage/'.$userData['detail']->imageLink)}}" alt="ProfileImage">
                    </div>
                    
                    <div id="profileEssentials" >
                        <div id="profile_name">

                            @if($userData['type']=='Teacher')
                                {{$userData['detail']->first_name}} {{$userData['detail']->last_name}}
                            @elseif($userData['type'] == 'Student')
                                {{$userData['detail']->studentName}} 
                            @elseif($userData['type'] == 'Coaching Institute')
                                {{$userData['detail']->Institute_name}}
                            @else

                            @endif

                            @if($userData['verified'] != '0')
                                <span class="glyphicon glyphicon-ok-circle"></span>
                            @endif
                            
                        </div>
                    
                        <div id="type"> {{$userData['type']}} </div>
                        <br>
                        
                        <div id="status">
                            @if($userData['detail']->status == '1')
                                Available
                            @else
                                Not Available
                            @endif
                        </div>
                        <br>
                        <div id="state">
                            <span class= "glyphicon glyphicon-map-marker"> </span> {{$userData['detail']->state}}
                        </div>
                    </div>

                    @guest

                    @else
                        <div> 
                            <p id="notifications"> 
                                <a href="{{asset('/profile/'.Auth::user()->name.'/requests')}}" > 
                                    <span id="icons" class="glyphicon glyphicon glyphicon-envelope"></span>  
                                    Request 
                                    <?php SycosFunctions::RequestRecivedCount();?>
                                </a>
                            </p>           
                            
                            <p id="articleLeft"> 
                                <a href="{{asset('/article/create')}}">
                                    <span id="icons" class="glyphicon glyphicon-edit"></span>  
                                    Write Article
                                </a>
                            </p>
                            
                            @if(Auth::user()->usertype == 'Teacher' || Auth::user()->usertype == 'Coaching Institute')
                                <p id="video">
                                    <a href="{{asset('/video/create')}}"> 
                                        <span id="icons"  class="glyphicon glyphicon-modal-window"></span>  
                                        Link YouTube Videos 
                                    </a>
                                </p>
                            @elseif(Auth::user()->usertype  == 'Student')
                        
                            @else

                            @endif
        

                            <!---<p id="Stats"> 
                                <a href="javascript:void(0)" onclick="openTab(event, 'Statistics')"> 
                                    <span id="icons" class="glyphicon glyphicon-signal"></span>
                                    Stats
                                <a>
                            </p>---------->
                            <p id="setting"> 
                                <a href="{{asset('/profile/'.Auth::user()->name.'/setting')}}" > 
                                    <span id="icons" class="glyphicon glyphicon-cog"></span>
                                    Settings
                                </a>
                            </p>  
                        </div>
                    @endguest
                </div>
            </div>
           
        </div>
    
     @yield('content')


    <div class="col-lg-3"> 
        <div class="right-side">
            <div class="buttons" >
                @guest
                @else 
                    @if(Auth::user()->name!=$userData['detail']->profilePage)
                        
                        @if(CompanionFunction::CheckRequestSent($userData['detail']->profilePage)=='1')
                            <button type="button" id="addCompanion" class="btn btn-primary" >Waiting for response</button>
                        @elseif(CompanionFunction::CheckCompanion($userData['detail']->profilePage)=='0')
                            <button type="button" id="addCompanion" class="btn btn-primary"
                                onclick="event.preventDefault();document.getElementById('companionAdd').submit();">
                                Add As Companion
                            </button>
                            
                            <form id='companionAdd' action="{{asset('/requestSend/'.$userData['detail']->profilePage)}}" method="post">
                                {{ csrf_field() }}
                            </form>
                        @else
                            
                        @endif
                            
                                @if($userData['type'] == 'Student')
                                    <button type="button" id="contactBtn" onclick="location.assign('{{asset('/profile/'.$userData['detail']->profilePage.'/contactStudent')}}');" class="btn btn-primary" >Contact me</button>
                                @else
                                    <button type="button" id="contactBtn" onclick="location.assign('{{asset('/profile/'.$userData['detail']->profilePage.'/contact')}}');" class="btn btn-primary" >Contact me</button>
                                @endif
                           
                        @endif
                    
                    @endguest
            </div>

            @guest
            @else
                <div class="recomendations">    
                    <center> 
                        <h4 style="padding-top: 10px;">Recommendation</h4>
                    </center>
                    
                    <?php echo Recommendation::rec(); ?>
                    
                </div>
            @endguest
        </div> 
    </div>        
    </div>
</div>
    @if($userData['verified'] == '0')
        @include('includes.verifyEmailForm')
    @endif
    @include('components.profile.footerProfile') 
</body>
</html>
