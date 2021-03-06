<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   @foreach ($profile as $p)
   <url>
        <loc>{{asset('/profile/'.$p->name)}}</loc>
        <lastmod>{{ $p->updated_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.64</priority>
   </url>
   <url>
        <loc>{{asset('/profile/'.$p->name.'/detail')}}</loc>
        <lastmod>{{ $p->updated_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.41</priority>
    </url>
   <url>
        <loc>{{asset('/profile/'.$p->name.'/article')}}</loc>
        <lastmod>{{ $p->updated_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.41</priority>
    </url>
    <url>
        <loc>{{asset('/profile/'.$p->name.'/video')}}</loc>
        <lastmod>{{ $p->updated_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.41</priority>
    </url>
    <url>
        <loc>{{asset('/profile/'.$p->name.'/companion')}}</loc>
        <lastmod>{{ $p->updated_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.41</priority>
    </url>
   <url>
        <loc>{{asset('/profile/'.$p->name.'/comment')}}</loc>
        <lastmod>{{ $p->updated_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.41</priority>
    </url>
    @endforeach
</urlset>