<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="{{asset('css/profileStyle/teacherProfile.css')}}" rel="stylesheet" type="text/css">
        <script src="{{asset('js/profileJs/tabFunctions.js')}}"></script>
        <script src="{{asset('vendor/tinymce/js/tinymce/jquery.tinymce.min.js')}}"></script>
        <script src="{{asset('vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
        
        <title>{{$videoArray['title']}}</title>

        <!-- Fonts -->
        

        <!-- Styles -->
        
    </head>
    <body>
        @include('components.functionalPages.contentDisplayNav')
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
