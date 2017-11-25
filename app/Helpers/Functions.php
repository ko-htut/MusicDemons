<?php

namespace App;

class Helpers {
    public static function select2_selected($items) {
        $items_string = json_encode($items, JSON_UNESCAPED_UNICODE);
        
        // first escape backslashes
        $items_string = str_replace("\\", "\\\\", $items_string);
        
        // next escape single quotes
        $items_string = str_replace("'",  "\\'",  $items_string);
        
        // last, replace the problematic double-qoutes by single-quotes
        $items_string = str_replace("\"", "'", $items_string);
        
        return $items_string;
    }
}

?>