<?php

namespace App\Http\Controllers;

use App\Entities\Artist;
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
    public function index()
    {
				$breadcrumb = array(
						'Home'      =>  route('home.index'),
						'Artists'   =>  null
				);
        $artists = Artist::all();
        return view('artist/list',compact('breadcrumb','artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = array(
            'Home'    =>  route('home.index'),
            'Artists' =>  route('artist.index'),
            'Add new artist'  => null
        );
        return view('artist/create',compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistCreateRequest $request)
    {
        $artist = $this->artistService->create($request->getArtist());
        return redirect()->route('artist.show',[
            'artist' => $artist->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        $breadcrumb = array(
            'Home'         =>  route('home.index'),
            'Artists'      =>  route('artist.index'),
             $artist->name =>  null
        );
        return view('artist/show',compact('artist','breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        $breadcrumb = array(
            'Home'         =>  route('home.index'),
            'Artists'      =>  route('artist.index'),
             $artist->name =>  route('artist.show',$artist),
            'Edit'         =>  null
        );
        return view('artist/edit', compact('artist','breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $this->artistService->destroy($artist);
        return redirect()->route('artist.index');
    }
}
