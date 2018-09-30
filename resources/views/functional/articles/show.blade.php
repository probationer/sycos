@extends('components.functionalPages.articles.layout')

@section('content')
    
    <div class="container">
        <div class="row">
                <div style="text-align:center; font:500 6vh oxygen;margin:80px 0px 30px  0px;">Written Articles</div>

                <div class="row">
                    @if(count($articleArray['articles']) > 0)
                        @foreach($articleArray['articles'] as $article)
                            <?php
                                $body = strip_tags($article->body);
                                $subStr = substr($body,0,400);
                       
                            ?>
                            <div class="col-lg-3" style="height:375px; overflow:hidden; border:1px solid lightblue;">
                                    <div style="margin-left:1%; background-size: cover;">
                                       
                                        <h3 style="margin-left:1%;"><a href='{{asset('article/'.$article->link)}}'>{{$article->title}}</a></h3>
                                        
                                        <br>
                                    </div>
                                    <p style="margin-left:1%;">{{$subStr}}...</p>
                                    <a style="margin-left:1%;" href="{{asset('/article/'.$article->link)}}" class="btn btn-primary">Read More</a><br>
                                    <small style="margin-left:1%;"><b>Written at : {{$article->created_at}}</b></small>
                            </div>
                        @endforeach
                    @else
                        <div class="well" >
                            No Article Found
                        </div>
                    @endif
                </div>
        </div>
    </div>

    
@endsection('content')