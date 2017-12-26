<?php

namespace App\Services;

use Auth;
use App\Entities\Subject;
use App\Entities\Artist;
use App\Entities\Medium;
use App\Entities\MediumType;

class ArtistService {
    public function create(\stdClass $artistData) {
        $artist = new Artist();
        
        $artist->name = $artistData->name;
        $artist->year_started = $artistData->year_started;
        $artist->year_quit = $artistData->year_quit;
        
        $artist->user_insert = Auth::user()->id;
        $artist->save();
        
        $artist->subject()->create();
        $artist->members()->attach($artistData->members, array('active' => TRUE));
        $artist->members()->attach($artistData->past_members, array('active' => FALSE));
        
        foreach($artistData->media as $mediumData){
            $type = MediumType::find($mediumData->medium_type_id);
            $medium = new Medium();
            $medium->value = $mediumData->medium_value;
            $medium->medium_type()->associate($type);
            $medium->subject()->associate($artist->subject);
            $medium->save();
        }
        
        if($artistData->picture !== null) {
            $artistData->picture->move('images', $artist->subject->id);
        }
        
        return $artist;
    }
    
    public function update(Artist $artist, \stdClass $artistData) {
        $artist->name = $artistData->name;
        $artist->year_started = $artistData->year_started;
        $artist->year_quit = $artistData->year_quit;
        $artist->user_update = Auth::user()->id;
        $artist->save();
        
        // set members to active or not
        $data_to_sync = array();
        foreach($artistData->members as $member){
            $pivot_data = ['active' => TRUE];
            $data_to_sync[$member] = $pivot_data;
        }
        foreach($artistData->past_members as $member){
            $pivot_data = ['active' => FALSE];
            $data_to_sync[$member] = $pivot_data;
        }
        $artist->members()->sync($data_to_sync);
        
        // Delete old entities
        Medium::where('subject_id',$artist->subject->id)->delete();
        foreach($artistData->media as $mediumData){
            $type = MediumType::find($mediumData->medium_type_id);
            $medium = new Medium();
            $medium->value = $mediumData->medium_value;
            $medium->medium_type()->associate($type);
            $medium->subject()->associate($artist->subject);
            $medium->save();
        }
        
        if($artistData->picture !== null) {
            $artistData->picture->move('images', $artist->subject->id);
        }
        
        return $artist;
    }
    
    public function destroy(Artist $artist) {
        $artist->user_delete = Auth::user()->id;
        $artist->save();
    
        $artist->delete();
        return true;
    }
}