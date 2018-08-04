<?php

namespace Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\SycosFunctions;

class CompanionFunction extends Facade{

    public static function CheckRequestSent($ProfilePage){
        //check if the request is sent of not.
        //return true if request is sent
        $senderid = Auth::user()->id;  //login user is sender
        $reciverId = DB::table('signup')->where('name',$ProfilePage)->first()->id;  //profile page is reciver
            if(DB::table('companions_table')->where('sender_id',$senderid)->where('reciver_id', $reciverId)->where('companion','0')->exists()){
                return '1';
            }else{
                return '0';
            }
    }

    public static function CheckCompanion($ProfilePage){
        // return true if companions 

        if(Auth::user()){
            $senderid = Auth::user()->id;
            $reciverId = DB::table('signup')->where('name',$ProfilePage)->first()->id;
            
            if(DB::table('companions_table')->where('sender_id',$senderid)->where('reciver_id', $reciverId)->where('companion','1')->exists()){
                return '1';
            }elseif(DB::table('companions_table')->where('sender_id',$reciverId)->where('reciver_id', $senderid)->where('companion','1')->exists()){
                return '1';
            }else{
                return '0';
            }
        }
        
    }

    public static function NewCount($profilePage){
        
        $pageId = DB::table('signup')->where('name',$profilePage)->first()->id;

        if(Auth::user()){
            if(Auth::user()->id==$pageId && DB::table('companions_table')->where('reciver_id',$pageId)->where('companion','0')->exists()){
                return DB::table('companions_table')->where('reciver_id',$pageId)->where('companion','0')->count();
            }else{
                return null;
            }
        }else{
            return null;
        }
        
        
    }

    public static function List($ProfilePage){
        $pageId = DB::table('signup')->where('name',$ProfilePage)->first()->id;

        if(!Auth::user()){
            //show only companions
            if(DB::table('companions_table')->where('sender_id',$pageId)->orwhere('reciver_id', $pageId)->where('companion','1')->exists()){
                $companionList = DB::table('companions_table')->where('sender_id',$pageId)->orwhere('reciver_id', $pageId)->where('companion','1')->get();
                foreach($companionList as $v){
                    if($pageId == $v->reciver_id){
                        CompanionFunction::ReturnDetailsByIdAccepted($v->sender_id);
                    }else{
                        //this mean we send requests to other
                        CompanionFunction::ReturnDetailsByIdAccepted($v->reciver_id);
                    }
                }
            }

        }elseif(Auth::user()->id == $pageId){
            //show everything
            if(DB::table('companions_table')->where('sender_id',$pageId)->orwhere('reciver_id', $pageId)->exists()){
                $companionList = DB::table('companions_table')->where('sender_id',$pageId)->orwhere('reciver_id', $pageId)->get();
                foreach($companionList as $v){
                    if($v->companion == '1'){
                        if($pageId == $v->reciver_id){
                            CompanionFunction::ReturnDetailsByIdAccepted($v->sender_id);
                        }else{
                            //this mean we send requests to other
                            CompanionFunction::ReturnDetailsByIdAccepted($v->reciver_id);
                        }
                    }else{
                        if($pageId == $v->reciver_id){
                            // if reciver then  show add or reject button
                            CompanionFunction::ReturnDetailsById($v->sender_id,$v->id);
                        }else{
                            //if sender then show the id
                            CompanionFunction::ReturnDetailById_SendedRequest($v->reciver_id,$v->id);
                        }
                    }
                    
                }
            }else{
                echo 'no companion';
            }

        }elseif(Auth::user()->id != $pageId){
            //show companions and sender option
            if(DB::table('companions_table')->where('sender_id',$pageId)->orwhere('reciver_id', $pageId)->exists()){
                $companionList = DB::table('companions_table')->where('sender_id',$pageId)->orwhere('reciver_id', $pageId)->get();
                foreach($companionList as $v){
                    if($v->id == '1'){
                        if($pageId == $v->reciver_id){
                            CompanionFunction::ReturnDetailsByIdAccepted($v->sender_id);
                        }else{
                            //this mean we send requests to other
                            CompanionFunction::ReturnDetailsByIdAccepted($v->reciver_id);
                        }
                    }else{
                        if($v->reciver_id == $pageId){
                            CompanionFunction::ReturnDetailById_SendedRequest($v->reciver_id,$v->id);
                        }
                    }
                    
                }
            }else{
                echo 'no companion';
            }

        }else{
            //some error
        }

    }


