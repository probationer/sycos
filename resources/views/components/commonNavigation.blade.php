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

    <title> {{$userData['title']}} | Sycos </title>
    </head>
    
<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{asset('/')}}">
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
                    <button type="button" class="navbar-toggle"data-toggle="slide-collapse" data-target="#myNavbar" >
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
            </div>    
        
            <div class="collapse navbar-collapse" id="myNavbar">  
                <ul class="nav navbar-nav">
                    <li><a id="anchorDesign" href="{{asset('/')}}">Home</a></li>
                    
                        @guest
                        <li><a  id="anchorDesign" href="{{asset('/login')}}">Login</a></li>
                        <li><a  id="anchorDesign " href="{{asset('/signup')}}">Sign Up</a></li>
                            
                        @else
                        <li class="dropdown" >
                       
                                <a href="javascript:void(0);" data-toggle="dropdown" id="anchorDesign">
                                    {{Auth::user()->name}}<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{asset('/profile/'.Auth::user()->name)}}">Profile</a></li>
                                    <li><a href="#">Notifications</a></li>
                                    <li><a href="{{asset('/profile/'.Auth::user()->name.'/setting')}}">Settings</a></li>
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
                            
                        </li>
                        
                        @endguest
                    
                    <li><a id="anchorDesign" href="{{asset('/feeds')}}">New Feeds</a></li>
                
                    
                </ul>
                <li style="margin-right: 25px; list-style:none;">
                        <form class="navbar-form navbar-right" method="get" action="{{asset('/search')}}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="query" id="search" style="font-family: roboto; font-weight: 400;" placeholder="Search...."/>
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
    
    @yield('content')


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
