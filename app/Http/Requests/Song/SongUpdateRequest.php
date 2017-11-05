<?php

namespace App\Http\Requests\Song;

use App\Entities\Song;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SongUpdateRequest extends FormRequest {
    public function authorize() {
        return Auth::check();
    }
    
    public function rules() {
        return [
            'title'    => 'required|string|min:1|max:255',
            'released' => 'nullable|date',
            'artists'  => 'nullable',
            'lyrics'   => 'nullable|string|min:10|max:65536'
        ];
    }
    
    public function getSong() {
        return (object) [
            'title'    => $this->input('title'),
            'released' => $this->input('released'),
            'artists'  => $this->input('artists'),
            'lyrics'   => $this->input('lyrics')
        ];
    }
}