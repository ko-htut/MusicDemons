<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Search\SearchRequest;
use App\Helpers\Functions;
use App\Entities\Artist;
use App\Entities\Person;
use App\Entities\Song;

class SearchController extends Controller
{
    public function index($subject = "all",$search_term = "")
    {
        // Selected CheckButtons
        if($subject === "all") {
            $selected = array(
                'Artists'   =>  'artist',
                'Albums'    =>  'album',
                'Songs'     =>  'song',
                'People'    =>  'people'
            );
        } else {
            $selected = array();
            foreach(explode('-',$subject) as $item) {
                $selected[ucfirst($item)] = $item;
            }
        }
        
        // Breadcrumb
        if(Functions::string_empty($search_term)) {
            $breadcrumb = array(
                'Home'               =>  route('home.index'),
                'Search'             =>  null
            );
        } else {
            $breadcrumb = array(
                'Home'               =>  route('home.index'),
                'Search'             =>  route('search.index'),
                $search_term         =>  null
            );
            
            // search items
            $subj = explode('-',$subject);
            if(($subject === 'all') | (in_array('artists', $subj))) {
                $artists = Artist::where('name','like',"%$search_term%")->get();
            }
            if(($subject === 'all') | (in_array('songs', $subj))) {
                $songs = Song::where('title','like',"%$search_term%")->get();
            }
            if(($subject === 'all') | (in_array('people', $subj))) {
                $people = Person::all()
                                ->filter(function($person) use ($search_term) {
                                    return str_contains(strtolower($person->full_name),strtolower($search_term));
                                });
            }
        }
        
        return view('search/index',compact('breadcrumb','selected','search_term','artists','songs','people'));
    }
    
    public function redirect_params(SearchRequest $request) {
        return redirect()->route('search.index', [
            'subject' => $request->getSubjectsAsString(),
            'search_term' => $request->getSearchTerm(),
        ]);
    }
    
    public function opensearch_description() {
        //$search = route('search.index',['search_term'=>'%search_term%','subject'=>'%subject%']);
        //$search = str_replace(['%search_term%','%subject%'],['{searchTerms}','all'],$search);
        
        $search = route('opensearch-redirect',['search_terms' => '%search_terms%']);
        $search = str_replace(['%search_terms%'],['{searchTerms}'],$search);
        
        $suggest = route('autocomplete-opensearch',['search'=>'%search_terms%','subject'=>'%subject%']);
        $suggest = str_replace(['%search_terms%','%subject%'],['{searchTerms}','all'],$suggest);
        
        return view('search.opensearchdescription',compact('search','suggest'));
    }
    
    public function redirect_opensearch_action($search_terms) {
        // find the subjects where the name equals the search terms
        
        $artists = Artist::where('name','=',"$search_terms")->get();
        $songs = Song::where('title','=',"$search_terms")->get();
        $people = collect(Person::all()
                      ->filter(function($person) use ($search_terms) {
                          return strtolower($person->full_name) === strtolower($search_terms);
                      }));
              
        if($artists->count() + $people->count() + $songs->count() === 1) {
            if($artists->count() === 1) {
                return redirect()->route('artist.show',$artists->first());
            } else if($people->count() === 1) {
                return redirect()->route('person.show',$people->first());
            } else if($songs->count() === 1) {
                return redirect()->route('song.show',$songs->first());
            }
        } else {
            return redirect()->route('search.index',[
                'subject'      =>  'all',
                'search_term'  =>  $search_terms,
            ]);
        }
    }
}