<section class="menu cid-qWhny2p0ZI" once="menu" id="menu1-r">
        <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm bg-color transparent">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="menu-logo">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="">
                            <img src="{{asset('assetsHome/images/logono-background-364x126.png')}}" alt="Mobirise" title="" style="height: 4.1rem;">
                        </a>
                    </span>
                    
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        <li class="nav-item">
                            <a class="nav-link link text-white display-4" href="{{asset('/')}}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-white dropdown-toggle display-4" href="javascript:void(0)" data-toggle="dropdown-submenu" aria-expanded="false">Find A Tutor</a>
                            <div class="dropdown-menu">
                                <a class="text-white dropdown-item display-4" href="{{asset('/search')}}">Search A Tutor<br></a>
                                <a class="text-white dropdown-item display-4" href="{{asset('/get_recommendation')}}">Get Recommendation</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-white dropdown-toggle display-4" href="javascript:void(0)" data-toggle="dropdown-submenu" aria-expanded="false">How we work</a>
                            <div class="dropdown-menu">
                                <a class="text-white dropdown-item display-4" href="{{asset('/student')}}">For Students<br></a>
                                <a class="text-white dropdown-item display-4" href="{{asset('/teacher')}}">For Teachers<br></a>
                                <a class="text-white dropdown-item display-4" href="{{asset('/institute')}}">For Institutes<br></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-white dropdown-toggle display-4" href="javascript:void(0)" aria-expanded="true" data-toggle="dropdown-submenu">Explore</a>
                            <div class="dropdown-menu">
                                <a class="text-white dropdown-item display-4" href="{{asset('/article')}}" aria-expanded="true">Read Articles</a>
                                <a class="text-white dropdown-item display-4" href="{{asset('/video')}}" aria-expanded="true">Watch Videos</a>
                                <a class="text-white dropdown-item display-4" href="http://counselling.sycos.in" aria-expanded="true">Career Counselling</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-white dropdown-toggle display-4" href="javascript:void(0)" data-toggle="dropdown-submenu" aria-expanded="false">About Us</a>
                            <div class="dropdown-menu">
                                <a class="text-white dropdown-item display-4" href="{{asset('/about')}}">About Sycos<br></a>
                                <a class="text-white dropdown-item display-4" href="{{asset('/signup')}}">Join Us<br></a>
                                <a class="text-white dropdown-item display-4" href="{{asset('/suggestions')}}">Contact Us<br></a>
                                <a class="text-white dropdown-item display-4" href="{{asset('/sycos_team')}}">Our Team<br></a>
                            </div>
                        </li>
                        @if(!Auth::user())
                            <div class="navbar-buttons mbr-section-btn">
                                <a class="btn btn-sm btn-info display-4" href="{{asset('/login')}}">
                                    <span class="mbri-unlock mbr-iconfont mbr-iconfont-btn"></span>Login
                                </a> 
                                <a class="btn btn-sm btn-info display-4" href="{{asset('/signup')}}">
                                    <span class="mbri-edit mbr-iconfont mbr-iconfont-btn"></span>Sign Up
                                </a>
                            </div>
                        @else
                            <li class="nav-item">
                                <a class="nav-link link text-white display-4" href="{{asset('profile')}}">
                                    <?php echo Auth::user()->name; ?>
                                </a>
                            </li>
                            
                        @endif
                    </ul>

                    
                        
                </div>
        </nav>
    </section>

    @include('includes.messages')