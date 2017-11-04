<?php

namespace App\Http\Requests\Artist;

use App\Entities\Artist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArtistCreateRequest extends FormRequest {
    public function authorize() {
        return Auth::check();
    }
    
    public function rules() {
        return [
            'name'          => 'required|string|min:1|max:255',
            'year_started'  => 'required|integer|digits:4',
            'year_quit'     => 'nullable|integer|digits:4',
            'members'       => 'nullable'
        ];
    }
    
    public function getArtist() {
        return (object) [
            'name'        => $this->input('name'),
            'year_started'=> $this->input('year_started'),
            'year_quit'   => $this->input('year_quit'),
            'members'     => $this->input('members')
        ];
    }
    
    /*public function messages() {
        $parent_messages = parent::messages();
        $additional = array(
            'name.required'         =>  'You must enter an artist name',
            'year_started.required' =>  'You must enter a start year',
            'year_started.integer'  =>  'The start year must be an integer',
            'year_quit.integer'     =>  'The start year must be an integer');
        return array_merge($parent_messages, $additional);
    }*/
}