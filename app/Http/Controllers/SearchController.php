<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($subject = "",$search = "")
    {
        if($subject === "") {
            $selected = array(
                'Artists'   =>  'artist',
                'Albums'    =>  'album',
                'Songs'     =>  'song',
                'People'    =>  'people'
            );
            $breadcrumb = array(
                'Home'               =>  route('home.index'),
                'Search'             =>  null
            );
        } else {
            $selected = array(
                ucfirst($subject)    =>  $subject
            );
            $breadcrumb = array(
                'Home'               =>  route('home.index'),
                'Search'             =>  route('search.index'),
                ucfirst($subject)    =>  null
            );
        }
        return view('search/index',compact('breadcrumb','selected'));
    }
    
    public function search($subject,$search)
    {
        return view('search/results',compact('subject','search'));
    }
}