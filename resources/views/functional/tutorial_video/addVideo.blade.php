@extends('components.functionalPages.videos.layout')
<script src="{{asset('js/editor.js')}}"></script>
@section('content')


    <div class='container' style="width:60%; margin-top:50px;">
        <h1> Add Tutorial Video Link </h1>
        {!! Form::open(['action'=>'videoController@store','method'=>'POST']) !!}
            <div class='form-group'>
                {{ csrf_field() }}
                {{Form::label('title','Title')}}
                {{ Form::text('title','',['class'=>'form-control','placeholder'=>'Eg: ShortCut tricks for mathematics']) }}
                
            </div>

            <div class='form-group'>
                {{Form::label('link','Paste Embed Link Here')}}
                {{ Form::text('link','',['class'=>'form-control','placeholder'=>'Eg: https://www.youtube.com/watch?v=kljsalfeim2']) }}
                
            </div>

            <div class='form-group'>
                {{Form::label('description','Want to write a short description about video?')}}
                {{ Form::textarea('description','',['class'=>'form-control','placeholder'=>'write here']) }}
                
            </div>

            <div class='form-group'>
                    {{Form::submit('Add',['class'=>'btn btn-primary'])}}
                
            </div>
        {!! Form::close() !!}
    </div>


    

@endsection('content')