@extends('components.functionalPages.videos.layout')
<script src="{{asset('js/editor.js')}}"></script>
@section('content')


    <div class='container' style="width:60%;">
        <h1> Add Tutorial Video Link </h1>
        {!! Form::open(['action'=>['videoController@update',$videoArray->link],'method'=>'POST']) !!}
            <div class='form-group'>
                {{ csrf_field() }}
                {{Form::label('title','Title')}}
                {{ Form::text('title',$videoArray->title,['class'=>'form-control','placeholder'=>'Eg: ShortCut tricks for mathematics']) }}
                
            </div>

            @if($videoArray->type ==='single')
                <div class='form-group'>
                    {{Form::label('link','Paste Embed Link Here')}}
                    {{ Form::text('link','https://www.youtube.com/watch?v='.$videoArray->link,['class'=>'form-control','placeholder'=>'Eg: https://www.youtube.com/watch?v=kljsalfeim2']) }}
                </div>
            @else
                <div class='form-group'>
                    {{Form::label('link','Paste Embed Link Here')}}
                    {{ Form::text('link','https://www.youtube.com/watch?list='.$videoArray->link,['class'=>'form-control','placeholder'=>'Eg: https://www.youtube.com/watch?list=kljsalfeim2']) }}
                </div>
            @endif

            {{Form::hidden('_method','PUT')}}

            <div class='form-group'>
                {{Form::label('description','Want to write a short description about video?')}}
                {{ Form::textarea('description',$videoArray->description,['class'=>'form-control','placeholder'=>'write here']) }}
                
            </div>

            <div class='form-group'>
                    {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                
            </div>
        {!! Form::close() !!}
    </div>


    

@endsection('content')