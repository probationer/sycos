@extends('components.functionalPages.articles.layout')
    
@section('content')
<script src="{{asset('js/editor.js')}}"></script>
    <div class='container' style="margin-top:50px;">
        <h1 style=" marign-top:50px;"> Write Article </h1>
        {!! Form::open(['action'=>'articleController@store','method'=>'POST']) !!}
            <div class='form-group'>
                {{ csrf_field() }}
                {{Form::label('title','Title')}}
                {{ Form::text('title','',['class'=>'form-control','placeholder'=>'Enter Title']) }}
                
            </div>

            <div class='form-group'>
                {{Form::label('body','Body')}}
                {{ Form::textarea('body','',['rows'=>'20','class'=>'form-control','placeholder'=>'Body of artilce'])}}
            </div>

            <div class='form-group'>
                    {{Form::submit('save',['class'=>'btn btn-primary'])}}
                
            </div>
        {!! Form::close() !!}
    </div>


    

@endsection('content')