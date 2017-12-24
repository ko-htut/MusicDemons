<?php

namespace App\Http\Requests\Like;

use App\User;
use App\Entities\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        return (object) [
            'like'       => $this->input('like')
        ];
    }
}