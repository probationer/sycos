<?php 
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

    if(isset($_GET['query'])){
        if(isset($_GET['state'])){
            $url ='?query='.$_GET['query'].'&search=&state='.$_GET['state'];
        }
        else
            $url ='?query='.$_GET['query'];
    }else{
        $url =" ";
    }

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Search Content | Sycos</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('/css/commonStylesheets/commonLayout.css')}}">
        <link rel="stylesheet" href="{{asset('/css/commonStylesheets/searchResult.css')}}">
        <link rel="stylesheet" href="{{asset('/css/forms/searchPage.css')}}">
        <script src="{{asset('/js/app.js')}}"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
             
        <link  rel="stylesheet" href="{{asset('vendor/dist/css/bootstrap-select.css')}}"type="text/css">
        <script src="{{asset('vendor/dist/js/bootstrap-select.js')}}"></script>
        
        <script>
            function sliderChange(){
                document.getElementById('ageValue').innerHTML = document.getElementById('ageSlider').value;
                search();
            }
            
            function search(){
                document.getElementById("searchBtn").click();
            }
                
            function search2(data){
               word = (window.location.href);
               window.location.assign(word +"&state="+data);
            }   
            
            
            function clickMe(){
                var myColors = ['red', 'purple', '#E84751', 'blue', 'orange', '#323643']; 
                var randomize = Math.floor(Math.random()*myColors.length);
                $('.tab1').css("background-color", myColors[randomize]);
            }


        </script>
                                    
        <style>
            @media only screen and (min-width: 600px) {                                        
                .navbar-default {
                background-color: #3c5375;
                border-color: #e7e7e7;
            }        
            .sort
            {
                margin-left:400px; 20px;
                float:right;
            }
            .tab2 {
                margin:0px 17px 0px 0px;
                background-color: ;
                border-radius:0px;
                box-sizing: border-box;
                overflow: hidden;
                padding:0px 0px 0px 0px;
                width:5%;
                height:20px;
                text-align: center;
                        
            }
            #grouptab
            {
                margin-left:-100px;
                margin-bottom:10px;   
            }
            span>a
            {
                text-decoration: none;
            }
            span>a {
                color: #eee;
                cursor: pointer;
                padding: 0px 20px 0px 10px;
            }
            span>a:hover
            {
                color: #eee;
                text-decoration: none;
                border-bottom: 5px solid #eee;
                
            }
            span>a:active,a:visited
            {
                
                text-decoration: none;
                border-bottom: 5px solid #eee;
            }
            
            span>a:focus
            {
                color: #eee;
            }
            .active{
                background-color:white;
                color:black;
            }
            .tab1 {
                margin:2px;
                box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
                background-color: white;
                border-radius: 48px;
                box-sizing: border-box;
                overflow: hidden;
                padding:8px 16px;
                width:8%;
                height:40px;
                text-align: center;
                        
            }
                                        
            .middle-section-inside
              {
               margin-top:-100px;                              
                                        }
            .leftFilters
            {  
                margin:40px 40px 40px 40px;    
            }
                                        }
                                        
            @media only screen and (max-width: 600px) {
                .navbar-default {
                background-color: #3c5375;
                border-color: #e7e7e7;
            } 
            .sort
            {
                margin-left:0px;margin-top:0px;
            }
            .tab2 {
                margin:0px 0px 0px 0px;
                background-color: ;
                border-radius:0px;
                box-sizing: border-box;
                overflow: hidden;
                padding:0px 0px 0px 0px;
                width:8%;
                height:20px;
                text-align: center;
            }

            .logo{
                text-align: center;  
            }

            span>a {
                color: #eee;
                cursor: pointer;
                padding:6px;
            }
            span>a:hover
            {
                color: #eee;
            }
            
            span>a:active
            {
                color:black;
            }
            
            span>a:focus
            {
                color: #eee;
            }
                
            .middle-section-inside
                {
                margin-top:0px;                              
                                            }
            .tab1 {
                margin-top:10px;
                box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
                background-color: white;
                border-radius: 48px;
                box-sizing: border-box;
                overflow: hidden;
                padding:5px 10px;
                width:4% !important;
                height:30px;
                text-align: center;
                        
            }
            .leftFilters
            {  
                margin:0px 20px 0px 23px;
            }
            }                                
                                        
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default ">
            <!-- input search -->
            <div class="container"style="margin-top:20px;">
                <div class="row searchFilter" >
                <div class="col-sm-2" style="margin-top:-35px;">
                    <div class="logo">
                        <a href="{{asset('/')}}">
                            <img class="sycos" height="auto" width="200" style="margin-top:20px;" src="{{asset('assetsHome/images/logono-background-364x126.png')}}"/>
                        </a>
                    </div>
                </div>
                <div class="searchf" style="">
                    <div class="col-sm-9" >
                        <form id='searchForm' method="get" action="{{asset('/search')}}" >
                            <div class="input-group" >
                                <input id="search" type="search" required name="query"  class="form-control" aria-label="Text input with segmented button dropdown" value="<?php if(isset($_GET['query'])) echo $_GET['query'];?>"/>
                                <div class="input-group-btn" >
                                    <button id="searchBtn" type="submit" class="btn btn-secondary btn-search" name="search" >
                                        <span class="glyphicon glyphicon-search" >&nbsp;</span>
                                        <span class="label-icon" >Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
                <center>
                    <div class="" id="grouptab">    
                        <span class="tab2">
                            <span  class="dtviD" style="display: inline-block;"><a href="{{asset('/search'.$url)}}">All</a></span>
                        </span>
                        <span class="tab2">
                            <span  class="dtviD" style="display: inline-block;"><a href="{{asset('/search/article'.$url)}}">Article</a></span>
                        </span>
                        <span class="tab2">
                            <span  class="dtviD" style="display: inline-block;"><a href="{{asset('/search/teacher'.$url)}}">Teachers</a></span>
                        </span>
                        <span class="tab2">
                            <span  class="dtviD" style="display: inline-block;"><a href="{{asset('/search/student'.$url)}}">Students</a></span>
                        </span>
                        <span class="tab2">
                            <span  class="dtviD" style="display: inline-block;"><a href="{{asset('/search/video'.$url)}}">Videos</a></span>
                        </span>
                        <span class="tab2">
                            <span  class="dtviD" style="display: inline-block;"><a href="{{asset('/search/institute'.$url)}}">Institutes</a></span>
                        </span>     
                    </div> 
                </center>
                    
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
                        
                            <div class="dropdownl" >
                                <!---sort button---->
                                <div class="sort" style="text-align:right;">
                                    <h5>Sort by</h5>    
                                    <span class="dropdown">
                                        
                                        <select class="" role="menu" name="type"  aria-labelledby="menu1" style='border:none;' onselect="search2()" >
                                            <option role="presentation" checked  value="relevent">Most Relevent </option>
                                            <option role="presentation"   value="date">Date</option>
                                            <option role="presentation"   value="a-z">A-Z </option>
                                            <option role="presentation"   value="z-a">Z-A</option>
                                        </select>
                                    </span>
                                </div>

                            </div>
                            
                            <div class="fluid-container" style="margin-right:200px;">
                                <div class="leftFilters">            
                                    <div class="custom-control">
                                        <label>Filter By Word </label><br>
                                        <input type="search" id="contentSearch" placeholder="Enter Word"/>

                                    </div>
                                    <br>
                                    <div class="custom-control">
                                        <label>Select State <span style="font:300 12px oxygen;">(Except articles and videos)</span></label><br>
                                        <select class="selectpicker show-menu-arrow form-control" name="state" data-max-options="1" onchange="search2(this.value)" data-live-search="true">
                                            <?php
                                                SycosFunctions::MarkSelected($stateFilter.',',SycosFunctions::PutList('state'));
                                            ?>  
                                        </select>
                                        <input type="hidden" id="stateValue" value="<?php echo $stateFilter; ?>">
                                    </div>
                                    
                                    <script src="{{asset('js/profileJs/searchInPage.js')}}"></script>
                                    <script>
                                        $(document).ready(function(){
                                            $("#contentSearch").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $(".middle-section-inside .container-fluid").filter(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                            });
                                            });
                                        });
                                    </script>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </ul>
                </div>
        
            </div>
        </div>
        <!-- Default unchecked -->
                                                    
        <div class="container-fluid">
            <div class="middle-section-inside">
                @if(count($result['UserIdLIst'])>0)

                <?php 
                    //print_r(array_keys($result['UserIdLIst']));
                    $s=$i=$t=$a=$v=0;
                    foreach(array_keys($result['UserIdLIst']) as $u){
                        //print_r($result['student']);
                        switch($result['UserIdLIst'][$u]){
                            case 'Student':
                                if($s<sizeof($result['student'])){
                                    //print_r($result['student'][$s]);
                                    echo SearchMethod::studentProfileCard($result['student'][$s]);
                                    $s++;
                                }
                                    
                            break;
                            case 'Institute':
                                if($i<sizeof($result['institute'])){
                                    echo SearchMethod::instituteProfileCard($result['institute'][$i]);
                                    $i++;
                                }
                                
                            break;
                            case 'Teacher':
                                if($t<sizeof($result['teacher'])){
                                    echo SearchMethod::teacherProfileCard($result['teacher'][$t]);
                                    $t++;
                                }
                                
                            break;
                            case 'Article':
                                if($a<sizeof($result['article'])){
                                    echo SearchMethod::articleCard($result['article'][$a]);
                                    $a++;
                                }
                                
                            break;
                            case 'Video':
                                if($v<sizeof($result['video'])){
                                    echo SearchMethod::videoCard($result['video'][$v]);
                                    $v++;
                                }
                                
                            break;
                        }
                        
                    }
                ?>
                @else
                    <?php
                        echo SearchMethod::Noresult($result["query"]);
                    ?>
                    
                @endif
                        
            </div>
        </div>
        <footer class="" style=" position:static; left: 0;bottom: 0;width: 100%;">
            <div class="footer_row ">
                <hr style="">
                <ul style="list-style:none;color:black">
                    <li class=" footer_links">
                        <div class="col-lg-9 left">
                            <a id="footerLineLeft" href="{{asset('/about')}}">About Us |</a>
                            <a id="footerLineLeft" href="{{asset('/terms')}}">Terms of service |</a>
                            <a id="footerLineLeft" href="{{asset('/privacy_policy')}}">Privacy Policy |</a>
                            <a id="footerLineLeft" href="{{asset('/public-suggestions')}}">Request a feature |</a>
                            <a id="footerLineLeft" href="{{asset('/public-suggestions')}}">Any Suggestion</a>
                        </div>
                        <div class="col-lg-3">
                            <a id="footerParaRight">Copyright © 2018 
                                <span id="footerSycosIn">Sycos.in</span> All Right Reserved
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </footer>
    </body>
</html>