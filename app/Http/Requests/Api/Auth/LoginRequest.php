<?php

namespace App\Http\Requests\Api\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ];
    }
    
    public function getCredentials() {
        return (object) [
            'email'    =>    $this->input('email'),
            'password' =>    bcrypt($this->input('password'))
        ];
    }
}