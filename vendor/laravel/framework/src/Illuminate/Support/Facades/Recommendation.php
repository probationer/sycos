<?php

namespace Illuminate\Support\Facades;


class Recommendation extends Facade
{

    public static function rec(){
        if(Auth::user()){
            $loginDetails = Auth::user();
            $type = $loginDetails->usertype;
            $id = $loginDetails->id;


            switch($type){
                case 'Student':
                    //return $data->usertype;
                    return Recommendation::student($id);
                break;

                case 'Teacher':

                    return Recommendation::teacher($id);
                break;

                case 'Coaching Institute':
                    return  Recommendation::coaching($id);
                break;

                case 'Guardian or Parents':
                    return Recommendation::guardian($id);
                break;

                default:
                    return redirect('/');
                break;
            }

        }else{

        }
    }

    public static function student($userId){
        
            if(DB::table('studenttable')->where('user_id',$userId)->get()){
                $student_matching_essintials = DB::table('studenttable')->where('user_id',$userId)->first();
    
    
                $matching_requirements = array('address','classes','subjects','pincode');
    
    
                $student_location = $student_matching_essintials->area;
                $student_class = $student_matching_essintials->classes; 
                $student_subjects = explode(',', $student_matching_essintials->subjects);     // subject array last element is null
                $student_pincode = $student_matching_essintials->pincode;
                $student_state = $student_matching_essintials->state;
    
            //        foreach ($student_subjects as $value) {
            //            echo $value."<br>";
            //        }
            //        echo $student_pincode;
            //        echo $student_class;
            //        echo $student_location."<br>";
    
                $teacher_and_coaching_matching_ids = array();// this holds the elements which is return from search of array;
                $checking_array=array(); //this will store the unique id's from the array;
    
    
                //-----------matching teachers and coaching with pincode, location(coaching), locations(teacher),subjects, classes-------------------------
    
                for($i=0;$i<sizeof($student_subjects)-1;$i++){
                    //teachers having same pincode,subject,clsss
                    
                    if(DB::select('select * from teachertable where pincode=:pincode AND subjects LIKE :subjects AND classes LIKE :class AND status=1',
                        [':pincode'=>$student_pincode,':subjects'=>'%'.$student_subjects[$i].'%',':class'=>'%'.$student_class.'%'])){
                            
                            $v = DB::select('select * from teachertable where pincode=:pincode AND subjects LIKE :subjects AND classes LIKE :class AND status=1',[':pincode'=>$student_pincode,':subjects'=>'%'.$student_subjects[$i].'%',':class'=>'%'.$student_class.'%']);
                            
                            array_push($teacher_and_coaching_matching_ids,$v);
    
                    }
    
                    //teachers having same locations,subject,class.state
                    if($v = DB::select('SELECT * FROM teachertable where locations LIKE :locations AND classes LIKE :classes AND subjects LIKE :subjects AND state=:state AND status=1',
                                 [':locations'=>'%'.$student_location.'%',':classes'=>'%'.$student_class.'%',':subjects'=>'%'.$student_subjects[$i].'%',':state'=>$student_state])){
    
                         array_push($teacher_and_coaching_matching_ids,$v);
    
                    }
    
                    //matching coaching centers with pincode,classes, subjects
                    if($v = DB::select('SELECT * FROM coachingtable where pincode=:pincode AND classes LIKE :classes AND subjects LIKE :subjects',
                                 [':pincode'=>$student_pincode,':classes'=>'%'.$student_class.'%',':subjects'=>'%'.$student_subjects[$i].'%'])){
                        array_push($teacher_and_coaching_matching_ids,$v);
    
                    }
    
    
                    //matching coaching centers with location,classes,subjects,state
                    if($v = DB::select('SELECT * FROM coachingtable where location=:location AND classes LIKE :classes AND subjects LIKE :subjects AND state=:state',
                                 [':location'=>$student_location,':classes'=>'%'.$student_class.'%',':subjects'=>'%'.$student_subjects[$i].'%',':state'=>$student_state])){
                        array_push($teacher_and_coaching_matching_ids,$v);
    
                    }
    
    
                }
    
    
                if(sizeof($teacher_and_coaching_matching_ids)!=0){
    
                    $outputOfSuggestion = ' ';
    
                    foreach($teacher_and_coaching_matching_ids as $var){
                        foreach($var as $v){
                           
                            if(!in_array($v->user_id,$checking_array)){
                                array_push($checking_array,$v->user_id);
    
                                if(array_key_exists('first_name',$v)){
                                    $userName = $v->first_name;
                                }elseif(array_key_exists('Institute_name',$v)){
                                    $userName = $v->Institute_name;
                                }
                                
                                $outputOfSuggestion = $outputOfSuggestion.'<a target="blank" href="'.asset('/profile/'.$v->profilePage).'">
                                <img  style="margin-left: 30px; margin-top:10px; width:50px; height:50px" src="'.asset('/storage/profileImage/'.$v->imageLink).'" alt="recomendation1">
                                <div style="margin-left:100px; margin-top:-55px;">
                                    <p><strong>'.$userName.'</strong> <br>'.$v->subjects.'<br>'.$student_location.'<p>
                                </div>
                                </a>';       
    
                            }
                            
                        }
                        
                    }
    
    

                }else{
                    $outputOfSuggestion = '<p style="font-family:roboto;font-weight:400;font-size:16px;">We will show you some suggestions very soon</p>';
                }
    
                return $outputOfSuggestion;
            }
        
    }

