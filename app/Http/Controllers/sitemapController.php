<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sitemapController extends Controller
{
    
    public function index(){
        //$content = array('profile.xml','article.xml','video.xml',);
        $pages = array('search','get_recommendation','student','teacher','institute','feeds',
                        'video','about','signup','suggestions','sycos_team','login','article','privacy_policy',);
        
        $profile = DB::table('signup')->orderBy('updated_at','desc')->get();
        $article = DB::table('articles')->orderBy('updated_at','desc')->get();
        $video = DB::table('video')->orderBy('updated_at','desc')->get();

        return response()->view('sitemap.index',[
            //'otherMap'=>$content,
            'secondLevel'=>$pages,
            'profile'=>$profile,
            'article'=>$article,
            'video'=>$video
        ])->header('Content-Type', 'text/xml');
    }

    public function profile(){
        $profile = DB::table('signup')->orderBy('updated_at','desc')->get();

        return response()->view('sitemap.profile', [
            'profile' => $profile,
        ])->header('Content-Type', 'text/xml');
    }

    public function article(){
        $data = DB::table('articles')->orderBy('updated_at','desc')->get();

        return response()->view('sitemap.article', [
            'data' => $data,
        ])->header('Content-Type', 'text/xml');
    }

    public function video(){
        $data = DB::table('video')->orderBy('updated_at','desc')->get();

        return response()->view('sitemap.video', [
            'data' => $data,
        ])->header('Content-Type', 'text/xml');
    }
}
