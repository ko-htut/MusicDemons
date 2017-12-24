<?php

namespace App\Services;

use Auth;
use App\User;
use App\Entities\Subject;
use Illuminate\Support\Facades\DB;

class SubjectService {
    public function like(Subject $subject, \stdClass $likeData) {
        $data_to_sync = array();
        $data_to_sync[Auth::user()->id] = ['like' => $likeData->like];
        $subject->like_users()->sync($data_to_sync);
        
        return $subject;
    }
}