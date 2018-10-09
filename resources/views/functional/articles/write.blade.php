@extends('components.functionalPages.articles.layout')
    
@section('content')
    <script src="{{asset('js/editor.js')}}"></script>   
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrapTag/bootstrap-tagsinput.css')}}">
    <script src="{{asset('js/bootstrapTag/bootstrap-tagsinput.js')}}"></script>   
    
    <div class='container' style="margin-top:50px;">
        <h1 style=" marign-top:50px;"> Write Article </h1>
        {!! Form::open(['action'=>'articleController@store','method'=>'POST','enctype'=>"multipart/form-data",'id'=>'articlesec']) !!}
            <div class='form-group'>
                {{ csrf_field() }}
                {{Form::label('title','Title')}}
                {{ Form::text('title','',['class'=>'form-control','placeholder'=>'Enter Title','id'=>'txtTitle']) }}                
            </div>

            <div class='form-group' id="fileUploaderButton">
                {{ Form::label('File Upload','Upload File(max upload 40MB)')}}
                <input type="file" id="fileUploader" name="pdfFile" />

                <h4 id="refreshNotify" style="display:none">Refresh page if you want to write an article.</h4>
            </div>
            
            <div class='form-group' id='textBody'>
                    <h3>Or </h3>
                {{Form::label('body','Write Article')}}
                {{ Form::textarea('body','',['rows'=>'20','class'=>'form-control','placeholder'=>'Body of artilce','id'=>'textareaarticle'])}}
            </div>
        
            <div class='form-group'>
                {{Form::label('tags','Tags( Add relevant tags, it will help to find your article )')}}
                <br>
                <input id="tags" type="tags" data-role="tagsinput" name="tags" class="form-control" placeholder='Use comma to separate'>
            </div>
            <div class='form-group'>
                    {{Form::submit('save',['class'=>'btn btn-primary'])}}
            </div>
        {!! Form::close() !!}
    </div>

    <script>
       
       // $('input[name="tags"]').amsifySuggestags();
        $('#fileUploader').click(function(){
            $('#textBody').fadeOut();
            $('#refreshNotify').fadeIn("slow");
            $('#articlesec').attr('action','{{asset("/pdfupload")}}');
        });
        $('#textareaarticle').keydown(function(){
            $('#fileUploaderButton').hide();
        });
    </script>

@endsection('content')