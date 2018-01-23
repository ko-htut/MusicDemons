<?php

namespace App\Http\Requests\Test;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestRequest extends Request {
    public function authorize() {
        return false;
    }
    
    /*protected function failedAuthorization() {
        return redirect()->guest('login');
    }*/
    
    public function rules() {
        return [
        ];
    }
}