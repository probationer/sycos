<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>{{asset('/video/create')}}</loc>
        <lastmod>{{ date("Y-m-d h:i:sa") }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.64</priority>
    </url>
    @foreach ($data as $v)
    <url>
         <loc>{{asset('/video/'.$v->link)}}</loc>
         <lastmod>{{ $v->updated_at }}</lastmod>
         <changefreq>weekly</changefreq>
         <priority>0.64</priority>
    </url>
    @endforeach
</urlset>