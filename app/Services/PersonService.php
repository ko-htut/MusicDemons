<?php

namespace App\Services;

use Auth;
use App\Entities\Person;
use App\Entities\Medium;
use App\Entities\MediumType;

class PersonService {
    public function create(\stdClass $personData) {
        $person = new Person();
        
        $person->first_name = $personData->first_name;
        $person->last_name = $personData->last_name;
        $person->born = $personData->born;
        $person->died = $personData->died;
        $person->birth_place = $personData->birth_place;
        
        $person->user_insert = Auth::user()->id;
        $person->save();
        
        $person->subject()->create();
        
        foreach($personData->media as $mediumData){
            $type = MediumType::find($mediumData->medium_type_id);
            $medium = new Medium();
            $medium->value = $mediumData->medium_value;
            $medium->medium_type()->associate($type);
            $medium->subject()->associate($person->subject);
            $medium->save();
        }
        
        return $person;
    }
    
    public function update(Person $person, \stdClass $personData) {
        $person->first_name = $personData->first_name;
        $person->last_name = $personData->last_name;
        $person->born = $personData->born;
        $person->died = $personData->died;
        $person->birth_place = $personData->birth_place;
        
        $person->user_update = Auth::user()->id;
        $person->save();
        
        // Delete old entities
        Medium::where('subject_id',$person->subject->id)->delete();
        
        foreach($personData->media as $mediumData){
            $type = MediumType::find($mediumData->medium_type_id);
            $medium = new Medium();
            $medium->value = $mediumData->medium_value;
            $medium->medium_type()->associate($type);
            $medium->subject()->associate($person->subject);
            $medium->save();
        }
        
        return $person;
    }
    
    public function destroy(Person $person) {
        $person->user_delete = Auth::user()->id;
        $person->save();
    
        $person->delete();
        return true;
    }
}