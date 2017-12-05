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
            'lyrics'   => 'nullable|string|min:10|max:65536',
            'medium_types.*'   => 'required|integer',
            'medium_values.*'  => 'required|string'
        ];
    }
    
    public function getSong() {
        return (object) [
            'title'    => $this->input('title'),
            'released' => $this->input('released'),
            'artists'  => $this->input('artists'),
            'lyrics'   => $this->input('lyrics'),
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