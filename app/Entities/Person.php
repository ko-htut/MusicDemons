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
    
    public function artist() {
        return $this->belongsToMany('App\Entities\Artist');
    }
}
