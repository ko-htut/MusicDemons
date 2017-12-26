<?php

namespace App\Http\Requests\Like;

use Auth;
use App\User;
use App\Entities\Subject;
use Illuminate\Foundation\Http\FormRequest;

class SubjectLikeRequest extends FormRequest {
    public function authorize() {
        return Auth::check();
    }
    
    public function rules() {
        return [
            'like'         => 'required|boolean'
        ];
    }
    
    public function getLike() {
        return (bool)$this->input('like');
    }
}