    public static function ReturnDetailsById($id,$compaionID){
        
        $type = DB::table('signup')->where('id',$id)->first()->usertype;
        $profilePage = DB::table('signup')->where('id',$id)->first()->name;
        $compaionID = SycosFunctions::En_De_crypt($compaionID.'<wxwxwx>'.$profilePage,'e');

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $detail  = DB::table('studenttable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->studentName.'</p></a>
                                        
                                    </div>  
                                </div>
                            </td>
                            <td>
                                <form  id="RequestAccept" style="display:none;" action="'.asset('/AcceptRequest/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button class="btn btn-primary" onclick="event.preventDefault();document.getElementById(\'RequestAccept\').submit();" >Add companion</button>
                            </td>
                            <td>
                                <form  id="requestReject" style="display:none;" action="'.asset('/requestReject/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button  class="btn btn-danger" onclick="event.preventDefault();document.getElementById(\'requestReject\').submit();">Reject Request</button>
                                
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Teacher':

                    $detail = DB::table('teachertable')->where('user_id', $id)->first();
                    
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->first_name.'</p></a>
                                    </div>  
                                </div>
                            </td>
                            <td>
                                <form  id="RequestAccept" style="display:none;" action="'.asset('/AcceptRequest/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button class="btn btn-primary" onclick="event.preventDefault();document.getElementById(\'RequestAccept\').submit();" >Add companion</button>
                            </td>
                            <td>
                                <form  id="requestReject" style="display:none;" action="'.asset('/requestReject/'.$compaionID).'" method="post">
                                '.csrf_field().'
                                </form>
                                <button  class="btn btn-danger" onclick="event.preventDefault();document.getElementById(\'requestReject\').submit();">Reject Request</button>
                                
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Coaching Institute':
                    $detail = DB::table('coachingtable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->Institute_name.'</p></a>
                                        
                                    </div>  
                                </div>
                            </td>
                            <td>
                                <form  id="RequestAccept" style="display:none;" action="'.asset('/AcceptRequest/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button class="btn btn-primary" onclick="event.preventDefault();document.getElementById(\'RequestAccept\').submit();" >Add companion</button>
                            </td>
                            <td>
                                <form  id="requestReject" style="display:none;" action="'.asset('/requestReject/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button  class="btn btn-danger" onclick="event.preventDefault();document.getElementById(\'requestReject\').submit();">Reject Request</button>
                                
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



    public static function ReturnDetailById_SendedRequest($id,$compaionID){

        $type = DB::table('signup')->where('id',$id)->first()->usertype;
        $profilePage = DB::table('signup')->where('id',$id)->first()->name;
        $compaionID = SycosFunctions::En_De_crypt($compaionID.'<wxwxwx>'.$profilePage,'e');

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $detail  = DB::table('studenttable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:40px;">
                                    </div>
                                    <div class="col-xs-9">
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->studentName.'</p></a>
                                    </div>  
                                </div>
                            </td>
                            <td>
                                
                                <h5 >Wating for response</h5>
                            </td>
                            <td>
                                <form  id="delRequest" style="display:none;" action="'.asset('/requestReject/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button  class="btn btn-danger" onclick="event.preventDefault();document.getElementById(\'delRequest\').submit();">Delete Request</button>
                                
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Teacher':

                    $detail = DB::table('teachertable')->where('user_id', $id)->first();
                    
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:40px;">
                                    </div>
                                    <div class="col-xs-9">
                                    <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->first_name.'</p></a>
                                    </div>  
                                </div>
                            </td>
                            <td>
                                
                                <h5 >Wating for response</h5>
                            </td>
                            <td>
                                <form  id="delRequest" style="display:none;" action="'.asset('/requestReject/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button  class="btn btn-danger" onclick="event.preventDefault();document.getElementById(\'delRequest\').submit();">Delete Request</button>
                                
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Coaching Institute':
                    $detail = DB::table('coachingtable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="" style="width:40px; height:40px;">
                                    </div>
                                    <div class="col-xs-9">
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->Institute_name.'</p></a>
                                        
                                    </div>  
                                </div>
                            </td>
                            <td>
                                
                                <h5 >Wating for response</h5>
                            </td>
                            <td>
                                <form  id="delRequest" style="display:none;" action="'.asset('/requestReject/'.$compaionID).'" method="post">
                                    '.csrf_field().'
                                </form>
                                <button  class="btn btn-danger" onclick="event.preventDefault();document.getElementById(\'delRequest\').submit();">Delete Request</button>
                                
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


    public static function ReturnDetailsByIdAccepted($id){
        $type = DB::table('signup')->where('id',$id)->first()->usertype;
        $compaionID = DB::table('signup')->where('id',$id)->first()->name;

            switch($type){
                case 'Student':
                    //return $data->usertype;
                    $detail  = DB::table('studenttable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->studentName.'</p></a>
                                       
                                    </div>  
                                </div>
                            </td>
                            <td>
                                
                               
                            </td>
                            <td>
                                <h5>Your Study Companion</h5>
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Teacher':

                    $detail = DB::table('teachertable')->where('user_id', $id)->first();
                    
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->first_name.'</p></a>
                                        
                                    </div>  
                                </div>
                            </td>
                            <td>
                                
                               
                            </td>
                            <td>
                                <h5>Your Study Companion</h5>
                            </td>
                                
                            
                        </tr>';
                    return $detail;
                break;

                case 'Coaching Institute':
                    $detail = DB::table('coachingtable')->where('user_id', $id)->first();
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-xs-3">
                                            <img src="'.asset("/storage/profileImage/".$detail->imageLink).'" style="width:40px; height:auto;">
                                    </div>
                                    <div class="col-xs-9">
                                        
                                        <a href="'.asset('/profile/'.$detail->profilePage).'"><p>'.$detail->Institute_name.'</p></a>
                                    </div>  
                                </div>
                            </td>
                            <td>
                                
                               
                            </td>
                            <td>
                                <h5>Your Study Companion</h5>
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

    public static function ListOfAllCompanions($id){
            
            
            $companions =array();
            if(DB::table('companions_table')->where('sender_id',$id)->where('companion','1')->exists()){
                $list1 = DB::table('companions_table')->select('reciver_id')->where('sender_id',$id)->where('companion','1')->get();
                foreach($list1 as $v){
                    array_push($companions,$v->reciver_id);
                }
            }
            if(DB::table('companions_table')->where('reciver_id', $id)->where('companion','1')->exists()){
                $list2 = DB::table('companions_table')->select('sender_id')->where('reciver_id',$id)->where('companion','1')->get();
                foreach($list2 as $v){
                    array_push($companions,$v->sender_id);
                }
            }
           // array_push($companions,$id);
            return $companions;
        
    }
}

?>