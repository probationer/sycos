@extends('components.functionalPages.videos.layout')

@section('content')
<style>
    .vertical-menu {
        width: 200px;
        height: auto;
        overflow-y: auto;
    }

    .vertical-menu a {
        background-color: white;
        color: black;
        display: block;
        padding: 12px;
        text-decoration: none;
    }

    .vertical-menu a:hover {
        background-color: #ccc;
    }

    .vertical-menu a.active {
        background-color: #3c5375;
        color: white;
    }

        @media screen and (max-height: 786px) {
            #leftMenu {
                height: 85%; /* 100% Full-height */
                position: fixed; /* Stay in place */
                z-index: 1; /* Stay on top */
                background-color: white;
                left: 0;
                margin-left:10px;
            }
            
        }
    </style>
       
        @if(count($videoArray) > 0)
                <div class="container-fluid">
                    <div class="row" style="margin-top:50px;">
                       
                        <div class="col-md-2 collapse navbar-collapse " id="leftmenu">
                            <div style="width:200px;"></div>
                            <?php videoFunction::ListOfVideo($videoArray['detail']->user_id,$videoArray['detail']->link,$videoArray['uploader']);?>
    
                        </div>
                    
                        <div class="col-md-6" style="margin:2% 2% 1% 2%;">
                            <h3>{{$videoArray['detail']->title}}</h3>
                            @if($videoArray['detail']->type === 'single')
                                <iframe width="600" height="337.5" src="https://www.youtube.com/embed/{{$videoArray['detail']->link}}" frameborder="0" allowfullscreen></iframe>
                            @else   
                                <iframe width="600" height="337.5" src="https://www.youtube.com/embed/videoseries?list={{$videoArray['detail']->link}}" frameborder="0" allowfullscreen></iframe>
                            @endif

                            <p>{!!$videoArray['detail']->description!!}</p>
                            <br>
                                <p>Added By :<a href="{{asset('/profile/'.$videoArray['uploader'])}}" > {{ $videoArray['uploader']}}</a> </p>
                                <p>Date : {{ $videoArray['detail']->created_at}} </p>
                            <br>
                            <br>
                            @guest
                            <hr><hr>
                            @else
                                <div style="margin:1%">
                                    @if(Auth::user()->id===$videoArray['detail']->user_id)
                                        <a href="{{asset('/video/'.$videoArray['detail']->link.'/edit')}}" class="btn btn-default">Edit</a>

                                        {!!Form::open(['action'=>['videoController@destroy',$videoArray['detail']->link],'method'=>'POST','class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Remove Video',['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    
                                    @endif
                                </div>
                            @endguest

                            <div class="container-fluid">
                                <div class="row">
                                    <hr>
                                    <div class="col-xs-12">
                                            <h3>Comment And Review </h3>
                                            <?php ECHO commentFunction::comments($videoArray['detail']->link);?>
            
                                            <h4>WriteComment</h4>
                                            <form action="{{asset('/comment/'.$videoArray['detail']->link)}}" method="post">
                                                {{ csrf_field() }}
                                                    <div class='form-group'>
                                                        
                                                        {{ Form::textarea('comment','',['rows'=>'4','cols'=>'50','class'=>'form-control','placeholder'=>'Write a comment for me'])}}
                                                    </div>
        
                                                    <div class="form -group">
                                                        {{Form::label('rating','How much do you like this video ?')}}
                                                            <input type="hidden" value="" name="rating" />
                                                            <a style="margin-left:15px;" class="rateArticle" onclick="Rating(1,'rateArticle')" href="javascript:void(0)"><span  class="glyphicon glyphicon-star"></span></a>
                                                            <a class="rateArticle" onclick="Rating(2,'rateArticle')" href="javascript:void(0)"><span  class="glyphicon glyphicon-star"></span></a>
                                                            <a class="rateArticle" onclick="Rating(3,'rateArticle')" href="javascript:void(0)"><span  class="glyphicon glyphicon-star"></span></a>
                                                            <a class="rateArticle" onclick="Rating(4,'rateArticle')" href="javascript:void(0)"><span  class="glyphicon glyphicon-star"></span></a>
                                                            <a class="rateArticle" onclick="Rating(5,'rateArticle')" href="javascript:void(0)"><span  class="glyphicon glyphicon-star"></span></a>
                                                            
                                                    </div>
                                                    <br>
                                                    <div class='form-group'>
                                                            {{Form::submit('Comment',['class'=>'btn btn-primary'])}}    
                                                    </div>
        
        
                                                    
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 collapse navbar-collapse">
                            <?php articleFunction::ListOfArticleRight($videoArray['detail']->user_id,' ',$videoArray['uploader']);?>
                        </div>
                    </div>
                </div>        
                
        @else
            <div class="well">
                No video found
            </div>
        @endif

    
@endsection('content')