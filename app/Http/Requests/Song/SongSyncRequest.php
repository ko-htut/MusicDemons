<?php

namespace App\Http\Requests\Song;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SongSyncRequest extends FormRequest {
    public function authorize() {
        return Auth::check();
    }
    
    public function rules() {
        return [
            'times'  =>  'required|array'
        ];
    }
    
    public function getSynchronization() {
        return (object) [
            'timing'    =>    $this->input('times')
        ];
    }
}