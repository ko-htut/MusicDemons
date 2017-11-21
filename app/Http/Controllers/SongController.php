<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Entities\Song;
use App\Entities\Artist;
use App\Entities\MediumType;
use App\Entities\Medium;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Services\SongService;
use App\Http\Requests\Song\SongCreateRequest;
use App\Http\Requests\Song\SongUpdateRequest;

class SongController extends Controller
{
    private $songService;
    public function __construct(SongService $songService){
        $this->songService = $songService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($count = 20, $page = 1)
    {
        $breadcrumb = array(
            'Home'  =>  route('home.index'),
            'Songs' =>  null
        );
        $total = Song::count();
        $songs = Song::orderby('title')
                     ->skip(($page - 1) * $count)
                     ->take($count)
                     ->get();
        $routeName = 'song.page';
        return view('song/list',compact('breadcrumb','songs','count','page','total','routeName'));
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
                'Home'  =>  route('home.index'),
                'Songs' =>  route('song.index'),
                'Add new song' => null
            );
            $medium_types = MediumType::all();
            return view('song/create',compact('breadcrumb','medium_types'));
        } else {
            // first login to view this page
            return redirect()->guest('login');
        }
    }
    
    /**
     * Show the form for creating a new resource
     * with an artist already selected.
     *
     * @return \Illuminate\Http\Response
     */
    public function createwithartist(Artist $artist)
    {
        $breadcrumb = array(
            'Home'  =>  route('home.index'),
            'Songs' =>  route('song.index'),
            'Add new song' => null
        );
        $medium_types = MediumType::all();
        $selected_artists = array((object)(
            collect($artist->toArray())
                ->only(['id','name','year_started','year_quit'])
                ->all()
        ));
        foreach($selected_artists as $artist){
            $artist->text = $artist->name;
        }
        
        $selected_artists_string = Helpers::select2_selected($selected_artists);
        return view('song/create',compact('breadcrumb','selected_artists_string','medium_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongCreateRequest $request)
    {
        $song = $this->songService->create($request->getSong());
        return redirect()->route('song.show',[
            'song' => $song->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        $breadcrumb = array(
            'Home'        =>  route('home.index'),
            'Songs'       =>  route('song.index'),
             $song->title  =>  null
        );
        $youtube_url = null;
        $youtube_type = MediumType::where('description','Youtube')->first();
        if($youtube_type !== null) {
            $youtube_video = Medium::where('medium_type_id',$youtube_type->id)->where('subject_id',$song->subject->id)->first();
            if($youtube_video !== null) {
                $youtube_url = last(explode('=', $youtube_video->value));
            }
        }
        return view('song/show',compact('song','breadcrumb','youtube_url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Song $song)
     {
         $breadcrumb = array(
            'Home'        =>  route('home.index'),
            'Songs'       =>  route('song.index'),
             $song->title  =>  route('song.show',$song),
            'Edit'        =>  null
         );
         $medium_types = MediumType::all();
         $selected_artists = $song->artists->map(function($artist){
             return (object)(
                 collect($artist->toArray())
                     ->only(['id','name','year_started','year_quit'])
                     ->all()
             );
         });
         foreach($selected_artists as $artist){
             $artist->text = $artist->name;
         }
         //convert object to proper select2-string
         $selected_artists_string = Helpers::select2_selected($selected_artists);
         return view('song/edit',compact('song','breadcrumb','selected_artists_string','medium_types'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SongUpdateRequest $request, Song $song)
    {
        $this->songService->update($song,$request->getSong());
        return redirect()->route('song.show',compact('song'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $this->songService->destroy($song);
        return redirect()->route('song.index');
    }
}