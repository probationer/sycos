@extends('components.functionalPages.videos.layout')
<style>
        #content{
            box-shadow: 3px 3px 20px 0px #bbbaba;
            margin-top:1%;
            transition: transform 0.9s; /* Animation */
            height: 380px;
            overflow: hidden;
            margin-bottom:1%;
            padding:5px;
        }
        #content:hover{
            transform: scale(1.05);
            top: 1;
            background-color: whitesmoke;
            color:#1b0b6b;
        }
    </style>
@section('content')
    <h1 style="margin-top:100px; text-align:center;">Linked Videos Tutorials</h1>
    <div class="container">
        <div class="row">
            @if(count($videoArray['video']) > 0)
                @foreach($videoArray['video'] as $v)
                    <div class="col-md-3" id="content">
                        @if($v->type == 'single')
                            <div style="position:relative; height:0;padding-bottom:56.21%">
                                <iframe src="https://www.youtube.com/embed/{{$v->link}}" style="position:absolute;width:100%;height:100%;left:0"  height="150px" frameborder="0" allow="autoplay; encrypted-media" ></iframe>
                            </div>
                            
                            
                        @else 
                            <div style="position:relative; height:0;padding-bottom:56.21%">
                                <iframe src="https://www.youtube.com/embed/videoseries?list={{$v->link}}" style="position:absolute;width:100%;height:100%;left:0"  height="150px" frameborder="0" allow="autoplay; encrypted-media" ></iframe>
                            </div>  
                        
                            
                        @endif
                           
                        <h3>
                            <a href="{{asset('/video/'.$v->link)}}">{{$v->title}}</a>
                        </h3>
                        <br>
        
                        <p>{!!$v->description!!}</p>
                        
                    </div>
                @endforeach
            @else
                <div class="well">
                    No Article Found
                </div>
            @endif
        </div>
    </div>
    
@endsection('content')