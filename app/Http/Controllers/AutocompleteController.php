<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Artist;
use App\Entities\Person;
use App\Http\Controllers\Controller;
use App\Http\Requests\Autocomplete\PersonSearchRequest;
use App\Http\Requests\Autocomplete\ArtistSearchRequest;

class AutocompleteController extends Controller
{
    public function rawperson(PersonSearchRequest $request)
    {
        $name = $request->getNames();
        $query = Person::select('id','first_name','last_name')
                       ->where  ('nickname','like',$name->first_name . ' ' . $name->last_name)
                       ->orWhere('nickname','like',$name->last_name . ' ' . $name->first_name)
                       ->orWhere(function ($query) use ($name) {
                           $query->where('first_name','like',$name->first_name)
                                 ->where('last_name','like',$name->last_name);
                        });
        $data = $query->get();
        foreach($data as $item){
            $item->url = route('person.show', ['person' => $item ]);
        }
        
        return response()->json($data);
    }
    public function rawartist(ArtistSearchRequest $request)
    {
        $query = Artist::select('id','name')
                       ->where('name','like',$request->getName());
        $data = $query->get();
        foreach($data as $item){
            $item->url = route('artist.show', ['artist' => $item ]);
        }
        
        return response()->json($data);
    }

    public function select2artist($search)
    {
        if($search != null){
            $query = Artist::where('name','like', "%$search%");
            $data = $query->get();
            return response()->json($data);
        } else {
            $data = Artist::all();
            return response()->json($data);
        }
    }
    public function select2person($search)
    {
        $query = Person::select('id','first_name','last_name');
        if($search != null){
            $query->where(function($query) use ($search){
                $query->orWhereRaw('concat(first_name," ",last_name) like ?', array("%$search%"));
                $query->orWhereRaw('concat(last_name," ",first_name) like ?', array("%$search%"));
                $query->orWhereRaw('nickname like ?',array("%$search%"));
            });
        }
        $data = $query->get();
        foreach($data as $item){
            $item->text = $item->full_name;
        }
        return response()->json($data);
    }
    
    public function opensearch($subject,$search)
    {
        $query = Artist::select('name')->where('name','like',"%$search%")->get()->pluck('name');
        $response = [
            $search,
            $query
        ];
        return response()->json($response);
    }
}
