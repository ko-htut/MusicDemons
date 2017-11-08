<?php

namespace App\Http\Requests\Autocomplete;

use App\Entities\Artist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArtistSearchRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'name'    => 'nullable|string|min:1|max:255'
        ];
    }
    
    public function getName() {
        return $this->input('name');
    }
}