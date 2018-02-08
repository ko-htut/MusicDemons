<?php

namespace App\Entities\Addresses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_addr';
    
    protected $fillable = [
        'postal_code',
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function place() {
        return $this->morphOne('App\Entities\Addresses\Place','placeable');
    }
    
    public function parent_place() {
        return $this->belongsTo('App\Entities\Addresses\Place');
    }
}
