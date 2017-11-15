<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendMailRequest extends FormRequest {
    public function authorize() {
        return Auth::check();
    }
    
    public function rules() {
        return [
            'message'       =>   'required|string|min:15|max:10000'
        ];
    }
    
    public function getMessage() {
        return $this->input('message');
    }
}