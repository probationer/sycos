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
        <script src="{{asset('vendor/tinymce/js/tinymce/jquery.tinymce.min.js')}}"></script>
        <script src="{{asset('vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
        <script src="{{asset('js/profileJs/tabFunctions.js')}}"></script>
        
        <title>{{$articleArray['title']}} | Sycos</title>
        
    </head>
    <body>
        @include('components.functionalPages.contentDisplayNav')
        @include('includes.messages')
        
        @yield('content')

        @include('components.profile.footerProfile')
    </body>
</html>
