<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\commentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\singup;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$link)
    {
        $this->validate($request ,[
            'comment'=>'required|min:4|max:255',
        ]);

        if(DB::table('signup')->where('name',$link)->exists()){
            $type = 'Profile';
        }elseif(DB::table('articles')->where('link',$link)->exists()){
            $type = 'Article';
        }else{
            $type = 'Video';
        }

        if($request->input('rating')){
            $rate = $request->input('rating');
        }else{
            $rate = '0';
        }
        
        if(Auth::user()){
        
            //submit comment
            $commnts = new commentModel;
            $commnts->commentId = sha1($link.time());
            $commnts->link_page = $link;
            $commnts->type = $type;
            $commnts->comment = $request->input('comment');
            $commnts->commenter_id = Auth::user()->id;
            $commnts->rating = $rate;
            $commnts->save();
    
            if($type == 'Profile'){
                return redirect('profile/'.$link)->with('success','Thanks for review');
            }elseif($type == 'Article'){
                return redirect('article/'.$link)->with('success','Thanks for your review');
            }elseif($type == 'Video'){
                return redirect('video/'.$link)->with('success','Thanks for your review');
            }
            
        }else{
            if($type == 'Profile'){
                return redirect('profile/'.$link)->with('login','PLEASE LOGIN TO COMMENT');
            }elseif($type == 'Article'){
                return redirect('article/'.$link)->with('login','PLEASE LOGIN TO COMMENT');
            }elseif($type == 'Video'){
                return redirect('video/'.$link)->with('login','PLEASE LOGIN TO COMMENT');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($commentId)
    {
        $commentDetails = DB::table('comments_table')->where('commentId', $commentId)->first();
        $id = $commentDetails->id;
        $link = $commentDetails->link_page;
        $type = $commentDetails->type;
        if(Auth::user()){
            $commentArray = commentModel::find($id);
            $commentArray -> delete();

            return redirect()->back()->with('success','Comment Deleted');
            
    
        }else{
            return redirect('/login')->with('login','Plese login');
        }
        
        
    }
}
