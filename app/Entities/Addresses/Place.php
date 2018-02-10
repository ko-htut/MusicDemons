<?php

namespace App\Entities\Addresses;

use App\Entities\Addresses\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_addr';
    
    protected $fillable = [
        'name'
    ];
    protected $appends = [
        'text'
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function placeable() {
        return $this->morphTo();
    }
    
    //public function regions() {
    //    return $this->hasMany('App\Entities\Region','parent_place_id');
    //}
    
    public function getTextAttribute() {
        if($this->placeable_type === "App\\Entities\\Addresses\\Region") {
            $region = Region::find($this->placeable_id);
            return $this->name . " (" . $region->structure_element->description . ")";
        } else {
            return $this->name . " (" . class_basename($this->placeable_type) . ")";
        }
    }
}
