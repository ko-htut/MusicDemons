<?php

namespace App\Services;

use Auth;
use App\Entities\Person;

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
        return $person;
    }
    
    public function destroy(Person $person) {
        $person->user_delete = Auth::user()->id;
        $person->save();
    
        $person->delete();
        return true;
    }
}