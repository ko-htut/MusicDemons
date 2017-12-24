<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Entities\Subject;
use App\Services\SubjectService;
use App\Http\Requests\Like\SubjectLikeRequest;

class LikesController extends Controller
{
    private $subjectService;
    public function __construct(SubjectService $subjectService){
        $this->subjectService = $subjectService;
    }

    public function like(Subject $subject, SubjectLikeRequest $request) {
        $this->subjectService->like($subject, $request->getLike());
        switch($subject->subjectable_type) {
            case 'App\\Entities\\Song':
                return redirect()->route('song.show',$subject->subjectable);
                break;
            case 'App\\Entities\\Artist':
                return redirect()->route('artist.show',$subject->subjectable);
                break;
            case 'App\\Entities\\Person':
                return redirect()->route('person.show',$subject->subjectable);
                break;
        }
    }
}
