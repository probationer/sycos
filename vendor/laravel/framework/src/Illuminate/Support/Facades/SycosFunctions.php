<?php

namespace Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SycosFunctions extends Facade
{
    public static function ArryaToString($Array){
        $string = '';
            foreach ($Array as $v){
                $string = $string.$v.',';
            }
            return $string;
    }

    public static function MarkSelected($SelectedOptions,$Options){
        
        $j=0;
        $selectedOpt = explode(',', $SelectedOptions);//always in increasing order or in alphabatic order
        
        $Opt = explode(',', $Options);
        
        for($i=0;$i<sizeof($Opt)-1;$i++){
            if($j<sizeof($selectedOpt) && (trim($selectedOpt[$j])==$Opt[$i])){
                echo '<option value="'.$Opt[$i].'" selected="selected">'.$Opt[$i].'</option>';
                $j++;
            }
            else{
                echo '<option value="'.$Opt[$i].'">'.$Opt[$i].'</option>';
            }
        }
    }


    public static function MarkSelectedArrayReturn( $SelectedOptions, $Options){
        
        
        //always in increasing order or in alphabatic order
        $j=0;
        $Opt = explode(',', $Options);
        
        for($i=0;$i<sizeof($Opt)-1;$i++){
            if($j<sizeof($SelectedOptions) && (trim($SelectedOptions[$j])==$Opt[$i]) )
            {
                echo '<option value="'.$Opt[$i].'" selected="selected">'.$Opt[$i].'</option>';
                $j++;
            }
            else{
                echo '<option value="'.$Opt[$i].'">'.$Opt[$i].'</option>';
            }
        }
    }

   
    public static function MarkSelectedRadio($SelectedOptions, $Options,$name){
        $j=0;
        $selectedOpt = explode(',', $SelectedOptions);//always in increasing order or in alphabatic order
        
        $Opt = explode(',', $Options);

        if($SelectedOptions == '1'){
            $selectedOpt[0] = 'Only Companions';
        }   
        else{
            $selectedOpt[0] = 'Everyone';
        }
            
        
        for($i=0;$i<sizeof($Opt)-1;$i++){
            if($j<sizeof($selectedOpt) && (trim($selectedOpt[$j])==$Opt[$i])){
                echo '<div class="col-sm-3"><input type="radio" value="'.$Opt[$i].'" checked name="'.$name.'"> '.$Opt[$i].'</div>';
                $j++;
            }
            else{
                echo '<div class="col-sm-3"><input type="radio" value="'.$Opt[$i].'" name="'.$name.'"> '.$Opt[$i].'</div>';
            }
        }
       
    }

    public static function PutList($type){
        switch($type){
            case 'age':
                $AgeOptions = '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,';
                return $AgeOptions;
            break;
            case 'sex':
                $SexOptions = 'Male,Female,Other,';
                return $SexOptions;
            break;
            case 'class':
                $ClassOptions = '1,2,3,4,5,6,7,8,9,10,11,12,B.A,B.Com,B.Sc,B.TECH,Baking,SSC,';
                return $ClassOptions;

            break;
            case 'subject':
                $SubjectOptions = 'Accounts,Bank,Biology,Business Studies,C or C++,CA,Chemistry,CS,Economics,English,French,Geography,German,Hindi,History,Html,Java,Mathematics,Physics,Political Science,Sanskrit,Science,Social Science,Stenography,Reasoning,Competitive Mathematics,';
                return $SubjectOptions;
            break;
            case 'state':
                $stateCityOption = 'None,Agartala,Ahmedabad,Aizawl,Andhra Pradesh,Arunachal Pradesh,Assam,Bangalore,Bhopal,Bhubaneswar,Bihar,Chandigarh,Chennai,Chhattisgarh,Dehradun,Delhi,Dispur,Faridabad,Gandhinagar,Gangtok,Ghaziabad,Goa,Gujarat,Haryana,Himachal Pradesh,Hyderabad,Imphal,Itanagar,Jaipur,Jammu,Jharkhand,Kanpur,Karnataka,Kashmir,Kerala,Kohima,Kolkata,Lucknow,Madhya Pradesh,Maharashtra,Manipur,Meghalaya,Mizoram,Mumbai,Nagaland,Nagpur,Orissa,Panaji,Patna,Pune,Punjab,Raipur,Rajasthan,Ranchi,Shillong,Shimla,Sikkim,Srinagar,Surat,Tamil Nadu,Telangana,Thiruvananthapuram,Tripura,Uttar Pradesh,Uttarakhand,Visakhapatnam,West Bengal,';
                return $stateCityOption;
            break;

            case 'privacy':
                $Options = 'Everyone,Only Companions,';
                return $Options;
            
            default:
                return 'wrong options';
            break;
        }
    }

