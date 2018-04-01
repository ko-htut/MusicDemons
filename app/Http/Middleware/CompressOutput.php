<?php

namespace App\Http\Middleware;

use Closure;

class CompressOutput {
    
    public function handle($request, Closure $next) {
        $response = $next($request);
        $response_content = $response->getContent();
        
        $replace = array(
            '/<!--[^\[](.*?)[^\]]-->/s' => '',
            "/>\\s*</"                  => '><',
            "/\\t/"                        => '',
            //"/\\s*\n+\\s*/"             => ' ',
            //"(\/\*[\w\'\s\r\n\*]*\*\/)|(\/\/[\w\s\']*)|(\<![\-\-\s\w\>\/]*\>)" => '',
            //"/(\/\/.*\n*)/"               => '',
        );
        $response_content = preg_replace(array_keys($replace), array_values($replace), $response_content);
        
/*        $replace_rev = array(
//            "/(?<=(\\<script[^\\>]\\>))(.*)(?=\\<\\/script\\>)/"                        => '',
//            "/(?<=(\\>tpircs\\/\\<))(.*)(?=\\>.*tpircs\\<)/"                        => '',
              "/(?<=(\\>tpircs\\/\\<))(.*(\\n).*)(?=(\\>.*tpircs\\<))/Us"      => '',
              "/(?<=\\>tpircs\\/\\<)(.*(\\n).*)(?=(\\>.*tpircs\\<))/"  =>  '',
        );
        $response_content = strrev(preg_replace(array_keys($replace_rev), array_values($replace_rev), strrev($response_content)));*/

        
        $response->setContent($response_content);
        return $response;
    }
    
}