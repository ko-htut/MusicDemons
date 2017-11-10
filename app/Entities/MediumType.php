<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediumType extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'description',
        'base_url'
    ];
    
    public function mediums() {
        return $this->hasMany('App\Entities\Medium');
    }
}
