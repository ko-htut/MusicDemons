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
    
    public function song() {
        return $this->belongsTo('App\Entities\Song');
    }
}
