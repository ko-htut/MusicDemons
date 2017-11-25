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
        
        return $artist;
    }
    
    public function update(Artist $artist, \stdClass $artistData) {
        $artist->name = $artistData->name;
        $artist->year_started = $artistData->year_started;
        $artist->year_quit = $artistData->year_quit;
        $artist->user_update = Auth::user()->id;
        $artist->save();
        
        // One would expect this to work (sync m2m, for members set active=TRUE, for past_members set active=FALSE)
        // first detach existing pivots which are not in the members-list, and attach (if necessary) the remaining members. set all "actives" to TRUE
        $artist->members()->sync($artistData->members, array('active' => TRUE));
        // keep the above set pivots, and attach (if necessary) the past_members, setting all "actives" to FALSE
        $artist->members()->syncWithoutDetaching($artistData->past_members, array('active' => FALSE));
        
        // This on the other hand works, but you'd have to add multiple conditions to make it work without getting bugs
        // Which would be extremely annoying
        //$merged_members = array_merge($artistData->members, $artistData->past_members);
        //$actives = array_merge(
        //    array_fill(0, count($artistData->members), ['active' => true]),
        //    array_fill(0, count($artistData->past_members), ['active' => false])
        //);
        //$syncData = array_combine($merged_members,$actives);
        //$artist->members()->sync($syncData);
        
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
        
        return $artist;
    }
    
    public function destroy(Artist $artist) {
        $artist->user_delete = Auth::user()->id;
        $artist->save();
    
        $artist->delete();
        return true;
    }
}