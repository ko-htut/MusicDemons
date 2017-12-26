<?php

namespace App\Http\Controllers\Api\v1;

use Auth;
use Collective\Html;
use App\User;
use Illuminate\Http\Request;
use App\Entities\Subject;
use App\Services\SubjectService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Like\SubjectLikeRequest;

class SubjectController extends Controller
{
    private $subjectService;
    public function __construct(SubjectService $subjectService){
        $this->subjectService = $subjectService;
    }

    public function like(Subject $subject, SubjectLikeRequest $request) {
        $this->subjectService->like($subject, $request->getLike());
        return "1";
        /*switch($subject->subjectable_type) {
            case 'App\\Entities\\Song':
                return redirect()->route('song.show',$subject->subjectable);
                break;
            case 'App\\Entities\\Artist':
                return redirect()->route('artist.show',$subject->subjectable);
                break;
            case 'App\\Entities\\Person':
                return redirect()->route('person.show',$subject->subjectable);
                break;
        }*/
    }
}
