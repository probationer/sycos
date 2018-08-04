<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{asset('/')}}">
                <img src="{{asset('/storage/logo/logo(NO_background).png')}}"alt="Sycos.in" id="image1" width="130px" height="auto" style="margin-top:-10px">
            </a>
        </div>
        <div class="navbar-header" style="margin-top:-40px;">
            <button type="button" class="navbar-toggle" data-toggle="slide-collapse" data-target="#nav1" >
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
        </div>  
        
        <div class="navbar-header" style="margin-top:-53px;float:left; margin-left:4px;">
            <button type="button" class="navbar-toggle" data-toggle="slide-collapse" data-target="#myNavbar1" >
                <span class="glyphicon glyphicon-user" style="color:white;"></span>                       
            </button>
        </div>    
        
        <div class="collapse navbar-collapse" id="nav1">  
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
                    <form class="navbar-form navbar-right" method="get" action="{{asset('/search/')}}">
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
        
    </div>  
</nav>
<script>
    $('[data-toggle="slide-collapse"]').on('click', function() {
        $navMenuCont = $($(this).data('target'));
        $navMenuCont.animate({'width':'toggle'}, 350);
    });
</script>