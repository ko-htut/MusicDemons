<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        /*'subjectable_id',
        'subjectable_type'*/
    ];
    
    public function subjectable() {
        return $this->morphTo();
    }
    
    public function media() {
        return $this->hasMany('App\Entities\Medium');
    }
}
