<?php

namespace Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class commentFunction extends Facade{

    public static function comments($pageLink){
        
        if(DB::table('signup')->where('name',$pageLink)->exists() || DB::table('articles')->where('link',$pageLink)->exists() || DB::table('video')->where('link',$pageLink)->exists()){
        
            if(DB::table('comments_table')->where('link_page',$pageLink)->exists()){

            
                $comments = DB::table('comments_table')->where('link_page',$pageLink)->get();
                foreach($comments as $v){
                    switch($v->type){
                        case 'Profile':
                            $pageid = DB::table('signup')->where('name',$pageLink)->first()->id;
                            commentFunction::ShowProfileCommenterDetail($pageid,$v->commentId, $v->commenter_id,$v->comment, $v->rating);
                        break;
                        case 'Article':
                            $pageid = null;
                            commentFunction::ShowArticleCommenterDetailForArticle($pageid,$v->commentId, $v->commenter_id,$v->comment, $v->rating);
                        break;

                        case 'Video':
                            $pageid = null;
                            commentFunction::ShowArticleCommenterDetailForVideo($pageid,$v->commentId, $v->commenter_id,$v->comment, $v->rating);
                        break;

                        default:
                            return redirect('/');
                        break;
                    }
                    
                }
            }else{
                return '<p style="font:300 14px roboto; margin:20px;">No comments or reviews...</p>';
            }

        }else{
            return redirect('profile/'.$pageLink)->with('error','Something happens');
        }

    }



    public static function ShowProfileCommenterDetail($pageid, $commentID, $id,$comment,$rating){
        
        $userData = DB::table('signup')->where('id',$id)->first();
        $type = $userData->usertype;
        $profilePage = DB::table('signup')->where('id',$id)->first()->name;


        if(commentFunction::DeleteAuth($pageid,$id)){
            $deletButton = '
                                <form action="'.asset('/comment/delete/'.$commentID).'" method="post" id="delComment" class="pull-right">
                                    '.csrf_field().'
                                </form>    
                                <a onclick="event.preventDefault();document.getElementById(\'delComment\').submit();" >
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>';
        }else{
            $deletButton = ' ';
        }

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $detail  = DB::table('studenttable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>'.
                                $deletButton.'
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <p><a href="'.asset("profile/".$detail->profilePage).'">'.$detail->studentName.'</a></p>
                                    </div>  
                                </div>
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-12">
                                        <p>'.$comment.'</p>
                                    </div>  
                                </div>  
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-12" id="ratings">
                                        <span style="color:green"  class="glyphicon glyphicon-book"></span> X '.$rating.'
                                        
                                    </div>  
                                </div>
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Teacher':

                    $detail = DB::table('teachertable')->where('user_id', $id)->first();

                    
                        
                    
                    echo '<tr> 
                            <td>'.
                                $deletButton.'
                            </td>
                            <td>
                            
                                <div class="container-fluid">
                                
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <p><a href="'.asset("profile/".$detail->profilePage).'">'.$detail->first_name.'</a></p>
                                    </div>  
                                </div>
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-12">
                                        <p>'.$comment.'</p>
                                    </div>  
                                </div>  
                            </td>
                            <td>
                             
                                <span style="color:green;"  class="glyphicon glyphicon-book"></span>X '.$rating.'
                                            
                                 
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Coaching Institute':
                    $detail = DB::table('coachingtable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>'.
                                $deletButton.'
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <p><a href="'.asset("profile/".$detail->profilePage).'">'.$detail->Institute_name.'</a></p>
                                    </div>  
                                </div>
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-12">
                                        <p>'.$comment.'</p>
                                    </div>  
                                </div>  
                            </td>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-12" id="ratings">
                                        <span style="color:green"  class="glyphicon glyphicon-book"></span> X '.$rating.'
                                        
                                    </div>  
                                </div>
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    return $detail;
                break;

                default:
                    $detail = null;
                    return $detail;
                break;
            }
    }


    public static function ShowArticleCommenterDetailForArticle($pageid, $commentID, $id,$comment,$rating){
           
        $userData = DB::table('signup')->where('id',$id)->first();
        $type = $userData->usertype;
        $profilePage = DB::table('signup')->where('id',$id)->first()->name;

        $star = '';
        if(commentFunction::DeleteAuth($pageid,$id)){
            $deletButton = '
                                <form action="'.asset('/comment/delete/'.$commentID).'" method="post" id="delComment" class="pull-right">
                                    '.csrf_field().'
                                </form>    
                                <a onclick="event.preventDefault();document.getElementById(\'delComment\').submit();" >
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>';
        }else{
            $deletButton = ' ';
        }

        for($i=1;$i<=5;$i++){
            if($i<=$rating){
                $star = $star.'<span  class="glyphicon glyphicon-star" style="color:yellow"></span>';
            }else{
                $star = $star.'<span  class="glyphicon glyphicon-star" style="color:blue"></span>';
            }
        }


            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $detail  = DB::table('studenttable')->where('user_id', $id)->first();
                    echo '
                    <div style="margin-bottom:20px">
                        
                        <div style="font:600 14px oxygen; margin-bottom:10px;">
                                <img src="'.asset('/storage/profileImage/'.$detail->imageLink).'" class="img-circle" width="40px" height="40px">
                                '.$detail->studentName.'
                        </div>
                        <p>'.$comment.'</p>'.$star.' '.$deletButton.'
                    </div>';
                    return $detail;
                break;

                case 'Teacher':

                    $detail = DB::table('teachertable')->where('user_id', $id)->first();
                    echo '
                    <div style="margin-bottom:20px">
                        
                        <div style="font:600 14px oxygen; margin-bottom:10px;">
                                <img src="'.asset('/storage/profileImage/'.$detail->imageLink).'" class="img-circle" width="40px" height="40px">
                                '.$detail->first_name.'
                        </div>
                        <p>'.$comment.'</p>'.$star.' '.$deletButton.'
                    </div>';
                    return $detail;
                    
                break;

                case 'Coaching Institute':
                    $detail = DB::table('coachingtable')->where('user_id', $id)->first();
                    echo '
                    <div style="margin-bottom:20px">
                        
                        <div style="font:600 14px oxygen; margin-bottom:10px;">
                                <img src="'.asset('/storage/profileImage/'.$detail->imageLink).'" class="img-circle" width="40px" height="40px">
                                '.$detail->Institute_name.'
                        </div>
                        <p>'.$comment.'</p>'.$star.' '.$deletButton.'
                    </div>';
                    return $detail;
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    return $detail;
                break;

                default:
                    $detail = null;
                    return $detail;
                break;
            }
    }


