<?php

namespace App\Http\Controllers\Api\v1;

use Auth;
use App\User;
use App\Entities\Song;
use App\Entities\Artist;
use App\Entities\MediumType;
use App\Entities\Medium;
use App\Helpers\Functions;
use App\Helpers\SubjectHelper;
use App\Http\Controllers\Controller;
use App\Services\SongService;
use App\Http\Requests\Song\SongCreateRequest;
use App\Http\Requests\Song\SongUpdateRequest;
use App\Http\Requests\Song\SongSyncRequest;

class SongController extends Controller
{
    private $songService;
    public function __construct(SongService $songService){
        $this->songService = $songService;
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $songs = Song::all();
        return response()->json($songs);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\SongCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongCreateRequest $request) {
        $song = $this->songService->create($request->getSong());
        return response()->json($song);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  App\Entities\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song) {
        //$song = Song::with('latest_lyrics')->findOrFail($id);
        return response()->json($song);
        
        //return response()->json($song->with('lyrics')->get());
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\SongUpdateRequest  $request
     * @param  App\Entities\Song $song
     * @return \Illuminate\Http\Response
     */
    public function update(SongUpdateRequest $request, Song $song) {
        $this->songService->update($song,$request->getSong());
        return response()->json($song);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Entities\Song $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song) {
        $this->songService->destroy($song);
        return response()->json(array());
    }
}
