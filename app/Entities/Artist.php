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
    
    public function members() {
        return $this->belongsToMany('App\Entities\Person');
    }
}
