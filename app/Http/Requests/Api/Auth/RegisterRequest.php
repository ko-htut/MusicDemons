<?php

namespace App\Http\Requests\Api\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    
    public function getCredentials() {
        return (object) [
            'name'     =>    $this->input('name'),
            'email'    =>    $this->input('email'),
            'password' =>    bcrypt($this->input('password'))
        ];
    }
}