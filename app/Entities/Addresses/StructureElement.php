<?php

namespace App\Entities\Addresses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StructureElement extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_addr';
    
    protected $fillable = [
        'description'
    ];
    
    protected $casts = [
        'index'  =>  'integer'
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function structure() {
        return $this->belongsTo('App\Entities\Addresses\Structure');
    }
}
