<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\validation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\SycosFunctions;
use App\Add_companion;

class CompanionController extends Controller
{
    public function SendRequest($ReciverName){

        if(Auth::user()){
            if(DB::table('signup')->where('name', $ReciverName)){
                $ReciverId = DB::table('signup')->where('name', $ReciverName)->first()->id;
                $senderId = Auth::user()->id;
    
                Add_companion::create([
                    'sender_id' => $senderId,
                    'reciver_id' => $ReciverId,
                    'companion' => '0',
                ]);
    
                return redirect()->back()->with('report','Request send');
            }else{
                return redirect()->back()->with('error','Invalid Request');
            }
           
        }else{
            return redirect()->back()->with('login','Please Login before you add as companion');
        }
    }


    public function AcceptRequest($CompaionRequestId){
        
       // echo $SenderName;
       $Details = SycosFunctions::En_De_crypt($CompaionRequestId,'d');
       $detail = explode('<wxwxwx>',$Details);
        if(Auth::user()){
           
            if(DB::table('companions_table')->where('id', $detail[0])->exists()){
               
                //$ReciverName = DB::table('signup')->where('id',$detail[0])->first()->name;
                $dataInTable = Add_companion::find($detail[0]);

                $dataInTable->companion = '1';
                $dataInTable->save();

                return redirect()->back()->with('report','Congratulations! your got a new study companion');
            }else{
                return redirect()->back()->with('error','Invalid Request');
            }
            
        }else{
            return redirect()->back()->with('login','Please Login before you add as companion');
        }
        
    }

    
    public function requestReject($CompaionRequestId){

        $Details = SycosFunctions::En_De_crypt($CompaionRequestId,'d');
        $detail = explode('<wxwxwx>',$Details);
        if(Auth::user()){
            if(DB::table('companions_table')->where('id',$detail[0])->exists()){
                    
                    $requestDel = Add_companion::find($detail[0]);
                    $requestDel -> delete();

                    return redirect()->back()->with('report','Request deleted');

                }else{
                    return redirect()->back()->with('error','Invalid Request');
                }
            
        }else{
            return redirect()->back()->with('login','Please Login before you add as companion');
        } 
    }
}