<?xml version="1.0" encoding="UTF-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
  <ShortName>{{ config('app.name') }}</ShortName>
  <Description>Search {{ config('app.name') }}</Description>
  <InputEncoding>UTF-8</InputEncoding>
  <Url type="text/html" method="get" template="{!! $search !!}" />
  <Url type="application/x-suggestions+json" method="GET" template="{!! $suggest !!}" />
  <Url type="application/opensearchdescription+xml" rel="self" template="{{ url('opensearch.xml') }}" />
  <Image height="128" width="128" type="image/png">{{ asset('img/music_note_4.png') }}</Image>
</OpenSearchDescription>