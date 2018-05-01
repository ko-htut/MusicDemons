<?php

namespace App\Http\Controllers;

use Auth;
use Collective\Html;
use App\User;
use App\Entities\Artist;
use App\Entities\MediumType;
use App\Helpers\Functions;
use App\Helpers\SubjectHelper;
use App\Http\Controllers\Controller;
use App\Services\ArtistService;
use App\Http\Requests\Artist\ArtistCreateRequest;
use App\Http\Requests\Artist\ArtistUpdateRequest;

class ArtistController extends Controller
{
    private $artistService;
    public function __construct(ArtistService $artistService){
        $this->artistService = $artistService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($count = 10, $page = 1)
    {
				$breadcrumb = array(
						'Home'      =>  route('home.index'),
						'Artists'   =>  null
				);
        return view('artist/list',compact('breadcrumb','count','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $breadcrumb = array(
                'Home'    =>  route('home.index'),
                'Artists' =>  route('artist.index'),
                'Add new artist'  => null
            );
            $medium_types = MediumType::all();
            
            // retrieve the old media values
            $old_media = SubjectHelper::get_old_media();
            
            return view('artist/create',compact('breadcrumb','medium_types','old_media'));
        } else {
            // first login to view this page
            return redirect()->guest('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ArtistCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistCreateRequest $request)
    {
        $artist = $this->artistService->create($request->getArtist());
        $request->session()->flash('add_another','Add another artist');
        return redirect()->route('artist.show_name',array($artist,$artist->name));
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Entities\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist) {
        return redirect()->route('artist.show_name',array($artist, str_slug($artist->name)), 301);
    }
    
    public function show_name(Artist $artist, String $name) {
        $breadcrumb = array(
            'Home'         =>  route('home.index'),
            'Artists'      =>  route('artist.index'),
             $artist->name =>  null
        );
        $add_another = session('add_another');
        return view('artist/show',compact('artist','breadcrumb','add_another'));
    }
    
    public function edit(Artist $artist) {
        return redirect()->route('artist.edit_name',array($artist, str_slug($artist->name)), 301);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Entities\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function edit_name(Artist $artist, String $name)
    {
        $breadcrumb = array(
            'Home'         =>  route('home.index'),
            'Artists'      =>  route('artist.index'),
             $artist->name =>  route('artist.show',$artist),
            'Edit'         =>  null
        );
        $active_members = $artist->members()
            ->wherePivot('active','=',TRUE)
            ->get()
            ->map(function($member){
                return (object)(
                    collect($member->toArray())
                        ->only(['id','first_name','last_name','born','died','birth_place','text'])
                        ->all()
                );
            });
        $past_members = $artist->members()
            ->wherePivot('active','=',FALSE)
            ->get()
            ->map(function($member){
                return (object)(
                    collect($member->toArray())
                        ->only(['id','first_name','last_name','born','died','birth_place','text'])
                        ->all()
                );
            });
        
        $medium_types = MediumType::all();
        $old_media = SubjectHelper::get_old_media();
        
        return view('artist/edit', compact('artist','breadcrumb','active_members','past_members','medium_types','old_media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ArtistUpdateRequest  $request
     * @param  App\Entities\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistUpdateRequest $request, Artist $artist)
    {
        $this->artistService->update($artist,$request->getArtist());
        return redirect()->route('artist.show',compact('artist'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Entities\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $this->artistService->destroy($artist);
        return redirect()->route('artist.index');
    }
}
