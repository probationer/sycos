<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
  
    <url>
        <loc>{{asset('/')}}</loc>
        <lastmod>{{ date("Y-m-d h:i:sa") }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
   </url>
   @foreach($secondLevel as $v)
        <url>
            <loc>{{asset('/'.$v)}}</loc>
            <lastmod>{{ date("Y-m-d h:i:sa") }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach

   @foreach($otherMap as $v)
        <url>
            <loc>{{asset('/sitemap/'.$v)}}</loc>
            <lastmod>{{ date("Y-m-d h:i:sa") }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
    
</urlset>