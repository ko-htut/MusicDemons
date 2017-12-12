<?php

namespace App\Services;

use Auth;
use App\Entities\MediumType;
use App\Helpers\Functions;

class MediumTypeService {
    public function create(\stdClass $mediumTypeData) {
        $mediumType = new MediumType();
        
        $mediumType->description  = $mediumTypeData->description;
        $mediumType->base_url = $mediumTypeData->base_url;
        if(strpos($mediumTypeData->base_url, ".") !== false) {
            $mediumType->icon_url = Functions::get_icon($mediumTypeData->base_url);
        }
        
        $mediumType->user_insert = Auth::user()->id;
        $mediumType->save();
        
        return $mediumType;
    }
    
    public function update(MediumType $mediumType, \stdClass $mediumTypeData) {
        $mediumType->description  = $mediumTypeData->description;
        $mediumType->base_url = $mediumTypeData->base_url;
        if(strpos($mediumTypeData->base_url, ".") !== false) {
            $mediumType->icon_url = Functions::get_icon($mediumTypeData->base_url);
        }
        
        $mediumType->user_update = Auth::user()->id;
        $mediumType->save();
        
        return $mediumType;
    }
    
    public function destroy(MediumType $mediumType) {
        $mediumType->user_delete = Auth::user()->id;
        $mediumType->save();
    
        $mediumType->delete();
        return true;
    }
}