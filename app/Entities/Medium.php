<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medium extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'value'
    ];
    
    public function medium_type(){
        return $this->belongsTo('App\Entities\MediumType');
    }
}
