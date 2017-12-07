<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function ArrayParameters($param1 = "param1", $param2 = "param2")
    {
        return "param1: $param1<br>param2: $param2";
    }
    
    public function search($search_terms,$search)
    {
        return view('search/results',compact('search_terms','search'));
    }
}