    // this will create tag and use to search better

    public static function CreateTagFromString($string){

        if (strpos($string, ',') != false) {
            $newArray = explode(',',$string);
        }else{
            $newArray = explode(' ',$string);
        }
        
        $j=0;
        foreach($newArray as $v){
            if($j<sizeof($newArray)-1){
                echo '<button style="margin-top:5px;" class="btn"><small>'.$v.'</small></button> ';
            }
            $j++;
        }
    }
    
    
    public static function input_validate($data) {
        // take input of data trim, remove forward and backward slash, maintains hmtl tags. and sanitize string
        $data1 = trim($data);
        $data1 = substr_replace("%","",0);
        $data1 = stripslashes($data1);
        $data1 = htmlspecialchars($data1);
        $data1 = filter_var($data1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        return $data1;
        
    }


    public static function checkspace($v){
        if($v!=" ") {return $v;}
   
    }

    public static function ShowProfileOptions($SelectedOptions){
        
        $selectedOpt = explode(',', $SelectedOptions);//always in increasing order or in alphabatic order
        
        for($i=0;$i<sizeof($selectedOpt)-1;$i++){
            echo '<option value="'.$selectedOpt[$i].'">'.$selectedOpt[$i].'</option>';
        }
    }

    public static function RequestRecived($pageLink){
        if(!Auth::user()){
            return redirect('/profile/'.$pageLink)->with('login','Please loggin before sending request');
        }else{
            $type = Auth::user()->usertype;
            $i=0;
            if($type == 'Student'){
                if(DB::table('contactinfostudent')->where('profilePage',Auth::user()->name)){
                    $data = DB::table('contactinfostudent')->where('profilePage',Auth::user()->name)->orderBy('created_at','desc')->get();
                    foreach($data as $v){
                        $i++;
                        echo '<tr>
                            
                        <td>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                    <a href="'.asset('/showRequestToStudent/'.SycosFunctions::En_De_crypt($v->id,'e')).'"> '.($i).'. '.$v->requesterName.'</a>
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
                        <td>';
                        if($v->viewed == "1"){
                            echo "viewed";
                        }else{
                            echo "Not viewed";
                        }
                        '</td>
                    </tr>';
                    }
                }else{
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            No Requests
                                        </div>
                                    </div>                                                
                                </div>
                            </td>
                            
                        </tr>';
                }

            }else{
                if(DB::table('contactinfo')->where('profilePage',Auth::user()->name)){
                    $data = DB::table('contactinfo')->where('profilePage',Auth::user()->name)->orderBy('created_at','desc')->get();
                    foreach($data as $v){
                        $i++;
                        echo '<tr>
                            
                        <td>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                    <a href="'.asset('/showRequest/'.SycosFunctions::En_De_crypt($v->id,'e')).'"> '.($i).'. '.$v->requesterName.'</a>
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
                        <td>';
                        if($v->viewed == "1"){
                            echo "viewed";
                        }else{
                            echo "Not viewed";
                        }
                        '</td>
                    </tr>';
                    }
                }else{
                    echo '<tr>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            No Requests
                                        </div>
                                    </div>                                                
                                </div>
                            </td>
                            
                        </tr>';
                }
            }
        }
    }


    public static function RequestRecivedCount(){

        if(Auth::user())
            $type = Auth::user()->usertype;
            $i=0;
            if($type == 'Student'){
                if(DB::table('contactinfostudent')->where('profilePage',Auth::user()->name)->where('viewed','0')->exists()){
                    $i = DB::table('contactinfostudent')->where('profilePage',Auth::user()->name)->where('viewed','0')->count();
                    echo '<small class="badge">'.$i.'</small>';
                }else{
                    
                }

            }else{
                if(DB::table('contactinfo')->where('profilePage',Auth::user()->name)->where('viewed','0')->exists()){
                    $i = DB::table('contactinfo')->where('profilePage',Auth::user()->name)->where('viewed','0')->count();
                    
                    echo '<small class="badge">'.$i.'</small>';
                }else{
                    
                }
            }
        }
    

    
    
    
    
    
    //used while show requester Information. contact-Information, contact-information-student
    // 'e' -- encrpt data
    // 'd' -- decrpt data
    public static function En_De_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = '26-11';
        $secret_iv = '1993';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }

//this function return and page address with some starign and ending symbols
// input : localhost/mark3/public/egnx/ljksfl
//return : ^^egnx/ljksfl^^
    public static function pageAddress(){
        $uri = $_SERVER['REQUEST_URI'];
        //$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $newProtocol = explode('/',$uri);
        $url = '';
        $starting =  array_search('public',$newProtocol);

        for($i=$starting+1; $i<sizeof($newProtocol); $i++){
            $url = $url.'/'.$newProtocol[$i];
        }
        //$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $newProtocol[sizeof($newProtocol)-1];
    }

