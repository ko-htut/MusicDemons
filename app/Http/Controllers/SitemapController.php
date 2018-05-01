<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Entities\Artist;
use App\Entities\Person;
use App\Entities\Song;

class SitemapController extends Controller
{
    public function all() {
        $artists = Artist::all();
        $people  = Person::all();
        $songs   = Song::all();
        
        $chunksize = 100;
        return Response::view('sitemap.all',compact('artists','people','songs','chunksize'))->header('Content-Type', 'application/xml');
    }
    
    public function artist_chunk($start, $end) {
        $subjects = Artist::skip($start)->take($end - $start)->get();
        $route = 'artist.show_name';
        return Response::view('sitemap.chunk',compact('subjects', 'route'))->header('Content-Type', 'application/xml');
    }
    
    public function person_chunk($start, $end) {
        $subjects = Person::skip($start)->take($end - $start)->get();
        $route = 'person.show_name';
        return Response::view('sitemap.chunk',compact('subjects', 'route'))->header('Content-Type', 'application/xml');
    }
    
    public function song_chunk($start, $end) {
        $subjects = Song::skip($start)->take($end - $start)->get();
        $route = 'song.show_name';
        return Response::view('sitemap.chunk',compact('subjects', 'route'))->header('Content-Type', 'application/xml');
    }
}
