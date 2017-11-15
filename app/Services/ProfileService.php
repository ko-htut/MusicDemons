<?php

namespace App\Services;

use Auth;

class ProfileService {
    public function update(\stdClass $userData) {
        Auth::user()->name = $userData->name;
        if($userData->password !== null) {
            Auth::user()->password = $userData->password;
        }
        
        Auth::user()->save();
        return true;
    }
}