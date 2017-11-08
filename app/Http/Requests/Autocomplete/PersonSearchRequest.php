<?php

namespace App\Http\Requests\Autocomplete;

use App\Entities\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PersonSearchRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'first_name'    => 'nullable|string|min:1|max:255',
            'last_name'    => 'nullable|string|min:1|max:255'
        ];
    }
    
    public function getNames() {
        return (object) [
            'first_name' => $this->input('first_name'),
            'last_name'  => $this->input('last_name')
        ];
    }
}