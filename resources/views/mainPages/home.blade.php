<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Search Study Companion</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{asset('css/index.css')}}" rel="stylesheet" type="text/css">

     </head>
     <style>
         .top1{
             
            background-image: url('../public/storage/icons/map.png');
         } 
    </style>
     
 <body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    <img src="{{asset('storage/icons/logo(NO_background).png')}}" width="135px"; height="auto" style="margin:5px;"> 
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
        </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="{{asset('/')}}">Home</a></li>
        <li><a href="{{asset('/about')}}">About Us</a></li>
        <li><a href="{{asset('/feeds')}}">Explore</a></li>
      </ul>
        <ul class="nav navbar-nav navbar-right ">
            @guest
                <li><a href="{{asset('/signup')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="{{asset('/login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        
                @else
                <li>
                    <div class="dropdown">
                        <a href="javascript:void(0);" style="color:white;" data-toggle="dropdown">
                            <span style="font-size:22px; margin:12px;" class="glyphicon glyphicon-user"></span> 
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{asset('/profile/'.Auth::user()->name)}}">Profile</a></li>
                            <li><a href="#">Notifications</a></li>
                            <li><a href="#">Settings</a></li>
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
        </ul>
    </div>
  </div>
</nav>
  	
        <!-- input search --> 
     
<div class="top1">    
    
    
    <div class="container">
        <div class="row searchFilter" >
            <div class="searchf" style="">
                <div class="col-sm-6" >
                    <form method="Get" action="{{asset('/search/')}}" >  
                        <div class="input-group" >      
                                <input id="search" type="search" name="query" class="form-control" aria-label="Text input with segmented button dropdown" >
                            <div class="input-group-btn" >
                                <button type="button" id="button_submit" class="btn btn-primary dropdown-toggle dropdown-toggle-split" name="search" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    <span class="label-icon" >Category</span> <span class="caret" >&nbsp;</span>
                                </button>
                                
                                <div class="dropdown-menu dropdown-menu-right" >
                                    <ul class="category_filters" >
                                        <li >
                                        <input class="cat_type category-input" data-label="All" id="all" value="all" name="type" type="radio" ><label for="all" >All</label>
                                        </li>
                                        <li >
                                        <input type="radio" name="type" id="Student" value="Students" ><label class="category-label" for="Student" >Students</label>
                                        </li>
                                        <li >
                                        <input type="radio" name="type" id="Teacher" value="Teachers" ><label class="category-label" for="Teacher" >Teachers</label>
                                        </li>
                                        <li >
                                        <input type="radio" name="type" id="Coaching_center" value="Institutes" ><label class="category-label" for="Coaching center" >Coaching Institute</label>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <button id="searchBtn" type="submit" name="search " class="btn btn-danger" >
                                    <span class="glyphicon glyphicon-search" >&nbsp;</span> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">     
                <div class="lefttext" >
                    <div id="aflower">A flower needs a medium to spreads its fragrance</div>
                </div>
            </div>
        <div class="col-lg-7">
            <div class="righttext" style="">
                <h3>Sycos.in provides you that "medium" to 
                    spread your fragrance of knowledge 
        and enhance it further. Connect with 
        us and support us by sharing this 
        initiative as well. We request all 
        the students,teachers or coaching 
        institutions to register themselves 
                    for free.</h3>
            </div>
        </div>
        </div>
    </div>
     </div>
		<!--button and links-->

    <!--middle section and sign-in button-->
	
    <div class="middle-section">
    <div class="container">    
    <div class="row"> 
    <div class="col-lg-6">    
      <img src="{{asset('storage/icons/studentIntrouble.')}}png" alt="studentIntrouble" class="img-responsive" id="middlesection"  style="padding-top:40px;margin-left:0%;">
    </div>
   <div class="col-lg-6">        
    <div class="secondrighttext"> 
        <h1 id="secondrighttext">
        Connect to create<br>
        your own destiny</h1>  
         <h2><?php echo SycosFunctions::articleCount();?></h2>
         <h2><?php echo SycosFunctions::videoCount();?></h2>
         <h2><?php echo SycosFunctions::companionsCount();?></h2>
         <h2><?php echo SycosFunctions::requestCount();?></h2>
     </div>
     </div>   
     </div>    
     </div> 
     </div>    




   <!--  box  code, middle section-----------------------------> 
     <div class="middlebox">
        <div class="text-center">
                <h4 class="our-mission" style="margin-top:20px; font-size:30px; padding-top:20px;color: white;">Benefits:</h4>
	     <hr id="hr1">
		</div>
	<div class="benefits">
    <div class="container-fluid">    
      <div class="col-lg-4">
	   <div class="first_box">
               <img src="{{asset('storage/icons/student (1).')}}png">   
	    <h4 style="font-weight:bold;">Beneficial for students-</h4><br>
	    <p style="font-size:19px;">A student can now skip the herculean task of searching a quality teacher of
           his own choice nearby , as he can now have a number of skilful teachers to choose from.</p>
	   </div>
	  </div>
	  <div class="col-lg-4">
	   <div class="second_box">
               <img src="{{asset('storage/icons/presentation.')}}png">
	    <h4 style="font-weight:bold;">Beneficial for teachers-</h4><br>
	    <p style="font-size:19px;">it can be very helpful to teachers as well as they can now connect with more
           students and enlighten them with their expertise and knowledge without much painstaking.</p>
	   </div>
	  </div>
	  <div class="col-lg-4">
	   <div class="third_box">
               <img src="{{asset('storage/icons/coding.')}}png">   
	    <h4 style="font-weight:bold;">User friendly interface-</h4><br>
	    <p style="font-size:19px; padding-bottom:51px;">the site is designed in such a way that a user can get the necessary
                   information with minimal effort.</p>
	   </div>
	  </div>
	</div>
         </div>
         </div>

    <!--last section ------------------------------------------------------------>  
   <div class="lastsection">
       <div class="text-center">
       <h1>Current statistics</h1>
        </div>  
       <div class="text-center">
       <div class="container-fluid">
       <div class="row">
           <div class="col-lg-4">
           <span ><img src="{{asset('storage/icons/article.')}}png" alt="article"  width="130px;" height="130px;" id="img1"></span><br> <span>246 articles</span>
           </div>
           <div class="col-lg-4">
               <span><img src="{{asset('storage/icons/stats.')}}png" alt="article"  width="130px;" height="130px;" id="img2"></span><br><span>246 articles</span>
           </div>
           <div class="col-lg-4">
               <span><img src="{{asset('storage/icons/stats.')}}png" alt="article"  width="130px;" height="130px;" id="img3"></span><br><span>246 articles</span>
           </div>
           </div>
           </div>
          <div class="container-fluid">
       <div class="row">
           <div class="col-lg-4">
              <span><img src="{{asset('storage/icons/coding.')}}png" alt="article"  width="130px;" height="150px;" id="img4"></span><br><span>246 articles</span>
           </div>
           <div class="col-lg-4">
               <span><img src="{{asset('storage/icons/questionPaper.')}}png" alt="article"  width="150px;" height="150px;" id="img5"></span><br><span>246 articles</span>
       </div>
        </div>
       </div>  
       </div>       
    </div>
    
   <!--footer ----------------------------->  
 
    <footer class="container-fluid">
        <div class="footer row ">
            <ul style="list-style:none;">
                <li class=" footer_links">
                    <div class="col-lg-9 left">                             <!-- change-3 col-sm-9  to col-lg-9  -->
                        <a id="footerLineLeft" href="main/about">About Us</a>
                        <a id="footerLineLeft" href="main/terms">Terms of service</a>
                        <a id="footerLineLeft" href="main/privacy_policy">Privacy Policy</a>   
                        <a id="footerLineLeft" href="main/public-suggestions"style="margin-left:10px;">Request a feature</a>
                        <a id="footerLineLeft" href="main/public-suggestions">Any Suggestion</a>
                    </div>                                             
                    <div class="col-lg-3">
                        <a id="footerParaRight">Copyright © 2018 <span id="footerSycosIn">Sycos.in</span> All Right Reserved</a>
                    </div>
                </li>
            </ul>
            
        </div>
        <hr style="font-weight:bold;background-color:red;">
    </footer> 
	
	
</body>
</html>