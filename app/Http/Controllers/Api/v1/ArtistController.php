<?php

namespace App\Http\Controllers\Api\v1;

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
    public function __construct(ArtistService $artistService) {
        $this->artistService = $artistService;
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $artists = Artist::with(array('members','songs'))->get();
        return response()->json($artists);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ArtistCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistCreateRequest $request) {
        $artist = $this->artistService->create($request->getArtist());
        return response()->json($artist);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  App\Entities\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist) {
        return response()->json($artist);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ArtistUpdateRequest  $request
     * @param  App\Entities\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistUpdateRequest $request, Artist $artist) {
        $this->artistService->update($artist,$request->getArtist());
        return response()->json($artist);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Entities\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist) {
        $this->artistService->destroy($artist);
        return response()->json(array());
    }
}
