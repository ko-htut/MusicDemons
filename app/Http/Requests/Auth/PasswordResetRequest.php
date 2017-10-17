<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
        ];
    }
    
    public function getToken() {
        return $this->input('token');
    }
    
    public function getEmail() {
        return $this->input('email');
    }
}