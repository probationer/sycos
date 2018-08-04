<?php 
    //$token = Session::Session_create('NlTkSe');
        
            $male = $female =NULL;
            $st = $techer = $inst = NULL;
            $all = NULL;
            $stateFilter = NULL;
            $totalSearchResults = null;
             
            if(isset($_GET['type'])){
                switch($_GET['type']){
                    case 'Students':
                        $st = 'SELECTED';
                        break;
                    case 'Teachers':
                        $techer ='SELECTED';
                        break;
                    case 'Institutes':
                        $inst ='SELECTED';
                        break;
                    default :
                        $st = $techer = $inst = NULL;
                        $all = 'SELECTED';
                        break;
                }
            }else{
                
                $st = $techer = $inst = NULL;
                $all = 'checked';
            } 
            
            
            if(isset($_GET['state'])){
                $stateFilter = $_GET['state'];
            }else{
                $stateFilter = NULL;
            }
        
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Search Study Companion</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">  
        <link rel="stylesheet" href="{{asset('css/commonStylesheets/commonLayout.css')}}"> 
        <link rel="stylesheet" href="{{asset('css/commonStylesheets/searchResult.css')}}">
        <link rel="stylesheet" href="{{asset('css/forms/searchPage.css')}}">
        <script src="{{asset('js/app.js')}}"></script>
        
        
        <script>
                function sliderChange(){
                    document.getElementById('ageValue').innerHTML = document.getElementById('ageSlider').value;
                    search();
                }
             
             function search(){
                 document.getElementById("searchBtn").click();
             }
                
             function search2(){
                 document.getElementById("searchBtn").click();
             }   
            </script>

     </head>
     
 <body>
  <nav class="navbar navbar-default">
        <!-- input search --> 
  <div class="container"style="margin-top:20px;">
  <div class="row searchFilter" >
        <div class="col-sm-2" style="margin-top:-35px;">
            <div class="">
                <a href="{{asset('/')}}"><h1 class="Sycos">Sycos.In</h1></a>
        </div>
   </div>		
  <div class="searchf" style="">
     <div class="col-sm-9" >
     <form id='searchForm' method="get" action="{{asset('/search')}}" >       
        <div class="input-group" >
             
                <input id="search" type="search" name="query"  class="form-control" aria-label="Text input with segmented button dropdown" value="<?php if(isset($_GET['query'])) echo $_GET['query'];?>"/>
                <div class="input-group-btn" >

                    <button id="searchBtn" type="submit" class="btn btn-secondary btn-search" name="search" >
                        <span class="glyphicon glyphicon-search" >&nbsp;</span> 
                        <span class="label-icon" >Search</span>
                    </button>
                </div>
            
        </div>
          
    </div>
  </div>
	</div>
    </div>   
    
    
     </nav>
 <div class="dropdownl" style="">
 
 <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle"data-toggle="collapse" data-target="#myNavbar" >
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
            </div>
            
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav" >
                 <div class="dropdownl" style="">
 
                     
   <span class="dropdown">
    <select class="" role="menu" name="type"  aria-labelledby="menu1" style='border:none;' onselect="search2()" >
        <option role="presentation"  <?php echo $all;?> value="all">All</option>
        <option role="presentation"  <?php echo $inst;?> value="Institutes">Institutes</option>
        <option role="presentation"  <?php echo $techer;?> value="Teachers">Teachers</option>
        <option role="presentation"  <?php echo $st;?> value="Students">Students</option>
      
    </select>
  </span>
  
     <span class="dropdown" >
            <select class="" role="menu" name="state"  aria-labelledby="menu1" style='border:none;' onselect="search2()" >
                <?php 
                    $stateArray = explode(',', SycosFunctions::PutList('state'));
                    foreach($stateArray as $v){
                        if($v == $stateFilter){
                            echo '<option role="presentation"  value="'.$v.'" selected>'.$v.'</option> ';
                        }else{
                            echo '<option role="presentation"  value="'.$v.'">'.$v.'</option> ';
                        }
                    }
                ?> 
                 
            </select>
     </span>                                        
    </form>
 <hr>
 </div>
    </ul>
	</div>
	</div>
    <div class="container-fluid">
        <div class="middle-section-inside">
            @if(count($result)>0)

            <?php 
                //print_r(array_keys($result['UserIdLIst']));
                
                foreach(array_keys($result['UserIdLIst']) as $u){
                    if($result['UserIdLIst'][$u] == 'Student'){
                        foreach($result['student'] as $v){
                            if($v->user_id == $u) 
                            echo SearchMethod::studentProfileCard($v);
                        }
                        
                    }
                    if($result['UserIdLIst'][$u] == 'Institute'){
                        foreach($result['institute'] as $v){
                            if($v->user_id == $u) 
                            echo SearchMethod::instituteProfileCard($v);
                        }
                        
                    }
                    if($result['UserIdLIst'][$u] == 'Teacher'){
                        foreach($result['teacher'] as $v){
                            if($v->user_id == $u) 
                            echo SearchMethod::teacherProfileCard($v);
                        }
                        
                    }
                }
            ?>
                
                
            @endif
            
        </div>
    </div>
    <footer class="">
        
        <div class="footer_row ">
            <hr style="">
            <ul style="list-style:none;color:black">
                <li class=" footer_links">
                    <div class="col-lg-9 left">                             
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