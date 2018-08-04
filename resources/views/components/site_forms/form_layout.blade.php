<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('js/app.js') }}"></script>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/forms/account_type_forms.css')}}" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link  rel="stylesheet" href="{{asset('vendor/dist/css/bootstrap-select.css')}}"type="text/css">
        <script src="{{asset('vendor/dist/js/bootstrap-select.js')}}"></script>
        <script src="{{asset('vendor/jcrop/js/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/jcrop/js/jquery.Jcrop.min.js')}}"></script>
        <script src="{{asset('js/statusChange.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/forms/toggleSwitch.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('vendor/jcrop/css/jquery.Jcrop.css')}}" type="text/css" />
        

        <title>Account | Sycos</title>
        
        <!-- Fonts -->
        

        <!-- Styles -->
        
    </head>
    <body>
        <nav class="navbar navbar-inverse" id="navHolder">
            <div class="container-fluid" >
                <div class="navbar-header" >
                    
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" id="anchorDesign" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li ><a id="anchorDesign" href="/">Home</a></li>
                        <li><a id="anchorDesign" href="{{asset('/about')}}">About Us</a></li>                        
                    </ul>
            </div>
        </nav>
        @include('includes.messages')
        @yield('content')
    </body>
</html>
