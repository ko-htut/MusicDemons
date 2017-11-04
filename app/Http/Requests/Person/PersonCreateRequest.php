<?php

namespace App\Http\Requests\Person;

use App\Entities\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PersonCreateRequest extends FormRequest {
    public function authorize() {
        return Auth::check();
    }
    
    public function rules() {
        return [
            'first_name'    => 'required|string|min:1|max:255',
            'last_name'     => 'required|string|min:1|max:255',
            'born'          => 'nullable|date',
            'died'          => 'nullable|date',
            'birth_place'   => 'nullable|string|min:1|max:255'
        ];
    }
    
    public function getPerson() {
        return (object) [
            'first_name'    => $this->input('first_name'),
            'last_name'     => $this->input('last_name'),
            'born'          => $this->input('born'),
            'died'          => $this->input('died'),
            'birth_place'   => $this->input('birth_place')
        ];
    }
}