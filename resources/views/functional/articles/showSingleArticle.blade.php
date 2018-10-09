@extends('components.functionalPages.articles.layout')

@section('content')

<style>
    .vertical-menu {
        width: 250px;
        height: auto;
        overflow-y: auto;
    }

    .vertical-menu a {
        background-color: whitesmoke;
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
                background-color: whitesmoke;
                left: 0;
                margin-left: 10px;
            }
            
        }
</style>

    <?php $compainonList = CompanionFunction::ListOfAllCompanions($articleArray['detail']->writer_id);
    ?>
        @if(count($articleArray) > 0)
            @if(articleFunction::IsPrivate($articleArray['detail']->writer_id) )
                @if(Auth::user() && (in_array(Auth::user()->id, $compainonList) || Auth::user()->id == $articleArray['detail']->writer_id))
                    <div class="container-fluid" style="margin-top:50px;">
                        <div class="row">
                            <div class="col-lg-2 collapse navbar-collapse " id="leftmenu">
                                    <div style="width:230px; "></div>
                                    <?php articleFunction::ListOfArticleLeft($articleArray['detail']->writer_id,$articleArray['detail']->title,$articleArray['writer']);?>
                            </div>
                            
                            <div class="col-lg-7" style="margin-top:1%; height:auto; overflow-y:auto;">
                                <h1>{{$articleArray['detail']->title}}</h1>
                                <br>
                                @if($articleArray['detail']->type == 'npdf')
                                    <p>{!!$articleArray['detail']->body!!}</p>
                                @else
                                    <iframe src="{{asset('pdfs/'.$articleArray['detail']->link.'.pdf')}}" allowfullscreen webkitallowfullscreen width="100%" height="800px"></iframe>
                                @endif
                                <br><br>
                                    <p style="font:300 14px roboto">Written By: <a href="{{asset('/profile/'.$articleArray['writer'])}}">{{ $articleArray['writer']}}</a>  </p>
                                <br>
                                @if($articleArray['detail']->tags != NULL)
                                    <p>
                                        Tags : 
                                        {!!articleFunction::tags($articleArray['detail']->tags)!!}
                                    </p>
                                @endif
                                <hr>
                                @guest

                                @else
                                    @if(Auth::user()->id == $articleArray['detail']->writer_id)
                                    <div style="margin:10px;">
                                        <a href="{{asset('/article/'.$articleArray['detail']->link.'/edit')}}" class="btn btn-default">Edit</a>

                                        {!!Form::open(['action'=>['articleController@destroy',$articleArray['detail']->link],'method'=>'POST','class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete Article',['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </div>
                                    @endif
                                @endguest
                            </div>
                            
                            <div class="col-lg-2 collapse navbar-collapse" style="margin-top:20px">
                                
                                <?php videoFunction::ListOfRight($articleArray['detail']->writer_id,' ',$articleArray['writer']);?>
                                
                            </div>
                        </div>

                        
                            <div class="row">
                                
                                <div class="col-lg-2" style=" margin-left:50px;"> </div>

                                <div class="col-lg-6" style="margin:10px">
                                    
                                    <h3>Comment And Review / Ask Question.</h3>
                                    <?php echo commentFunction::comments($articleArray['detail']->link);?>
                                    
                                    <form action="{{asset('/comment/'.$articleArray['detail']->link)}}" method="post">
                                        {{ csrf_field() }}
                                            <div class='form-group'>
                                                <h3>Write a comment</h3>
                                                {{ Form::textarea('comment','',['rows'=>'5','class'=>'form-control','placeholder'=>'Write a comment for me'])}}
                                            </div>

                                            <div class="form -group">
                                                {{Form::label('rating','Rate this article.')}}
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
                @else
                    <div class="container-fluid" style="margin-top:50px;">
                        <div class="row">
                            <div class="col-lg-2 collapse navbar-collapse " id="leftmenu">
                                    <div style="width:230px; "></div>
                                    <?php articleFunction::ListOfArticleLeft($articleArray['detail']->writer_id,$articleArray['detail']->title,$articleArray['writer']);?>
                            </div>
                            
                            <div class="col-lg-7" style="margin-top:1%; height:auto; overflow-y:auto;">
                                <div class="well text-center">
                                   <h1><span class="glyphicon glyphicon-eye-close"></span> <br>
                                        This is a private article please add him/her as companion to read this article
                                    </h1>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 collapse navbar-collapse" style="margin-top:20px">
                                
                                <?php videoFunction::ListOfRight($articleArray['detail']->writer_id,' ',$articleArray['writer']);?>
                                
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-2" style=" margin-left:50px;"> </div>

                            <div class="col-lg-6" style="margin:10px">
                                
                               
                            </div>
                        </div>
                        
                    </div>
                @endif
            @else
                <div class="container-fluid" style="margin-top:50px;">
                    <div class="row">
                        <div class="col-lg-2 collapse navbar-collapse " id="leftmenu">
                                <div style="width:230px; "></div>
                                <?php articleFunction::ListOfArticleLeft($articleArray['detail']->writer_id,$articleArray['detail']->title,$articleArray['writer']);?>
                        </div>
                        
                        <div class="col-lg-7" style="margin-top:1%; height:auto; overflow-y:auto;">
                            
                            <h1>{{ucwords($articleArray['detail']->title)}}</h1>
                            <br>
                            @if($articleArray['detail']->type == 'npdf')
                                <p>{!!$articleArray['detail']->body!!}</p>
                            @else
                                {{asset('pdfs/'.$articleArray['detail']->link.'.pdf')}}
                            
                                <iframe src="{{asset('pdfs/'.$articleArray['detail']->link.'.pdf')}}" allowfullscreen webkitallowfullscreen width="100%" height="800px">
                                
                                </iframe>
                                
                                <?php    
                                    $base64 = asset('pdfs/'.$articleArray['detail']->link.'.pdf');
                                    $binary = base64_decode($base64);
                                    file_put_contents('my.pdf', $binary);
                                    header('Content-type: application/pdf');
                                    header('Content-Disposition: attachment; filename="my.pdf"');
                                    echo $binary;
                                ?>

                                <script>
                                    var request = new XMLHttpRequest();
                                    request.open("GET", {{asset('pdfs/'.$articleArray['detail']->link.'.pdf')}}, true); 
                                    request.responseType = "blob";
                                    request.onload = function (e) {
                                        if (this.status === 200) {
                                            // `blob` response
                                            console.log(this.response);
                                            // create `objectURL` of `this.response` : `.pdf` as `Blob`
                                            var file = window.URL.createObjectURL(this.response);
                                            var a = document.createElement("a");
                                            a.href = file;
                                            a.download = this.response.name || "detailPDF";
                                            document.body.appendChild(a);
                                            a.click();
                                            // remove `a` following `Save As` dialog, 
                                            // `window` regains `focus`
                                            window.onfocus = function () {                     
                                            document.body.removeChild(a)
                                            }
                                        };
                                    };
                                    request.send();
                                </script>
                            @endif
                            <br><br>
                                <p style="font:light 14px roboto">Written By: <a href="{{asset('/profile/'.$articleArray['writer'])}}">{{ ucwords($articleArray['writer'])}}</a>  </p>
                            <br>
                                @if($articleArray['detail']->tags != NULL)
                                <p>
                                    Tags : 
                                    {!!articleFunction::tags($articleArray['detail']->tags)!!}
                                </p>
                                @endif
                            <hr>
                            @guest

                            @else
                                @if(Auth::user()->id == $articleArray['detail']->writer_id)
                                <div style="margin:10px;">
                                    <a href="{{asset('/article/'.$articleArray['detail']->link.'/edit')}}" class="btn btn-default">Edit</a>

                                    {!!Form::open(['action'=>['articleController@destroy',$articleArray['detail']->link],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete Article',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </div>
                                @endif
                            @endguest
                        </div>
                        
                        <div class="col-lg-2 collapse navbar-collapse">
                            
                            <?php videoFunction::ListOfRight($articleArray['detail']->writer_id,' ',$articleArray['writer']);?>
                            
                        </div>
                    </div>

                    
                        <div class="row">
                            
                            <div class="col-lg-2" style=" margin-left:50px;"> </div>

                            <div class="col-lg-6" style="margin:10px">
                                
                                <h3>Comment And Review </h3>
                                <?php echo commentFunction::comments($articleArray['detail']->link);?>


                                <form action="{{asset('/comment/'.$articleArray['detail']->link)}}" method="post">
                                    {{ csrf_field() }}
                                        <div class='form-group'>
                                            <h3>Write a comment</h3>
                                            {{ Form::textarea('comment','',['rows'=>'5','class'=>'form-control','placeholder'=>'Write a comment for me'])}}
                                        </div>

                                        <div class="form -group">
                                            {{Form::label('rating','How much do you like this article ?')}}
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
            @endif

        @else
            <div class="well">
                No Article Found with this title
            </div>
        @endif
       
                

    
@endsection('content')