@extends('components.functionalPages.articles.layout')

@section('content')
    
    <div class="container">
        <div class="row">
                <div style="text-align:center; font:500 60px oxygen;margin:80px 0px 30px  0px;">Written Articles</div>

                <div class="row">
                    @if(count($articleArray['articles']) > 0)
                        @foreach($articleArray['articles'] as $article)
                            
                            <div class="col-lg-3" style="margin:10px auto;height:350px; overflow:hidden;">
                                    <div style="background-image:url({{asset('/storage/icons/article1.png')}}); background-size: cover;">
                                        <br>
                                        <br>
                                        <br>
                                        <h3><a href='{{asset('article/'.$article->link)}}'>{{$article->title}}</a></h3>
                                        <br>
                                    </div>
                                    <p style="">{!!$article->body!!}</p>
                                    <small><b>Written at {{$article->created_at}}</b></small>
                            </div>
                        @endforeach
                    @else
                        <div class="well">
                            No Article Found
                        </div>
                    @endif
                </div>
        </div>
    </div>

    
@endsection('content')