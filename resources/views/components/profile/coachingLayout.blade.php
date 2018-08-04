<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">  
        <script src="{{asset('js/profileJs/tabFunctions.js')}}"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="{{asset('css/profileStyle/teacherProfile.css')}}" rel="stylesheet" type="text/css">
        
    <title>{{$userData['detail']->Institute_name}} | Sycos</title>
    </head>
    
<body onload="openTab(event, 'Detail')">
    @if($userData['verified'] === '0')
        @include('includes.verifyEmailForm')
    @endif
    
    @include('components.profile.navigationBarProfile')

    @include('includes.messages')
<div class="container-fluid">
    <div class="row">     
        <div class="col-lg-3">
        <div class="collapse navbar-collapse" id="myNavbar1">       
        <div class="left-side">
            <img  class="img-circle" style="margin-left:60px; margin-top:70px; width:130px;height:130px" src="{{asset('/storage/profileImage/default.png')}}" alt="ProfileImage">
            <div id="profileEssentials" >
                <div id="profile_name">
                    {{$userData['detail']->Institute_name}} 
                    @if($userData['verified'] !== '0')
                        <span class="glyphicon glyphicon-ok-circle"></span>
                    @endif
                    
                </div>
                @guest
                    <?php return  redirect('/login');?>
                @else
                    <div id="type"> Teacher </div><br>
                @endguest
                
                <div id="status">
                    @if($userData['detail']->status === '1')
                        Available
                    @else
                        Not Available
                    @endif
                </div>
                <br>
                <div id="state"><span class= "glyphicon glyphicon-map-marker"> </span> {{$userData['detail']->state}}</small></div>
            </div>

            @guest

            @else
                <div> 
                    <p id="notifications"> 
                        <a href="javascript:void(0)" onclick="openTab(event, 'notify')">
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
                    
                    <p id="video">
                        <a href="{{asset('/video/create')}}"> 
                            <span id="icons"  class="glyphicon glyphicon-modal-window"></span>  
                            Link YouTube Videos 
                        </a>
                    </p>

                    <!---<p id="Stats"> 
                        <a href="javascript:void(0)" onclick="openTab(event, 'Statistics')"> 
                            <span id="icons" class="glyphicon glyphicon-signal"></span>
                            Stats
                        <a>
                    </p>---------->
                    <p id="setting"> 
                        <a href="javascript:void(0)" onclick="openTab(event, 'settings')"> 
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
                    @if(Auth::user()->name!==$userData['detail']->profilePage)
                        
                        @if(CompanionFunction::CheckRequestSent($userData['detail']->profilePage)==='1')
                            <button type="button" id="addCompanion" class="btn btn-primary" >Waiting for response</button>
                        @elseif(CompanionFunction::CheckCompanion($userData['detail']->profilePage)==='0')
                            <button type="button" id="addCompanion" class="btn btn-primary"
                                onclick="event.preventDefault();document.getElementById('companionAdd').submit();">
                                Add As Companion
                            </button>
                            
                            <form id='companionAdd' action="{{asset('/requestSend/'.$userData['detail']->profilePage)}}" method="post">
                                {{ csrf_field() }}
                            </form>
                        @else
                            
                        @endif

                        <button type="button" id="contactBtn" onclick="location.assign('{{asset('/profile/'.$userData['detail']->profilePage.'/contactStudent')}}');" class="btn btn-primary" style="margin-top:10px; padding-left:25px;padding-right:25px;">Contact me</button>
                        
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

    @include('components.profile.footerProfile') 
</body>
</html>
