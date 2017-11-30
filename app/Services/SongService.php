<?php

namespace App\Services;

use Auth;
use App\Entities\Song;
use App\Entities\Lyric;
use App\Entities\Medium;
use App\Entities\MediumType;

class SongService {
    public function create(\stdClass $songData) {
        $song = new Song();
        $song->title = $songData->title;
        $song->released = $songData->released;
        $song->user_insert = Auth::user()->id;
        $song->save();
        
        if($songData->lyrics !== null) {
            $lyric = new Lyric();
            $lyric->lyrics = $songData->lyrics;
            $lyric->timing = "";
            $lyric->user_insert = Auth::user()->id;
            $lyric->song()->associate($song);
            $lyric->save();
        }
        
        $song->artists()->attach($songData->artists);
        $song->subject()->create();
        
        foreach($songData->media as $mediumData){
            $type = MediumType::find($mediumData->medium_type_id);
            $medium = new Medium();
            $medium->value = $mediumData->medium_value;
            $medium->medium_type()->associate($type);
            $medium->subject()->associate($song->subject);
            $medium->save();
        }
        
        return $song;
    }
    
    public function update(Song $song, \stdClass $songData) {
        $song->title = $songData->title;
        $song->released = $songData->released;
        
        $song->user_update = Auth::user()->id;
        $song->save();
        
        $song->artists()->sync($songData->artists);
        
        $displayed_lyric = $song->lyrics->last();
        if(empty($displayed_lyric)) {
            $new_lyric = new Lyric();
            $new_lyric->lyrics = $songData->lyrics;
            $new_lyric->timing = "";
            $new_lyric->user_insert = Auth::user()->id;
            $new_lyric->song()->associate($song);
            $new_lyric->save();
        } else if($displayed_lyric->lyrics !== $songData->lyrics) {
            if($displayed_lyric->user_insert === Auth::user()->id) {
                $displayed_lyric->lyrics = $songData->lyrics;
                $displayed_lyric->save();
            } else {
                $new_lyric = new Lyric();
                $new_lyric->lyrics = $songData->lyrics;
                $new_lyric->timing = "";
                $new_lyric->user_insert = Auth::user()->id;
                $new_lyric->song()->associate($song);
                $new_lyric->save();
            }
        }
        
        // Delete old entities
        Medium::where('subject_id',$song->subject->id)->delete();
        foreach($songData->media as $mediumData){
            $type = MediumType::find($mediumData->medium_type_id);
            $medium = new Medium();
            $medium->value = $mediumData->medium_value;
            $medium->medium_type()->associate($type);
            $medium->subject()->associate($song->subject);
            $medium->save();
        }
        
        // will the new association be applied immediately?
        return $song;
    }
    
    public function destroy(Song $song) {
        $song->user_delete = Auth::user()->id;
        $song->save();
        
        $song->delete();
        return true;
    }
    
    public function sync(Lyric $lyric, \stdClass $synchronization) {
        $lyric->timing = $synchronization->timing;
        $lyric->save();
        return $lyric;
    }
}