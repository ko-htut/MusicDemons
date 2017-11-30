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
    
    public static function get_icon($url) {
        // this can be better
    
        $doc = new \DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->strictErrorChecking = false;
        $doc->recover = true;
        
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile("https://" . $url);
        libxml_clear_errors();
        $xpath = new \DOMXPath($doc);
        
        $elements = $xpath->query("//link[@rel='shortcut icon']/@href");
        if($elements->length === 0) {
            $elements = $xpath->query("//link[@rel='fluid-icon']/@href");
        }
        if($elements->length === 0) {
            $elements = $xpath->query("//link[@rel='icon']/@href");
        }
        
        $image = $elements->item(0)->value;
        if(strpos($image,"//") === false){
            $image = ltrim($image,"/");
            $image = "https://" . $url . "/" . $image;
        }
        return $image;
    }
}

?>