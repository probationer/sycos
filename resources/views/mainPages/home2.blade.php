<!DOCTYPE html>
<html >
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{asset('assetsHome/images/logono-background-364x126.png')}}" type="image/x-icon">
  <meta name="description" content="Website Creator Description">
  <title>Search Study Companion</title>
  <link rel="stylesheet" href="{{asset('assetsHome/web/assets/mobirise-icons/mobirise-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/tether/tether.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/bootstrap/css/bootstrap-grid.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/bootstrap/css/bootstrap-reboot.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/dropdown/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/socicon/css/styles.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/animatecss/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/theme/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/mobirise/css/mbr-additional.css')}}" type="text/css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
  
  <style>
        .input-group {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-box;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: center;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
        }
        @media only screen and (max-width: 600px) {   
            .btn {
            font-weight: 500;
            border-width: 2px;
            font-style: normal;
            letter-spacing: 1px;
            margin: 4.4rem -2.2rem;
            white-space: normal;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            padding: 1.19rem 1rem;
            border-radius: 3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            word-break: break-word;
        }
        .form-control {
            display: block;
            margin-left: -30px;
            margin-right: 47px;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
      
      }
  </style>

</head>
<body>
    @include('mainPages.mainPagesNav')



    <section class="cid-qVROMpTbJH mbr-fullscreen mbr-parallax-background" id="header2-i">  

        <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(7, 59, 76);"></div>

        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-2"><span style="font-weight: normal;">
                        Search Your Companion Of Studies</span></h1>
                    <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                        
                    <div>The Intellectual Network</div></h3>
                    <div class="mbr-section-btn" style="width:80%; display:block; float:unset; margin-left:10%;">
                        <form method="get" action="{{asset('/search/')}}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="query" style="font-family: roboto; font-size:1rem; font-weight: 400;" placeholder="Search Teachers, Students, Coaching Centers.. etc"/>
                                <div class=" input-group-btn">
                                    <button class="btn btn-danger" type="submit" name="search" style="font:200 1rem roboto;">
                                         Search
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <section class="carousel slide cid-qWho36Ooao" data-interval="false" id="slider1-s">   

        <div class="full-screen">
            <div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="4000">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item slider-fullscreen-image" data-bg-video-slide="false" style="background-image: url({{asset('assetsHome/images/mbr-1624x1080.jpg')}});">
                        <div class="container container-slide"><div class="image_wrapper"><div class="mbr-overlay" style="opacity: 0.7;"></div>
                        <img src="{{asset('assets/images/1.jpg')}}"><div class="carousel-caption justify-content-center"><div class="col-10 align-center"><h2 class="mbr-fonts-style display-1">Coaching Near You</h2><p class="lead mbr-text mbr-fonts-style display-5">Search According to your location</p></div></div></div></div>
                    </div>
                    <div class="carousel-item slider-fullscreen-image" data-bg-video-slide="false" style="background-image: url({{asset('assetsHome/images/mbr-1620x1080.jpg')}});">
                        <div class="container container-slide"><div class="image_wrapper"><div class="mbr-overlay"></div>
                        <img src="{{asset('assetsHome/images/2.jpg')}}"><div class="carousel-caption justify-content-center"><div class="col-10 align-left">
                            <h2 class="mbr-fonts-style display-1"><a href="{{asset('article/create')}}" style="color:white;">Write Article And Gain Popularity</a></h2>
                                <p class="lead mbr-text mbr-fonts-style display-5">You can write your unique article, notes for your students, or for other companions,</p></div></div></div></div>
                    </div>
                    <div class="carousel-item slider-fullscreen-image active" data-bg-video-slide="false" style="background-image: url({{asset('assetsHome/images/mbr-1-1620x1080.jpg')}});"><div class="container container-slide"><div class="image_wrapper"><div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(91, 104, 107);"></div>
                                    <img src="{{asset('assetsHome/images/mbr-1-1620x1080.jpg')}}">
                                    <div class="carousel-caption justify-content-center">
                                        <div class="col-10 align-right">
                                    <h2 class="mbr-fonts-style display-1">"A flower needs a medium to spread its fragrance " 
                        </h2><p class="lead mbr-text mbr-fonts-style display-4">Sycos.in provides you that "medium" to spread your fragrance of knowledge and enhance it further. 
                        <br>Connect with us and support us by sharing this initiative as well. 
                        <br>We request all the students,teachers or coaching institutions to register themselves for free. &nbsp;<br></p></div></div></div></div>
                    </div>
                    <div class="carousel-item slider-fullscreen-image" data-bg-video-slide="false" style="background-image: url({{asset('assetsHome/images/mbr-2-1620x1080.jpg')}});"><div class="container container-slide"><div class="image_wrapper"><div class="mbr-overlay" style="opacity: 0.7;"></div><img src="{{asset('assetsHome/images/2.jpg')}}"><div class="carousel-caption justify-content-center"><div class="col-10 align-left">
                        <h2 class="mbr-fonts-style display-1"><a href="{{asset('video/create')}}" style="color:white;">Link you YouTube Tutorials</a></h2>
                        <p class="lead mbr-text mbr-fonts-style display-5">You can link your youtube video and add link in your article</p></div></div></div></div>
                    </div>
                </div>

                <a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider1-s"><span aria-hidden="true" class="mbri-left mbr-iconfont"></span><span class="sr-only">Previous</span></a><a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider1-s"><span aria-hidden="true" class="mbri-right mbr-iconfont"></span><span class="sr-only">Next</span></a>
            </div>
        </div>

    </section>

    
    <section class="header1 cid-qVROMWyHOc mbr-fullscreen mbr-parallax-background" id="header1-j">

        

            <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(0, 0, 0);">
            </div>
    
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="mbr-white col-md-10">
                        <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1"><span style="font-weight: normal;">Add Your Study Companions</span></h1>
                        <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">Create Your Own Intellectual &nbsp;network</h3>
                        
                        <div class="mbr-section-btn align-center"><a class="btn btn-md btn-primary display-4" href="{{asset('/article')}}">Check Articles/Notes</a>
                            <a class="btn btn-md btn-primary display-4" href="{{asset('/video')}}">Check Linked Videos</a></div>
                    </div>
                </div>
            </div>
    
        </section>

    @if(count($articleArray['articles']) > 0)
    <section class="features17 cid-qVV7hO2Rk4" id="features17-m" style="background-color:#ad4d4d;">
        
        <div class="container-fluid">
                <h1 class="text-center" style="color:white; font-family:'oxygen">Read Articles</h1>
                <br>
            <div class="media-container-row" >
                
                @for($i = 0; $i<min(6,count($articleArray['articles'])); $i++)
                        
                <div class="card p-3 col-12 col-md-4 col-lg-2" >
                    <div class="card-wrapper" >
                        
                        <div class="card-box" style="height:300px;" >
                            <h2 class="card-title pb-3 mbr-fonts-style display-7" style="font:bold 16px roboto;overflow:hidden;">
                                {{strtoupper($articleArray['articles'][$i]->title)}}
                            </h2>
                            <p class="mbr-text mbr-fonts-style display-7" style="font:500 12px arial;">
                                <?php 
                                    $body = strip_tags($articleArray['articles'][$i]->body);
                                    $subStr = substr($body,0,250).'.... <a href="'.asset('article/'.$articleArray['articles'][$i]->link).'" style="color:blueviolet;">Read More</a>';
                                ?>
                                {!!$subStr!!}
                            </p>
                        </div>
                    </div>
                </div>

                @endfor
            </div>
        </div>
    </section>
    @endif

    <section class="counters1 counters cid-qVV7pimXm7" id="counters1-o">

        

        

        <div class="container">
            <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">Current Statistics</h2>
            

            <div class="container pt-4 mt-2">
                <div class="media-container-row">
                    <div class="card p-3 align-center col-12 col-md-6 col-lg-3">
                        <div class="panel-item p-3">
                            <div class="card-img pb-3">
                                <span class="mbr-iconfont mbri-edit"></span>
                            </div>

                            <div class="card-text">
                                <h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
                                    <?php echo SycosFunctions::articleCount();?>
                                </h3>
                                <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
                                    Articles</h4>
                                
                            </div>
                        </div>
                    </div>


                    <div class="card p-3 align-center col-12 col-md-6 col-lg-3">
                        <div class="panel-item p-3">
                            <div class="card-img pb-3">
                                <span class="mbr-iconfont mbri-user"></span>
                            </div>
                            <div class="card-text">
                                <h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
                                        <?php echo SycosFunctions::companionsCount();?>
                                </h3>
                                <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
                                    Study Companions</h4>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card p-3 align-center col-12 col-md-6 col-lg-3">
                        <div class="panel-item p-3">
                            <div class="card-img pb-3">
                                <span class="mbr-iconfont mbri-video-play"></span>
                            </div>
                            <div class="card-text">
                                <h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
                                        <?php echo SycosFunctions::videoCount();?>
                                </h3>
                                <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
                                    Linked Videos</h4>
                                
                            </div>
                        </div>
                    </div>


                    <div class="card p-3 align-center col-12 col-md-6 col-lg-3">
                        <div class="panel-item p-3">
                            <div class="card-img pb-3">
                                <span class="mbri-hot-cup mbr-iconfont"></span>
                            </div>

                            <div class="card-texts">
                                <h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
                                        <?php echo SycosFunctions::requestCount();?>
                                    </h3>
                                <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
                                    Request Send</h4>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <section class="header3 cid-qWtS47vzqf mbr-fullscreen" id="header3-u">

        

        

        <div class="container">
            <div class="media-container-row">
                <div class="mbr-figure" style="width: 70%;">
                    <img src="{{asset('assetsHome/images/8-818x669.jpg')}}" alt="Mobirise" title="">
                </div>

                <div class="media-content">
                    <h1 class="mbr-section-title mbr-white pb-3 mbr-fonts-style display-1">
                        Connect to create your<br>own destiny</h1>
                    
                    <div class="mbr-section-text mbr-white pb-3 ">
                        <p class="mbr-text mbr-fonts-style display-5"></p>
                    </div>

                    @guest
                    <div class="mbr-section-btn">
                        <a class="btn btn-md btn-info display-7" href="{{asset('/signup')}}">SignUp</a>
                        <a class="btn btn-md btn-info display-7" href="{{asset('/login')}}">Login</a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>

    </section>

    @include('mainPages.mainpageFooter')


    <script src="{{asset('assetsHome/web/assets/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assetsHome/popper/popper.min.js')}}"></script>
    <script src="{{asset('assetsHome/tether/tether.min.js')}}"></script>
    <script src="{{asset('assetsHome/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assetsHome/smoothscroll/smooth-scroll.js')}}"></script>
    <script src="{{asset('assetsHome/dropdown/js/script.min.js')}}"></script>
    <script src="{{asset('assetsHome/touchswipe/jquery.touch-swipe.min.js')}}"></script>
    <script src="{{asset('assetsHome/viewportchecker/jquery.viewportchecker.js')}}"></script>
    <script src="{{asset('assetsHome/parallax/jarallax.min.js')}}"></script>
    <script src="{{asset('assetsHome/ytplayer/jquery.mb.ytplayer.min.js')}}"></script>
    <script src="{{asset('assetsHome/vimeoplayer/jquery.mb.vimeo_player.js')}}"></script>
    <script src="{{asset('assetsHome/bootstrapcarouselswipe/bootstrap-carousel-swipe.js')}}"></script>
    <script src="{{asset('assetsHome/theme/js/script.js')}}"></script>
    <script src="{{asset('assetsHome/slidervideo/script.js')}}"></script>
    
    
    <input name="animation" type="hidden">
  </body>
</html>