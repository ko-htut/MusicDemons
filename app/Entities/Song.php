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
    
    public function artists() {
        return $this->belongsToMany('App\Entities\Artist');
    }
}