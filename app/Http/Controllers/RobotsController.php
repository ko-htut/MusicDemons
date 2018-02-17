<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Entities\Person;
use App\Entities\MediumType;
use App\Helpers\Functions;
use App\Helpers\SubjectHelper;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Http\Requests\Person\PersonCreateRequest;
use App\Http\Requests\Person\PersonUpdateRequest;

class RobotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function robots()
    {
        $disallow_urls = [
            'people-datatables'  =>  route('api-v1-person.datatables',[],false),
            'artist-datatables'  =>  route('api-v1-artist.datatables',[],false),
            'song-datatables'    =>  route('api-v1-song.datatables',[],false),
            'subject-like'       =>  route('subject.like',['subject' => '*'],false),
        ];
        
        $resp = "User-agent: *";
        foreach($disallow_urls as $route => $url) {
            $resp .= "\nDisallow: $url";
        }
        
        $headers = [
            'Accept-Ranges'        =>  'bytes',
            'Content-Length'       =>  strlen($resp),
            'Content-type'         =>  'text/plain',
        ];
        return response()->make($resp, 200, $headers);
    }
}
