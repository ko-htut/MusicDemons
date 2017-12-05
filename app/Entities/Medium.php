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
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function medium_type(){
        return $this->belongsTo('App\Entities\MediumType');
    }
    
    public function subject(){
        return $this->belongsTo('App\Entities\Subject');
    }
}
