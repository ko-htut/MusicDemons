<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $breadcrumb = array(
            'Home'      =>  null
        );
        return view('home', compact('breadcrumb'));
    }
}
