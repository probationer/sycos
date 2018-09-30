<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\article; 

class articleController extends Controller
{
    public function index()
    {
        $articles = article::orderBy('created_at','desc')->get();
        $array = ['title'=>'Linked Tutorials','articles'=>$articles,'tags'=>'tutorial,sycos, sycos.in, read'];
        return view('functional.articles.show')->with('articleArray',$array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //  return view('functional.articles.edit')->with('articleArray',$array);
        $array = ['title'=>' Write Article','tags'=>'write article,sycos, sycos.in, tutorial create'];
        return view('functional.articles.write')->with('articleArray',$array);
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
            'body' => 'required|min:10',
        ]);
        
        $title = trim($request->input('title'),"?");
        $title = str_replace(" ","-",$title);
        $title = str_replace("_","-",$title);

        if(Auth::user()){

            //create article
            $article = new article;
            $article->title = $request->input('title');
            $article->writer_id = Auth::user()->id;
            $article->body = $request->input('body');
            $article->tags = ucwords($request->input('tags')).',';
            $article->link = $title.'-'.mt_rand(Auth::user()->id,1000);
            $article->views ='0';
            $article->save();

            return redirect('profile/'.Auth::user()->name)->with('success','Your article is created');
        }else{
            return redirect('article/create')->with('login','Please login to save this');
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
        
        $id = DB::table('articles')->where('link', $link)->first()->id;

        $writer_id = DB::table('articles')->where('link', $link)->first()->writer_id;
        $name = DB::table('signup')->where('id',$writer_id)->first()->name;

        $articleArray = article::find($id);
        $array = ['detail'=>$articleArray,'writer'=>$name,'title'=> $articleArray->title,'tags'=>$articleArray['tags']];

        return view('functional.articles.showSingleArticle')->with('articleArray',$array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($link)
    {
        
            $id = DB::table('articles')->where('link',$link)->first()->id;
            
            $articleArray = article::find($id);
            $writer_id = DB::table('articles')->where('link', $link)->first()->writer_id;
            $name = DB::table('signup')->where('id',$articleArray->writer_id)->first()->name;

            $array = ['detail'=>$articleArray,'writer'=>$name,'title'=> $articleArray->title,'tags'=>$articleArray['tags']];

            return view('functional.articles.edit')->with('articleArray',$array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $link)
    {
        $this->validate($request ,[
            'title'=>'required|min:3',
            'body'=>'required'
        ]);

        //update article
        $articledetail = DB::table('articles')->where('link', $link)->first();
        $id = $articledetail->id;

        if(Auth::user()->id!= $articledetail->writer_id){
            return redirect('/login')->with('error','Invalid user');
        }
        $article = article::find($id);
        $article->title = $request->input('title');
        $article->body = $request->input('body');
            $article->save();

            return redirect('article/'.$link)->with('success','Your article has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($link)
    {
        $articledetail = DB::table('articles')->where('link', $link)->first();
        $id = $articledetail->id;
        
        if(Auth::user()->id!=$articledetail->writer_id){
            return redirect('/login')->with('error','Invalid user');
        }
        $articleArray = article::find($id);
        $articleArray -> delete();
        return redirect('/profile')->with('success','Your Article is deleted');
    }

    public function fileUpload(Request $request){
        $this->validate($request ,[
            'title'=>'required|min:3',
            'pdfFile' => 'required|mimes:pdf|max:50000',
        ]);

        $title = trim($request->input('title'),"?");
        $title = str_replace(" ","-",$title);
        $title = str_replace("_","-",$title);

        $pdfName = $title.'-'.mt_rand(Auth::user()->id,1000);
            $fileNameWithExt = $request->file('pdfFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('pdfFile')->getClientOriginalExtension();
            if($extension == 'pdf'){
                $NameToStore = $pdfName.".".$extension;
                $path = Storage::putFileAs('public/docs', $request->file('pdfFile'),$NameToStore);//->move('/storage/app/public/docs' , $NameToStore);

            }else{
                return redirect()->back()->with('error','File Must Be A Pdf!');
            }


        if(Auth::user()){

            //create article
            $article = new article;
            $article->title = $request->input('title');
            $article->type = 'pdf';
            $article->writer_id = Auth::user()->id;
            //$article->body = $request->input('body');
            $article->tags = $request->input('tags').',';
            $article->link = $pdfName;
            $article->views ='0';
            $article->save();

            return redirect('profile/'.Auth::user()->name)->with('success','Your article is created');
        }else{
            return redirect('article/create')->with('login','Please login to save this');
        }
        
    }
    
}
