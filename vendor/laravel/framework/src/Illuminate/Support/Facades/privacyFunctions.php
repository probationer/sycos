<?php

namespace Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\CompanionFunction;

class privacyFunctions extends Facade
{
    // return false if privacy is on and not ur are companion

    public static function checkPrivacyOnArticle($PageLink){
        if(DB::table('signup')->where('name',$PageLink)->first()->articlePrivacy == '1'){
            if(CompanionFunction::CheckCompanion($PageLink) == '1'){
                return true;
            }elseif(Auth::user()){
                if(Auth::user()->name == $PageLink){
                    return true;
                }
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    public static function checkPrivacyOnVideo($PageLink){
        if(DB::table('signup')->where('name',$PageLink)->first()->videoPrivacy == '1'){
            if(CompanionFunction::CheckCompanion($PageLink) == '1'){
                return true;
            }elseif(Auth::user()){
                if(Auth::user()->name == $PageLink){
                    return true;
                }
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    public static function checkPrivacyOnComment($PageLink){
        if(DB::table('signup')->where('name',$PageLink)->first()->commentPrivacy == '1'){
            if(CompanionFunction::CheckCompanion($PageLink) == '1'){
                return true;
            }elseif(Auth::user()){
                if(Auth::user()->name == $PageLink){
                    return true;
                }
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
}



?>