    public static function teacher($userId){
        
            if(DB::select('SELECT * FROM signup WHERE id=:id',[':id'=>$userId])){
                $userType = Auth::user()->usertype;
                if(($userType == 'Teacher')){
                    if(DB::select('SELECT * FROM teachertable WHERE user_id=:id',[':id'=>$userId])){
                    $teacher_matching_essintials = DB::table('teachertable')->where('user_id',$userId)->first();
    
                    $teacher_locations = explode(',',$teacher_matching_essintials->locations);
                    for($i=0;$i<sizeof($teacher_locations);$i++){
                        $teacher_locations[$i] = trim($teacher_locations[$i]);
                    }
                    $teacher_subjects = explode(',',$teacher_matching_essintials->subjects);
                    for($i=0;$i<sizeof($teacher_subjects);$i++){
                        $teacher_subjects[$i] = trim($teacher_subjects[$i]);
                    }
                    $teacher_classes = explode(',',$teacher_matching_essintials->classes);
                    for($i=0;$i<sizeof($teacher_classes);$i++){
                        $teacher_classes[$i] = trim($teacher_classes[$i]);
                    }
                    $teacher_pincode = $teacher_matching_essintials->pincode;
                    $teacher_state = $teacher_matching_essintials->state;
    
    
        //            print_r($teacher_locations);echo sizeof($teacher_locations).'<br>';
        //            print_r($teacher_subjects);echo '<br>';
        //            print_r($teacher_classes);echo '<br>';
        //            echo '<br>';
        //            
                    $student_matching_ids = array();//this array will store all ids of student, those who matches with essentials 
                    $checking_array = array(); //this array stores only unique ids form matching_ids array();
    
                    for($k=0;$k<sizeof($teacher_locations);$k++){
                        if((DB::select('SELECT * FROM studenttable WHERE area LIKE :area AND state LIKE :state AND status=1',
                                [':area'=>'%'.$teacher_locations[$k].'%',':state'=>'%'.$teacher_state.'%']))){//if classes is not null then go to subject loop else next iteration
                            for($i=0;$i<sizeof($teacher_classes)-1;$i++){// size -1 use bcoz last element after comma(,) is null
                                if(!(DB::select('SELECT * FROM studenttable WHERE classes LIKE :classes  AND state=:state AND status=1',[':classes'=>"%".$teacher_classes[$i]."%",':state'=>$teacher_state])==NULL)){//if classes is not null then go to subject loop else next iteration
                                    for($j=0;$j<sizeof($teacher_subjects)-1;$j++){// size -1 use bcoz last element after comma(,) is null
                                        if(!(DB::select('SELECT * FROM studenttable WHERE classes LIKE :classes AND subjects LIKE :subjects AND status=1',[':classes'=>"%".$teacher_classes[$i]."%",':subjects'=>"%".$teacher_subjects[$j]."%"])==NULL)){
    
                                            if($v =DB::select('SELECT * FROM studenttable WHERE classes LIKE :classes AND subjects LIKE :subjects AND pincode=:pincode AND status=1',
                                                    [':classes'=>"%".$teacher_classes[$i]."%",':subjects'=>'%'.$teacher_subjects[$j].'%',':pincode'=>$teacher_pincode]) ){
                                                if(!in_array($student_matching_ids, $v)){
                                                    array_push($student_matching_ids, $v);
                                                }
                                            }
                                            //may be a student have different pincode but location is nearby to coaching 
                                            if($v = DB::select('SELECT * FROM studenttable WHERE classes LIKE :classes AND subjects LIKE :subjects AND area=:area AND state=:state AND status=1',
                                                [':classes'=>"%".$teacher_classes[$i]."%",':subjects'=>'%'.$teacher_subjects[$j].'%',':area'=>'%'.$teacher_locations[$k],':state'=>$teacher_state])){
                                                if(!in_array($student_matching_ids, $v)){
                                                    array_push($student_matching_ids,$v); 
                                                }
                                            }
    
                                        }
    
                                    }
                                }
                            }
                        }
                    }   
                    //echo sizeof($student_matching_ids);
    
                    if(sizeof($student_matching_ids)!=0){
    
    
                        $outputOfsuggestion = ' ';
                        foreach($student_matching_ids as $var){
    
                            foreach($var as $v){
    
                                if(!in_array($v->user_id,$checking_array)){
                                    array_push($checking_array,$v->user_id);
                                    

                                    if(array_key_exists('studentName',$v)){
                                        $userName = $v->studentName;
                                    }elseif(array_key_exists('Institute_name',$v)){
                                        $userName = ' ';
                                    }
    
                                    $outputOfsuggestion = $outputOfsuggestion.'<a target="blank" href="'.asset('/profile/'.$v->profilePage).'">
                                        <img  style="margin-left: 30px; margin-top:10px; width:50px; height:50px" src="'.asset('/storage/profileImage/'.$v->imageLink).'" alt="recomendation1">
                                        <div style="margin-left:100px; margin-top:-55px;">
                                            <p><strong>'.$userName.'</strong> <br>'.$v->subjects.'<br>'.$v->area.'<p>
                                        </div>
                                        </a>';  
                                }
                            }
                        }
    
    
                    }else{
                       $outputOfsuggestion = '<p style="font-family:roboto;font-weight:400;font-size:16px;">We will show you some suggestions very soon</p>';
                    }
                    return $outputOfsuggestion;
                }
                
            }
        }
        
    }

