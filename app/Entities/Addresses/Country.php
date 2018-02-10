<?php

namespace App\Entities\Addresses;

use App\Entities\Addresses\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_addr';
    
    protected $fillable = [
        'code'
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
    
    public function place() {
        return $this->morphOne('App\Entities\Addresses\Place','placeable');
    }
    
    public function continents() {
        return $this->belongsToMany('App\Entities\Addresses\Continent');
    }
    
    public function getRegionsAttribute() {
        if($this->structure->elements->count() === 0) {
            return collect([]);
        } else {
            return Region::where('parent_place_id','=',$this->place->id);
        }
    }
    
    public function getCitiesAttribute() {
        if($this->structure->elements->count() !== 0) {
            return City::whereIn(
                'id',
                Region::whereHas('parent_place', function($query) {
                    $query->where('id','=',$this->place->id);
                })->get()
                  ->map(function($item, $key) {
                      return $item->child_cities->get();
                  })->collapse()
                  ->pluck('id')
            );
        } else {
            return City::whereHas('parent_place', function($query) {
                return $query->where('id','=',$this->place->id);
            });
        }
    }
    
    public function getPlaceIdAttribute() {
        return $this->place->id;
    }
    
    public function structure() {
        return $this->belongsTo('App\Entities\Addresses\Structure');
    }
    
    public function getTextAttribute() {
        return $this->place->name;
    }
}
