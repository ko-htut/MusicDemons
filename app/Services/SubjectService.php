<?php

namespace App\Services;

use Auth;
use App\User;
use App\Entities\Subject;
use Illuminate\Support\Facades\DB;

class SubjectService {
    public function like(Subject $subject, bool $like) {
        $data_to_sync = array();
        $data_to_sync[Auth::user()->id] = ['like' => $like];
        $subject->like_users()->syncWithoutDetaching($data_to_sync);
        
        return $subject;
    }
}