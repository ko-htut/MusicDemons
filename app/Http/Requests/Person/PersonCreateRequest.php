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
            'nickname'      => 'nullable|string',
            'born'          => 'nullable|date',
            'died'          => 'nullable|date',
            'birth_place'   => 'nullable|string|min:1|max:255',
            'medium_types.*'   => 'required|integer',
            'medium_values.*'  => 'required|string'
        ];
    }
    
    public function getPerson() {
        return (object) [
            'first_name'    => $this->input('first_name'),
            'last_name'     => $this->input('last_name'),
            'nickname'      => $this->input('nickname'),
            'born'          => $this->input('born'),
            'died'          => $this->input('died'),
            'birth_place'   => $this->input('birth_place'),
            'media'       => $this->getMedia()
        ];
    }
    
    public function getMedia() {
        $min = min(
            count($this->input('medium_types')),
            count($this->input('medium_values'))
        );
        $media = array();
        for($i = 0; $i < $min; $i++){
            $media[$i] = (object) [
                'medium_type_id'  =>  $this->input("medium_types")[$i],
                'medium_value'    =>  $this->input("medium_values")[$i]
            ];
        }
        return $media;
    }
}