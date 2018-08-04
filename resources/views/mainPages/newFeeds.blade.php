@extends('components.commonNavigation')

@section('content')
<style>
    #content{
        box-shadow: 3px 3px 20px 0px #bbbaba;
        margin-top:1%;
        transition: transform 0.9s; /* Animation */
        height: 400px;
        padding: 10px;
        overflow: hidden;
    }
    #content:hover{
        transform: scale(1.05);
        top: 1;
        background-color: whitesmoke;
        color:#1b0b6b;
    }
    #bodyContent{
        font:500 14px roboto;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8" style="margin-top:20px; float:left;">
            <h3>Search Content In This Page</h3>
            <input type="text" class="form-control" id="searchInPage" placeholder="Enter keywords..">
            <script src="{{asset('js/profileJs/searchInPage.js')}}"></script>
        </div>
    </div>
    <br><br>
    <div class="row" id='wholeContainer'>
        <?php $data = SycosFunctions::newFeeds();
            $i = 0;
            $j = 0;
        ?>
        @if(count($data)>=0)
            @while( ((int)$data['Acount'] - 1)>$i && ((int)$data['Vcount'] - 1)>$j)
                @if(strtotime($data['article'][$i]->created_at) > strtotime($data['video'][$j]->created_at) )

                    <div class="col-md-3" id="content" >
                        
                        <div >
                            <br>
                            
                            <h3>{{strtoupper($data['article'][$i]->title)}}</h3>
                        
                            <br>
                        </div>
                        <?php 
                            $body = strip_tags($data['article'][$i]->body);
                            $subStr = substr($body,0,500).'.... <a href="'.asset('/article/'.$data['article'][$i]->link).'" style="color:blueviolet;">Read More</a>';
                        ?>
                        <p id="bodyContent">{!!$subStr!!}</p>
                    
                    </div>
                    <?php
                        $i++;
                    ?>
                @else
                    
                    <div class="col-md-3" id="content" >
                        
                            @if($data['video'][$j]->type == 'single')
                                <div style="position:relative; height:0;padding-bottom:56.21%">
                                    <iframe src="https://www.youtube.com/embed/{{$data['video'][$j]->link}}" style="position:absolute;width:100%;height:100%;left:0"  height="150px" frameborder="0" allow="autoplay; encrypted-media" ></iframe>
                                </div>
                                
                            @else   
                                <div style="position:relative; height:0;padding-bottom:56.21%">
                                    <iframe src="https://www.youtube.com/embed/videoseries?list={{$data['video'][$j]->link}}" style="position:absolute;width:100%;height:100%;left:0"  height="150px" frameborder="0" allow="autoplay; encrypted-media" ></iframe>
                                </div>
                                
                            @endif
                        
                        <h3>{{strtoupper($data['video'][$j]->title)}}</h3>
                        
                        <?php 
                            $body = strip_tags($data['video'][$j]->description);
                            $subStr = substr($body,0,200).'....';
                        ?>
                        <p>{{$subStr}}</p>
                        <a href="{{asset('/video/'.$data['video'][$j]->link)}}" class="btn btn-primary">Watch Video</a>
                    </div>

                    <?php
                        $j++;
                    ?>
                @endif

            @endwhile


            @while(((int)$data['Acount'] - 1)>=$i)
                <div class="col-md-3" id="content" >
                    
                    <div>
                        <br>
                        
                        <h3>{{strtoupper($data['article'][$i]->title)}}</h3>
                    
                        <br>
                    </div>
                    <?php 
                            $body = strip_tags($data['article'][$i]->body);
                            $subStr = substr($body,0,500).'.... <a href="'.asset('/article/'.$data['article'][$i]->link).'" style="color:blueviolet;">Read More</a>';
                        ?>
                    <p id="bodyContent">{!!$subStr!!}</p>
                    
                </div>
            <?php $i++; ?>
            @endwhile

            @while( ((int)$data['Vcount'] - 1)>=$j)
                <div class="col-md-3" id="content" >
                    
                        @if($data['video'][$j]->type == 'single')
                            <div style="position:relative; height:0;padding-bottom:56.21%">
                                <iframe src="https://www.youtube.com/embed/{{$data['video'][$j]->link}}" style="position:absolute;width:100%;height:100%;left:0"  height="150px" frameborder="0" allow="autoplay; encrypted-media" ></iframe>
                            </div>
                            
                        @else   
                            <div style="position:relative; height:0;padding-bottom:56.21%">
                                <iframe src="https://www.youtube.com/embed/videoseries?list={{$data['video'][$j]->link}}" style="position:absolute;width:100%;height:100%;left:0"  height="150px" frameborder="0" allow="autoplay; encrypted-media" ></iframe>
                            </div>
                            
                        @endif
                    
                        <h3>{{$data['video'][$j]->title}}</h3>
                        
                        <?php 
                            $body = strip_tags($data['video'][$j]->description);
                            $subStr = substr($body,0,200).'....';
                        ?>
                        <p>{{$subStr}}</p>
                        <a href="{{asset('/video/'.$data['video'][$j]->link)}}" class="btn btn-primary">Watch Video</a>
                    </div>

            <?php $j++;?>
            @endwhile
            
        @endif
        
        
          
    </div>
</div>
@endsection('content')