<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Test\TestRequest;
use App\Entities\Addresses\Place;

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
    
    public function authorized_test(TestRequest $request) {
        return "success";
    }
    
    public function structure_test(Place $place) {
        $result  = "";
        $result .= $place->name;
        $result .= "<br>$place->placeable->text";
        return $result;
    }
}
