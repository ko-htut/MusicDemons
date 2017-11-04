<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Artist;
use App\Entities\Person;
use App\Http\Controllers\Controller;

class AutocompleteController extends Controller
{
    public function select2artist($search)
    {
        $query = Artist::select('id','name');
        if($search != null){
            $query = $query->where('name','like', "%$search%");
        }
        $data = $query->get();
        foreach($data as $item){
            $item->text = $item->name;
            unset($item->name);
        }
        return response()->json($data);
    }
    public function select2person($search)
    {
        $query = Person::select('id','first_name','last_name');
        if($search != null){
            $query = $query->where('first_name','like', "%$search%");
        }
        $data = $query->get();
        foreach($data as $item){
            $item->text = $item->first_name . " " . $item->last_name;
            unset($item->first_name);
            unset($item->last_name);
        }
        return response()->json($data);
    }
    
    public function opensearch($subject, $search)
    {
        $query = Artist::select('name')->where('name','like',"%$search%")->get()->pluck('name');
        $response = [
            $search,
            $query
        ];
        return response()->json($response);
    }
}
