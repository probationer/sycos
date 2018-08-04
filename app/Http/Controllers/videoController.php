<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\videoModel;

class videoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = videoModel::orderBy('created_at','desc')->get();
        $array = ['title'=>'Linked Tutorials','video'=>$video];
        return view('functional.tutorial_video.allVideos')->with('videoArray',$array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array = ['title'=>'Add Video Link'];
        
        return view('functional.tutorial_video.addVideo')->with('videoArray',$array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request ,[
            'title'=>'required|min:3',
            'link'=>'required|max:128',
            'description'=>'max:512'
        ]);

        
        if(Auth::user()){
            $vidoeDetail = videoController::shreadLink($request->input('link'));
            //create article
            $video = new videoModel;
            $video->title = $request->input('title');
            $video->user_id = Auth::user()->id;
            $video->type = $vidoeDetail[0];
            $video->link = $vidoeDetail[1];
            $video->description = $request->input('description');
            $video->views ='0';
                $video->save();
    
                return redirect('profile/'.Auth::user()->name)->with('success','Your video is added');
        }else{
            return redirect('video/create')->with('login','Please login to save this');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($link)
    {
        $id = DB::table('video')->where('link', $link)->first()->id;

        $user_id = DB::table('video')->where('link', $link)->first()->user_id;
        $name = DB::table('signup')->where('id',$user_id)->first()->name;

        $videoArray = videoModel::find($id);
        $array = ['detail'=>$videoArray,'uploader'=>$name,'title'=>$videoArray->title];

        return view('functional.tutorial_video.videoPlayer')->with('videoArray',$array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($link)
    {
        $id = DB::table('video')->where('link',$link)->first()->id;
        $videoArray = videoModel::find($id);
        $array = ['detail'=>$videoArray,'title'=>$videoArray->title];
        return view('functional.tutorial_video.edit')->with('videoArray',$videoArray);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$link)
    {
        $this->validate($request ,[
            'title'=>'required|min:3',
            'link'=>'required|max:128',
            'description'=>'max:512'
        ]);

        
        if(Auth::user()){
            $id = DB::table('video')->where('link',$link)->first()->id;
            $videoDetail = videoController::shreadLink($request->input('link'));
            //create article
            $video = videoModel::find($id);
            $video->title = $request->input('title');
            $video->type = $videoDetail[0];
            $video->link = $videoDetail[1];
            $video->description = $request->input('description');
            $video->save();
    
            return redirect('video/'.$videoDetail[1])->with('success','Updated Choices');
        }else{
            return redirect('video/'.$link)->with('login','Please login to save this');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function shreadLink($youtubeLink){

        $explodedLink = explode('/',$youtubeLink);
        
        if(in_array("youtu.be", $explodedLink)){

            $link = $explodedLink[sizeof($explodedLink)-1];
            return array('single',$link);

        }elseif(in_array("www.youtube.com", $explodedLink)){

            if(strpos($explodedLink[sizeof($explodedLink)-1],'list') != false){ //if list is first key word then it also return zero;
                $lastString = $explodedLink[sizeof($explodedLink)-1];
                $ListWordPosition = strpos($lastString,'list');
                $link = substr($lastString,($ListWordPosition+5));
                return array('list',$link);

            }else{
                $explodedLink2 = array();
                $explodedLink2 = explode('=', $youtubeLink);
                $link = $explodedLink2[sizeof($explodedLink2)-1];
                return array('single',$link);
            }
            
        }else{
            return false;
        }
    }
}
