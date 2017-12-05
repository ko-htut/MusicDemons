<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediumType extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'description',
        'base_url',
        'icon_url'
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function mediums() {
        return $this->hasMany('App\Entities\Medium');
    }
}
