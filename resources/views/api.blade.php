@extends('layouts.root')

@section('title')
  <title>LyricDB - API</title>
@endsection

@section('content')
    <h4>API</h4>
    <h5>v1</h5>
    <div class="table-responsive">
        <table class="table table-bordered m-0">
            <tr>
                <td>Resource</td>
                <td>Action</td>
                <td>URL</td>
                <td>HTTP-method</td>
                <td>Response</td>
            </tr>
            <tr>
                <td rowspan="2">Person</td>
                <td>List</td>
                <td>{{ route('api-v1-person.index') }}</td>
                <td>GET</td>
                <td>
                    <pre class="m-0">[{
    "id",
    "first_name",
    "last_name",
    "nickname",
    "born",
    "died",
    "birth_place",
    "text"
}]</pre>
                </td>
            </tr>
            <tr>
                <td>Get</td>
                <td>{{ route('api-v1-person.show', ['person' => '&#123;person&#125;']) }}</td>
                <td>GET</td>
                <td>
                    <pre class="m-0">{
    "id",
    "first_name",
    "last_name",
    "nickname",
    "born",
    "died",
    "birth_place",
    "text"
}</pre>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Artist</td>
                <td>List</td>
                <td>{{ route('api-v1-artist.index') }}</td>
                <td>GET</td>
                <td>
                    <pre class="m-0">[{
    "id",
    "name",
    "year_started",
    "year_quit",
    "text",
    "members":[{
        "id",
        "first_name",
        "last_name",
        "nickname",
        "born",
        "died",
        "birth_place",
        "text",
        "pivot":{
            "active"
        }
    }],
    "songs":[{
        "id",
        "title",
        "released",
        "text",
        "latest_lyrics":{
            "id",
            "lyrics",
            "timing"
        }
    }]
}]</pre>
                </td>
            </tr>
            <tr>
                <td>Get</td>
                <td>{{ route('api-v1-artist.show', ['artist' => '&#123;artist&#125;']) }}</td>
                <td>GET</td>
                <td>
                    <pre class="m-0">{
    "id",
    "name",
    "year_started",
    "year_quit",
    "text",
    "members":[{
        "id",
        "first_name",
        "last_name",
        "nickname",
        "born",
        "died",
        "birth_place",
        "text",
        "pivot":{
            "active"
        }
    }],
    "songs":[{
        "id",
        "title",
        "released",
        "text",
        "latest_lyrics":{
            "id",
            "lyrics",
            "timing"
        }
    }]
}</pre>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Song</td>
                <td>List</td>
                <td>{{ route('api-v1-song.index') }}</td>
                <td>GET</td>
                <td>
                    <pre class="m-0">[{
    "id",
    "title",
    "released",
    "text",
    "latest_lyrics":{
        "id",
        "lyrics",
        "timing"
    }
}]</pre>
                </td>
            </tr>
            <tr>
                <td>Get</td>
                <td>{{ route('api-v1-song.show',['song' => '&#123;song&#125;']) }}</td>
                <td>GET</td>
                <td>
                    <pre class="m-0">{
    "id",
    "title",
    "released",
    "text",
    "latest_lyrics":{
        "id",
        "lyrics",
        "timing"
    }
}</pre>
                </td>
            </tr>
        </table>
    </div>
@endsection