    public static function coaching($userId){
            if(DB::select('SELECT * FROM coachingtable WHERE user_id=:id',[':id'=>$userId])){
                $coaching_matching_essintials = DB::table('coachingtable')->where('user_id',$userId)->first();
    
    
                $institute_location = $coaching_matching_essintials->location;
                $institute_subjects = explode(',',$coaching_matching_essintials->subjects);
                $institute_classes = explode(',',$coaching_matching_essintials->classes);
                $institute_pincode = $coaching_matching_essintials->pincode;
                $institute_state = $coaching_matching_essintials->state;
    
                $student_matching_ids = array();//this array will store all ids of student, those who matches with essentials 
                $checking_array = array(); //this array stores only unique ids form matching_ids array();
                $preChecking_array = array();
                for($i=0;$i<sizeof($institute_classes)-1;$i++){// size -1 use bcoz last element after comma(,) is null
    
                            if(DB::select('SELECT * FROM studenttable WHERE classes LIKE :classes  AND state=:state ',[':classes'=>"%".$institute_classes[$i]."%",':state'=>$institute_state])){//if classes is exixts then go to subject loop else next iteration
                                for($j=0;$j<sizeof($institute_subjects)-1;$j++){// size -1 use bcoz last element after comma(,) is null
                                        if($v = DB::select('SELECT * FROM studenttable WHERE classes LIKE :classes AND subjects LIKE :subjects AND pincode=:pincode AND status=1',
                                            [':classes'=>"%".$institute_classes[$i]."%",':subjects'=>'%'.$institute_subjects[$j].'%',':pincode'=>$institute_pincode])) {                     
                                                if(!in_array($student_matching_ids, $v)){
                                                    array_push($student_matching_ids,$v );
                                                }
    
                                            }
    
                                        if($v = DB::select('SELECT * FROM studenttable WHERE classes LIKE :classes AND subjects LIKE :subjects AND area=:area AND state=:state AND status=1',
                                            [':classes'=>"%".$institute_classes[$i]."%",':subjects'=>'%'.$institute_subjects[$j].'%',':area'=>$institute_location,':state'=>$institute_state])){
                                            if(!in_array($student_matching_ids, $v)){
                                                    array_push($student_matching_ids,$v );
                                                }
                                        }
    
    
    
                                }
                            }
    
                }
    
                $outputOfSuggestion ="";
               //// echo sizeof($student_matching_ids);
    
                if(sizeof($student_matching_ids)!=0){
    
                    $outputOfSuggestion = ' ';
                        foreach($student_matching_ids as $var ){
            
                            foreach($var as $v){
            
                                if(!in_array($v->user_id,$checking_array)){
                                    array_push($checking_array,$v->user_id);
                                    
            
                                    if(array_key_exists('studentName',$v)){
                                        $userName = $v->studentName;
                                    }else{
                                        $userName = $v->first_name;
                                    }

                                    $outputOfSuggestion = $outputOfSuggestion.'<a target="blank" href="'.asset('/profile/'.$v->profilePage).'">
                                        <img  style="margin-left: 30px; margin-top:10px; width:50px; height:50px" src="'.asset('/storage/profileImage/'.$v->imageLink).'" alt="recomendation1">
                                        <div style="margin-left:100px; margin-top:-55px;">
                                            <p><strong>'.$userName.'</strong> <br>'.$v->subjects.'<br>'.$institute_location.'<p>
                                        </div>
                                        </a>';
                                    
                                }
                            }
                        }
    
                }else{
                    //$outputOfSuggestion = '<h3>We will show you some suggestions very soon</h3>';
                    '<p style="font-family:roboto;font-weight:400;font-size:16px;">We will show you some suggestions very soon</p>';
                }
    
                return $outputOfSuggestion;
            }
        
    }
}


?>