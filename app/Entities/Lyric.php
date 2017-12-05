<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lyric extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'lyrics'
    ];
    
    protected $casts = [
        'timing'  =>  'array'
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function song() {
        return $this->belongsTo('App\Entities\Song');
    }
}
