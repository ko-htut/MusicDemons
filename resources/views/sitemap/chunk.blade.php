<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="{{ url('css/sitemap.xsl') }}"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($subjects as $subject)
    <url>
        <loc>{{ route($route, $subject) }}</loc>
        <lastmod>{{ date('c', strtotime($subject->updated_at)) }}</lastmod>
        <changefreq>monthly</changefreq>
    </url>
@endforeach
</urlset>