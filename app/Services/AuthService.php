<?php

namespace App\Services;

use App\User;

class AuthService {
    public function register(\stdClass $credentials) {
        $user = new User();
        
        $user->name = $credentials->name;
        $user->email = $credentials->email;
        $user->password = $credentials->password;
        
        $user->save();
        
        return $user;
    }
}