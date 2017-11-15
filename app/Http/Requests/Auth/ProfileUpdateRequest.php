<?php

namespace App\Http\Requests\Auth;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'password' => 'string|min:6|confirmed|nullable',
        ];
    }
    
    public function getUser() {
        return (object) [
            'name'     => $this->input('name'),
            'password' => $this->input('password') === null ? null : bcrypt($this->input('password'))
        ];
    }
}