<?php

namespace App\Services;

use Auth;
use App\Entities\Song;

class SongService {
    public function create(\stdClass $songData) {
        $song = new Song();
        
        $song->title = $songData->title;
        $song->released = $songData->released;
        
        $song->user_insert = Auth::user()->id;
        $song->save();
        
        $song->artists()->attach($songData->artists);
        
        return $song;
    }
    
    public function update(Song $song, \stdClass $songData) {
        $song->title = $songData->title;
        $song->released = $songData->released;
        
        $song->user_update = Auth::user()->id;
        $song->save();
        
        $song->artists()->sync($songData->artists);
        
        return $song;
    }
    
    public function destroy(Song $song) {
        $song->user_delete = Auth::user()->id;
        $song->save();
        
        $song->delete();
        return true;
    }
}