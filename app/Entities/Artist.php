<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name'
    ];
    
    protected $casts = [
        'year_started' => 'integer',
        'year_quit' => 'integer'
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
    
    public function members() {
        return $this->belongsToMany('App\Entities\Person')->withPivot('active');
    }
    
    public function active_members() {
        return $this->belongsToMany('App\Entities\Person')->withPivot('active')->wherePivot('active',TRUE);
    }
    
    public function songs() {
        return $this->belongsToMany('App\Entities\Song');
    }
    
    public function subject() {
        return $this->morphOne('App\Entities\Subject', 'subjectable');
    }
    
    public function getTextAttribute() {
        return $this->name;
    }                
}
