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

    <title>{{$userData['detail']->studentName}} | Sycos</title>
    </head>
    
<body onload="openTab(event, 'Detail')">

    @if($userData['verified'] === '0')
        @include('includes.verifyEmailForm')
    @endif

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('/storage/logo/logo(NO_background).png')}}"alt="Sycos.in" id="image1" width="130px" height="auto" style="margin-top:-10px">
                </a>
            </div>
            <div class="navbar-header" style="margin-top:-40px;">
                        <button type="button" class="navbar-toggle"data-toggle="slide-collapse" data-target="#myNavbar" >
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
            </div>  
            <div class="navbar-header" style="margin-top:-53px;float:left; margin-left:4px;">
                    <button type="button" class="navbar-toggle"data-toggle="slide-collapse" data-target="#myNavbar1" >
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
            </div>    
        
            <div class="collapse navbar-collapse" id="myNavbar">  
                <ul class="nav navbar-nav">
                    <li><a id="anchorDesign" href="../">Home</a></li>
                    
                        @guest
                        <li><a  id="anchorDesign" href="../login">Login</a></li>
                        <li><a  id="anchorDesign " href="../signup">Sign Up</a></li>
                            
                        @else
                        <li>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-toggle="dropdown">
                                    <span style="font-size:22px; margin-top:12px;" class="glyphicon glyphicon-user"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{asset('/profile/'.Auth::user()->name)}}">Profile</a></li>
                                    <li><a href="#">Notifications</a></li>
                                    <li><a href="javascript:void(0)" onclick="openTab(event,'settings')" > Settings</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        @endguest
                    
                    <li><a id="anchorDesign" href="#">New Feeds</a></li>
                
                    
                </ul>
                <li style="margin-right: 25px; list-style:none;">
                        <form class="navbar-form navbar-right" method="get" action="search_result/search_result">
                            <div class="input-group">
                                <input type="text" class="form-control" name="second" id="search" style="font-family: roboto; font-weight: 400;" placeholder="Search...."/>
                                <div class="input-group-btn">
                                <button class="btn btn-danger" type="submit" name="search">
                                    <i class="glyphicon glyphicon-search" style="color:white;"></i>
                                </button>
                                </div>
                            </div>
                        </form>
                    </li>
            </div>
            <script>
            $('[data-toggle="slide-collapse"]').on('click', function() {
                    $navMenuCont = $($(this).data('target'));
                    $navMenuCont.animate({'width':'toggle'}, 350);
                });
            </script>
        </div>  
    </nav>
  
    @include('includes.messages')
<div class="container-fluid">
    <div class="row">     
        <div class="col-lg-3">
        <div class="collapse navbar-collapse" id="myNavbar1">       
        <div class="left-side">
            <img  class="img-circle" style="margin-left:60px; margin-top:70px; width:130px;height:130px" src="{{asset('/storage/profileImage/default.png')}}" alt="ProfileImage">
            <div id="profileEssentials" >
                <div id="profile_name">
                    {{$userData['detail']->studentName}}
                    @if($userData['verified'] !== '0')
                        <span class="glyphicon glyphicon-ok-circle"></span>
                    @endif
                </div>
                @guest
                    <?php  redirect('/login')?>
                @else
                    <div id="type">Student</div><br>
                @endguest
                
                <div id="status">
                    @if($userData['detail']->status)
                        Available
                    @else
                        Not Available
                    @endif
                </div>
                <br>
                <div id="state">
                    <span class= "glyphicon glyphicon-map-marker"> </span> {{$userData['detail']->state}}</small>
                </div>
            </div>

            @guest

            @else
                <div>            
                    
                    <p id="articleLeft"> 
                        <a href="../article/create">
                            <span id="icons" class="glyphicon glyphicon-edit"></span>  
                            Write Article
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
        <div class="buttons" style="margin">
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
       <div class="recomendations">    
            <center> 
                <h4 style="padding-top: 10px;">Recommendation</h4>
            </center>
            
            <?php echo Recommendation::rec(); ?>
        </div>
    </div> 
     </div>        
</div>
</div>

    <footer class="">
        
        <div class="footer_row ">
            <hr style="">
            <ul style="list-style:none;color:black">
                <li class=" footer_links">
                    <div class="col-lg-9 left">                             <!-- change-3 col-sm-9  to col-lg-9  -->
                        <a id="footerLineLeft" href="{{asset('/about')}}">About Us |</a>
                        <a id="footerLineLeft" href="{{asset('/terms')}}">Terms of service |</a>
                        <a id="footerLineLeft" href="{{asset('/privacy_policy')}}">Privacy Policy |</a>   
                        <a id="footerLineLeft" href="{{asset('/public-suggestions')}}"style="margin-left:px;">Request a feature |</a>
                        <a id="footerLineLeft" href="{{asset('/public-suggestions')}}">Any Suggestion</a>
                    </div>                                             
                    <div class="col-lg-3">
                        <a id="footerParaRight">Copyright © 2018 <span id="footerSycosIn">Sycos.in</span> All Right Reserved</a>
                    </div>
                </li>
            </ul>
            
        </div>
        
    </footer>     
</body>
</html>
