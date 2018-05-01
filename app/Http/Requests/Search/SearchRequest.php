<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SearchRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'search_terms'  => 'array',
            'search'        => 'nullable|string|min:1|max:255',
        ];
    }
    
    public function getSubjectsAsString() {
        if(empty($this->input('search_terms'))) {
            return 'artists-songs-albums-people';
        } else if(count($this->input('search_terms')) === 4) {
            return 'all';
        } else {
            return implode('-',$this->input('search_terms'));
        }
    }
    
    public function getSearchTerm() {
        if($this->has('search')) {
            return $this->input('search');
        } else {
            return '';
        }
    }
}