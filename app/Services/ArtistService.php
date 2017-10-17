<?php

namespace App\Services;

use App\Entities\Artist;

class ArtistService {
    public function create(\stdClass $artistData) {
        $artist = new Artist();
        
        $artist->name = $artistData->name;
        $artist->year_started = $artistData->year_started;
        $artist->year_quit = $artistData->year_quit;
        
        $artist->save();
        return $artist;
    }
    
    public function update(Artist $artist, \stdClass $artistData) {
        $artist->name = $artistData->name;
        $artist->year_started = $artistData->year_started;
        $artist->year_quit = $artistData->year_quit;
        
        $artist->save();
        return $artist;
    }
    
    public function destroy(Artist $artist) {
        $artist->delete();
        return true;
    }
}