    public static function ShowArticleCommenterDetailForVideo($pageid, $commentID, $id,$comment,$rating){
           
        $userData = DB::table('signup')->where('id',$id)->first();
        $type = $userData->usertype;
        $profilePage = DB::table('signup')->where('id',$id)->first()->name;

        $star = '';
        if(commentFunction::DeleteAuth($pageid,$id)){
            $deletButton = '
                                <form action="'.asset('/comment/delete/'.$commentID).'" method="post" id="delComment" class="pull-right">
                                    '.csrf_field().'
                                </form>    
                                <a onclick="event.preventDefault();document.getElementById(\'delComment\').submit();" >
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>';
        }else{
            $deletButton = ' ';
        }

        for($i=1;$i<=5;$i++){
            if($i<=$rating){
                $star = $star.'<span  class="glyphicon glyphicon-star" style="color:yellow"></span>';
            }else{
                $star = $star.'<span  class="glyphicon glyphicon-star" style="color:blue"></span>';
            }
        }


            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $detail  = DB::table('studenttable')->where('user_id', $id)->first();
                    echo '
                    <div style="margin-bottom:20px">
                        
                        <div style="font:600 14px oxygen; margin-bottom:10px;">
                                <img src="'.asset('/storage/profileImage/'.$detail->imageLink).'" class="img-circle" width="40px" height="40px">
                                '.$detail->student_name.'
                        </div>
                        <p>'.$comment.'</p>'.$star.' '.$deletButton.'
                    </div>';
                    return $detail;
                break;

                case 'Teacher':

                    $detail = DB::table('teachertable')->where('user_id', $id)->first();
                    echo '
                    <div style="margin-bottom:20px">
                        
                        <div style="font:600 14px oxygen; margin-bottom:10px;">
                                <img src="'.asset('/storage/profileImage/'.$detail->imageLink).'" class="img-circle" width="40px" height="40px">
                                '.$detail->first_name.'
                        </div>
                        <p>'.$comment.'</p>'.$star.' '.$deletButton.'
                    </div>';
                    return $detail;
                    
                break;

                case 'Coaching Institute':
                    $detail = DB::table('coachingtable')->where('user_id', $id)->first();
                    echo '
                    <div style="margin-bottom:20px">
                        
                        <div style="font:600 14px oxygen; margin-bottom:10px;">
                                <img src="'.asset('/storage/profileImage/'.$detail->imageLink).'" class="img-circle" width="40px" height="40px">
                                '.$detail->Institute_name.'
                        </div>
                        <p>'.$comment.'</p>'.$star.' '.$deletButton.'
                    </div>';
                    return $detail;
                break;

                case 'Guardian or Parents':
                    $data = DB::table('guardiantable')->where('user_id', $id)->first();
                    return $detail;
                break;

                default:
                    $detail = null;
                    return $detail;
                break;
            }
    }

    public static function DeleteAuth($profileId, $commenterId){
        
        if(Auth::user() && ($profileId ==  Auth::user()->id || $commenterId == Auth::user()->id)){
            return true;
        }else{
            return false;
        }
    }
}

?>