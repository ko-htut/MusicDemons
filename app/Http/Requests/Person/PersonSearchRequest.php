<?php

namespace App\Http\Requests\Person;

use App\Entities\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PersonSearchRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'filter_search'    =>  'nullable|string|min:1|max:255'
        ];
    }
    
    public function getSearchString() {
        if($this->has('filter_search')) {
            return $this->input('filter_search');
        } else {
            return "";
        }
    }
}