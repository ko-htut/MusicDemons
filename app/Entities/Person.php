<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_place'
    ];
    
    protected $casts = [
        'born'  =>  'date',
        'died'  =>  'date'
    ];
    
    protected $filters = [
        'full_name'
    ];
    
    public function artist() {
        return $this->belongsToMany('App\Entities\Artist');
    }
    
    public function getFullNameAttribute() {
        return $this->first_name . " " . $this->last_name;
    }
    
    public function filterFullNameAttribute() {
        return $this->first_name . " " . $this->last_name;
    }
    
    public function subject() {
        return $this->morphOne('App\Entities\Subject', 'subjectable');
    }
}
