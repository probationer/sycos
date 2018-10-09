@extends('components.functionalPages.articles.layout')

@section('content')
<script src="{{asset('js/editor.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrapTag/bootstrap-tagsinput.css')}}">
<script src="{{asset('js/bootstrapTag/bootstrap-tagsinput.js')}}"></script>  

    <div class='container'>
        <h1> Edit Article</h1>
        {{ Form::open(['action'=> ['articleController@update',$articleArray['detail']->link],'method'=>'POST']) }}
            <div class='form-group'>
                {{Form::label('title','Title')}}
                {{ Form::text('title',$articleArray['detail']->title,['class'=>'form-control','placeholder'=>'Enter Title']) }}
                
            </div>

            <div class='form-group'>
                {{Form::label('body','Body')}}
                {!! Form::textarea('body',$articleArray['detail']->body,['class'=>'form-control','placeholder'=>'Body of article'])!!}
            </div>
            {{Form::hidden('_method','PUT')}}

            <div class='form-group'>
                {{Form::label('tags','Tags( Add relevant tags, it will help to find your article )')}}
                <br>
                <input id="tags" type="tags" data-role="tagsinput" name="tags" class="form-control" placeholder='Use comma to separate' value="{{$articleArray['detail']->tags}}">
            </div>

            <div class='form-group'>
                    {{Form::submit('Save',['class'=>'btn btn-primary'])}}
                
            </div>
        {!! Form::close() !!}
    </div>


    

@endsection('content')