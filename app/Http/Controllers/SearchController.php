<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $breadcrumb = array(
            'Home'      =>  route('home.index'),
            'Search'    =>  null
        );
        $selected = array(
            'Artists'   =>  'artist',
            'Albums'    =>  'album',
            'Songs'     =>  'song',
            'People'    =>  'person'
        );
        return view('search/index',compact('breadcrumb','selected'));
    }
    public function artist()
    {
        $breadcrumb = array(
            'Home'      =>  route('home.index'),
            'Search'    =>  route('search-all'),
            'Artist'    =>  null
        );
        $selected = array(
            'Artists'   =>  'artist'
        );
        return view('search/index',compact('breadcrumb','selected'));
    }
    public function album()
    {
        $breadcrumb = array(
            'Home'      =>  route('home.index'),
            'Search'    =>  route('search-all'),
            'Album'     =>  null
        );
        $selected = array(
            'Albums'    =>  'album'
        );
        return view('search/index',compact('breadcrumb','selected'));
    }
    public function song()
    {
        $breadcrumb = array(
            'Home'      =>  route('home.index'),
            'Search'    =>  route('search-all'),
            'Song'     =>  null
        );
        $selected = array(
            'Songs'     =>  'song'
        );
        return view('search/index',compact('breadcrumb','selected'));
    }
    public function person()
    {
        $breadcrumb = array(
            'Home'      =>  route('home.index'),
            'Search'    =>  route('search-all'),
            'Person'     =>  null
        );
        $selected = array(
            'Person'     =>  'person'
        );
        return view('search/index',compact('breadcrumb','selected'));
    }
    public function search()
    {
    
    }
}
