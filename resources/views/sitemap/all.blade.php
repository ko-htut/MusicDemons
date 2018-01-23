<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="{{ url('css/sitemap.xsl') }}"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@for($i = 0; $i < $artists->count(); $i += $chunksize)
    <sitemap>
        <loc>{{ route('sitemap-artist.chunk', ['start' => $i, 'end' => $i + $chunksize - 1]) }}</loc>
        <lastmod>{{ date('c', strtotime(App\Entities\Artist::skip($i)->take($chunksize)->get()->max('updated_at'))) }}</lastmod>
    </sitemap>
@endfor
@for($i = 0; $i < $people->count(); $i += $chunksize)
    <sitemap>
        <loc>{{ route('sitemap-person.chunk', ['start' => $i, 'end' => $i + $chunksize - 1]) }}</loc>
        <lastmod>{{ date('c', strtotime(App\Entities\Person::skip($i)->take($chunksize)->get()->max('updated_at'))) }}</lastmod>
    </sitemap>
@endfor
@for($i = 0; $i < $songs->count(); $i += $chunksize)
    <sitemap>
        <loc>{{ route('sitemap-song.chunk', ['start' => $i, 'end' => $i + $chunksize - 1]) }}</loc>
        <lastmod>{{ date('c', strtotime(App\Entities\Song::skip($i)->take($chunksize)->get()->max('updated_at'))) }}</lastmod>
    </sitemap>
@endfor
</sitemapindex>