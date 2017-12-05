<?php

namespace App\Helpers;

class SubjectHelper {
    public static function get_old_media() {
        $old_media = array();
        if((old('medium_types') !== null) && (old('medium_values') !== null)) {
            for($i = 0; $i < count(old('medium_types')); $i++) {
                $old_media[$i] = (object)[
                    'medium_type_id' => intval(old('medium_types')[$i]),
                    'value'          => old('medium_values')[$i]
                ];
            }
        }
        
        return $old_media;
    }
}