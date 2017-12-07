<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title'
    ];
    
    protected $casts = [
        'released'  =>  'date'
    ];
    
    protected $appends = [
        'text'
    ];
    
    protected $with = [
        'latest_lyrics'
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function artists() {
        return $this->belongsToMany('App\Entities\Artist');
    }
    
    public function lyrics() {
        return $this->hasMany('App\Entities\Lyric');
    }
    
    public function latest_lyrics() {
        return $this->hasOne('App\Entities\Lyric')->latest();
    }
    
    public function subject() {
        return $this->morphOne('App\Entities\Subject', 'subjectable');
    }
    
    public function getTextAttribute() {
        return $this->title;
    }
}
