<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{asset('/')}}</loc>
   </url>
   @foreach($secondLevel as $v)
        <url>
            <loc>{{asset('/'.$v)}}</loc>
            
        </url>
    @endforeach

   
     <?php 
     /*  @foreach($otherMap as $v)
        <url>
            <loc>{{asset('/sitemap/'.$v)}}</loc>
            
        </url>
        @endforeach
        */?>
    

    <url>
        <loc>{{asset('/video/create')}}</loc>
        
    </url>
    @foreach ($video as $v)
    <url>
         <loc>{{asset('/video/'.$v->link)}}</loc>
         
    </url>
    @endforeach

    @foreach ($profile as $p)
   <url>
        <loc>{{asset('/profile/'.$p->name)}}</loc>
        
   </url>
   <url>
        <loc>{{asset('/profile/'.$p->name.'/detail')}}</loc>
        
    </url>
   <url>
        <loc>{{asset('/profile/'.$p->name.'/article')}}</loc>
        
    </url>
    <url>
        <loc>{{asset('/profile/'.$p->name.'/video')}}</loc>
        
    </url>
    <url>
        <loc>{{asset('/profile/'.$p->name.'/companion')}}</loc>
        
    </url>
   <url>
        <loc>{{asset('/profile/'.$p->name.'/comment')}}</loc>
        
    </url>
    @endforeach

    <url>
        <loc>{{asset('/article/create')}}</loc>
        
   </url>
    @foreach ($article as $v)
    <url>
         <loc>{{asset('/article/'.$v->link)}}</loc>
         
    </url>
    @endforeach
    
</urlset>