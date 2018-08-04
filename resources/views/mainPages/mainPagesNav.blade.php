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
                    <li class="nav-item"><a class="nav-link link text-white display-4" href="{{asset('/about')}}">About</a></li>
                    <li class="nav-item"><a class="nav-link link text-white display-4" href="{{asset('/feeds')}}">Explore</a></li>
                </ul>
                <div class="navbar-buttons mbr-section-btn">
                    @guest
                    <a class="btn btn-sm btn-info display-4" href="{{asset('/login')}}">
                        <span class="mbri-unlock mbr-iconfont mbr-iconfont-btn"></span>Login
                    </a> 
                    <a class="btn btn-sm btn-info display-4" href="{{asset('/signup')}}">
                        <span class="mbri-edit mbr-iconfont mbr-iconfont-btn"></span>Sign Up
                    </a>
                    @else
                    <li class="nav-item">
                        
                            <a class="nav-link link text-white display-4" href="{{asset('/profile')}}">
                                {{Auth::user()->name}}
                            </a>
                            
                        
                    </li>
                    @endguest
                </div>
            </div>
        </nav>
    </section>

    @include('includes.messages')