    public static function articleFeeds(){
        
       
    }


    public static function newFeeds(){
        $feedsData =array();
        if(DB::table('articles')->exists()){
            $data = DB::table('articles')->orderBy('created_at','desc')->get();
            $noOfArticle = DB::table('articles')->count();
            $feedsData['article'] = $data;
            $feedsData['Acount'] = $noOfArticle;
        }else{
            $data = null;
            $feedsData['article'] = $data;
            $feedsData['Acount'] = null;
        }

        if(DB::table('video')->exists()){
            $data = DB::table('video')->orderBy('created_at','desc')->get();
            $noOfvideo = DB::table('video')->count();
            $feedsData['video'] = $data;
            $feedsData['Vcount'] = $noOfvideo;
        }else{
            $data = null;
            $feedsData['video'] = $data;
            $feedsData['Vcount'] = null;
        }
        return $feedsData;
    }

    public static function articleCount(){
        $count = DB::table('articles')->count();
        return $count;
    }

    public static function videoCount(){
        $count = DB::table('video')->count();
        return $count;
    }

    public static function companionsCount(){
        $count = DB::table('signup')->count();
        return $count;
    }

    public static function requestCount(){
        $count = DB::table('companions_table')->count();
        $count = $count + DB::table('contactinfostudent')->count();
        $count = $count + DB::table('contactinfo')->count();
        return $count;
    }

    public static function content_list($value){
        if(Auth::user()){
            $list = DB::table('articles')->where('writer_id',Auth::user()->id)->get();
            $listReturn = null;
            foreach($list as $v){
                $listReturn .= '<option value="'.$v->link.'">'.$v->title.'</option>';
            }
            return $listReturn;  
        }
        
    }

    public static function group_list(){
        if(Auth::user()){
            $list = DB::table('content_group')->where('user_id',Auth::user()->id)->get();
            $listReturn = null;
            foreach($list as $v){
                $listReturn .= '<option value="'.$v->gname.'">'.$v->gname.'</option>';
            }
            return $listReturn;
        }
    }
    
    
}



?>