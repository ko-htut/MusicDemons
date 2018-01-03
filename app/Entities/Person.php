<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Person extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'nickname',
        'birth_place'
    ];
    
    protected $casts = [
        'born'  =>  'date',
        'died'  =>  'date'
    ];
    
    protected $filters = [
        'full_name'
    ];
    
    protected $appends = [
        'text'
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    // don't include time in json-string
    //protected $dateFormat = "m/d/Y";
    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('m/d/Y');
    }
    
    public function artist() {
        return $this->belongsToMany('App\Entities\Artist')->withPivot('active');
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
    
    public function getTextAttribute() {
        return $this->first_name . " " . $this->last_name;
    }
}
