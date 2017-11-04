<?php

namespace App\Http\Controllers;

use App\User;
use App\Entities\Song;
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
        $breadcrumb = array(
            'Home'  =>  route('home.index'),
            'Songs' =>  route('song.index'),
            'Add new song' => null
        );
        return view('song/create',compact('breadcrumb'));
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
        return view('song/show',compact('song','breadcrumb'));
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
         return view('song/edit',compact('song','breadcrumb','selected_artists'));
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