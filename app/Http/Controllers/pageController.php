<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\singup;
use App\article;

class pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $articles = article::orderBy('created_at','desc')->get();
        $array = ['title'=>'Linked Tutorials','articles'=>$articles];
        return view('mainPages.home2')->with('articleArray',$array);
             
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
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
    public function destroy($id)
    {
        //
    }




    
    // this function map the page to users profile
    

    public function about(){

        $title= 'About Us';
        return view('mainPages.about')->with('title',$title);
    }

    public function suggestions(){

        $title= 'Suggestions';
        return view('mainPages.feedback')->with('title',$title);
    }

    public function privacy_policy(){
        $title= 'Privacy Policy | Sycos';
        $array = ['title'=>$title];
        return view('mainPages.privacy_policy')->with('userData',$array);
    }
    
    public function feeds(){

    $title= 'New Feeds';
    $array = ['title'=>$title];
    return view('mainPages.newFeeds')->with('userData',$array);
    }

    

}
