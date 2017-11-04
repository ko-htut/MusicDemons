<?php

namespace App\Services;

use Auth;
use App\Entities\Artist;

class ArtistService {
    public function create(\stdClass $artistData) {
        $artist = new Artist();
        
        $artist->name = $artistData->name;
        $artist->year_started = $artistData->year_started;
        $artist->year_quit = $artistData->year_quit;
        
        $artist->user_insert = Auth::user()->id;
        $artist->save();
        
        $artist->members()->attach($artistData->members);
        
        return $artist;
    }
    
    public function update(Artist $artist, \stdClass $artistData) {
        $artist->name = $artistData->name;
        $artist->year_started = $artistData->year_started;
        $artist->year_quit = $artistData->year_quit;
        
        $artist->user_update = Auth::user()->id;
        $artist->save();
        
        $artist->members()->syncWithoutDetaching($artistData->members);
        
        return $artist;
    }
    
    public function destroy(Artist $artist) {
        $artist->user_delete = Auth::user()->id;
        $artist->save();
    
        $artist->delete();
        return true;
    }
}