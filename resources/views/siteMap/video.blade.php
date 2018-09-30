<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{asset('/video/create')}}</loc>
        <lastmod>{{ date('c') }}</lastmod>
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