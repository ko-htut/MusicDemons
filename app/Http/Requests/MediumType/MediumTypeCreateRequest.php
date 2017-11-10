<?php

namespace App\Http\Requests\MediumType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MediumTypeCreateRequest extends FormRequest {
    public function authorize() {
        return Auth::check();
    }
    
    public function rules() {
        return [
            'description'    => 'required|string|min:1|max:255',
            'base_url'       => 'required|string|min:1|max:255'
        ];
    }
    
    public function getMediumType() {
        return (object) [
            'description'    => $this->input('description'),
            'base_url'       => $this->input('base_url')
        ];
    }
}