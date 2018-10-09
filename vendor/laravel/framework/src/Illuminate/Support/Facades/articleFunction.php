<?php

namespace Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class articleFunction extends Facade{

    public static function List($profilePage,$col = 'created_at',$order = 'desc'){
        $userId = DB::table('signup')->where('name',$profilePage)->first()->id;
        if(DB::table('articles')->where('writer_id',$userId)){
            $list = DB::table('articles')->where('writer_id',$userId)->orderBy($col,$order)->get();
            $i=0;

            if(count($list)){

                foreach($list as $v){
                    
                    $i++;

                    echo '<tr>
                            
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="'.asset('/article/'.$v->link).'"> '.($i).'. '.$v->title.'</a>
                                        </div>
                                    </div>                                                
                                </div>
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="row text-left">
                                        
                                                '.$v->gname.'
                                        
                                    </div>                                                
                                </div>
                            </td>
                            <td>'.$v->created_at.'</td>
                        </tr>';
                }
            }else{
                echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            No article Written by you .
                                        </div>
                                    </div>                                                
                                </div>
                            </td>
                            
                        </tr>';
            }
        }
    }
    
    public static function ListOfArticleRight($writerId,$active,$name){
        if(DB::table('articles')->where('writer_id',$writerId)->exists()){
            $list = DB::table('articles')->where('writer_id',$writerId)->orderBy('created_at','desc')->get();
            $output = '<div class="vertical-menu">
                    <h4> Articles By '.$name.'</h4>';
           
            foreach($list as $v){
                if($active == $v->title){
                    $output = $output.'<a href="'.asset('/article/'.$v->link).'" class="active">'.$v->title.'</a>';
                }else{
                    $output = $output.'<a href="'.asset('/article/'.$v->link).'">'.$v->title.'</a>';
                }
                
            }
            $output = $output.'</div>';
        }
        echo $output;
    }
    public static function ListOfArticleLeft($writerId,$active,$name){
        if(DB::table('articles')->where('writer_id',$writerId)->exists()){
            $list = DB::table('articles')->where('writer_id',$writerId)->orderBy('created_at','desc')->get();
            $output = '<div class="vertical-menu" id="leftMenu">
                    <h4>Other Article By '.$name.'</h4>';
           
            foreach($list as $v){
                if($active == $v->title){
                    $output = $output.'<a href="'.asset('/article/'.$v->link).'" class="active">'.$v->title.'</a>';
                }else{
                    $output = $output.'<a href="'.asset('/article/'.$v->link).'">'.$v->title.'</a>';
                }
                
            }
            $output = $output.'</div>';
        }
        echo $output;
    }

    public static function IsPrivate($id){
        if(DB::table('signup')->where('articlePrivacy','1')->where('id',$id)->exists())
            return true;
        else
            return false;
    }
    
    public static function DeleteAuth(){

    }

    
    public static function grouperList(){
        $list = "Add to group,New group";

        $listArr = explode(",",$list);
        $menu = "<ul class='list-group' style='list-style:none;'>";
        $menu .= "<li><a href='javascript:void(0)' data-toggle='modal' data-target='#addtoGroup'>Add to group</a></li>";
        $menu .= "<li><a href='javascript:void(0)' data-toggle='modal' data-target='#newGroup'>New group</a></li>";
        
        $menu .= "</ul>";
        return $menu;

    }

    public static function tags($list){
        $class = array("label-default","label-primary","label-success","label-info","label-warning","label-danger");
        $list = explode(',',$list);
        $result ="";
        $max = sizeof($list);//<8?sizeof($list):8;
        //echo $max;
        for($i=0;$i<$max;$i++){
            $result .= ' <span class="label '.$class[$i%6].'">'.$list[$i].'</span>';
        }

        return $result;
    }
}

?>