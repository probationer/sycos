<?php

namespace Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class videoFunction extends Facade{

    public static function List($profilePage,$col = 'created_at',$order = 'desc'){
        $userId = DB::table('signup')->where('name',$profilePage)->first()->id;

        if(DB::table('video')->where('user_id',$userId)){
            $list = DB::table('video')->where('user_id',$userId)->orderBy($col,$order)->get();
            $i=0;

            if(count($list)){

                foreach($list as $v){
                    $i++;
                    echo '<tr>
                            
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <a href="'.asset('/video/'.$v->link).'">'.$v->title.'</a>
                                        </div>
                                    </div>                                                
                                </div>
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        
                                                '.$v->created_at.'
                                        
                                    </div>                                                
                                </div>
                            </td>
                            <td>'.$v->views.'</td>
                        </tr>';
                }
            }else{
                echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            No video exists .
                                        </div>
                                    </div>                                                
                                </div>
                            </td>
                            
                        </tr>';
            }
        }
    }
    
    public static function ListOfVideo($uploader_id,$active,$name){
        if(DB::table('video')->where('user_id',$uploader_id)->exists()){
            $list = DB::table('video')->where('user_id',$uploader_id)->orderBy('created_at','desc')->get();
            $output = '<div class=" vertical-menu " id="leftMenu">
                        <h4>Other Videos By '.$name.'</h4>';
             
            foreach($list as $v){
                if($active == $v->link){
                    
                    $output = $output.'<a href="'.asset('/video/'.$v->link).'" class="active">'.$v->title.'</a>';
                }else{
                    $output = $output.'<a href="'.asset('/video/'.$v->link).'">'.$v->title.'</a>';
                }
                
            }
            $output = $output.'</div>';
            echo $output;
        }
        

    }

    public static function ListOfRight($uploader_id,$active,$name){
        if(DB::table('video')->where('user_id',$uploader_id)->exists()){
            $list = DB::table('video')->where('user_id',$uploader_id)->orderBy('created_at','desc')->get();
            $output = '<div class=" vertical-menu">
                        <h4>Other Videos By '.$name.'</h4>';
             
            foreach($list as $v){
                if($active == $v->link){
                    
                    $output = $output.'<a href="'.asset('/video/'.$v->link).'" class="active">'.$v->title.'</a>';
                }else{
                    $output = $output.'<a href="'.asset('/video/'.$v->link).'">'.$v->title.'</a>';
                }
                
            }
            $output = $output.'</div>';
            echo $output;
        }
        

    }


    public static function DeleteAuth($link){
        $videodetail = DB::table('video')->where('link', $link)->first();
        $id = $videodetail->id;
        
        if(Auth::user()->id!=$videodetail->user_id){
            return redirect('/login')->with('error','Invalid user');
        }
        $videoArray = video::find($id);
        $videoArray -> delete();
        return redirect('video')->with('success','Your Video is removed');
    }
}

?>