<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AngularComponentController extends Controller
{
    public function autocomplete() {
        return view('angularcomponents.autocomplete');
    }
}
