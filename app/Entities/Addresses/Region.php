<?php

namespace App\Entities\Addresses;

use App\Entities\Addresses\City;
use App\Entities\Addresses\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_addr';

    protected $fillable = [
    ];
    protected $appends = [
        'text'
    ];
    
    public function place() {
        return $this->morphOne('App\Entities\Addresses\Place','placeable');
    }
    
    public function parent_place() {
        // region = within country or other region
        return $this->belongsTo('App\Entities\Addresses\Place');
    }
    
    public function continent() {
        return $this->belongsTo('App\Entities\Addresses\Continent');
    }
    
    public function structure_element() {
        return $this->belongsTo('App\Entities\Addresses\StructureElement');
    }
    
    public function getParentCountryAttribute() {
        $place = $this->parent_place;
        while($place->placeable_type !== 'App\\Entities\\Addresses\\Country') {
            $place = $place->placeable->parent_place;
        }
        return $place->placeable;
    }
    public function getParentRegionAttribute() {
        $place = $this->parent_place;
        if($place->placeable_type === 'App\\Entities\\Addresses\\Region') {
            return $place->placeable;
        } else {
            return null;
        }
    }
    public function getChildRegionsAttribute() {
        // child-regions or child-cities ?
        $child_structure_elements = $this->parent_country->structure->elements->where('index','>',$this->structure_element->index);
        if($child_structure_elements->count() === 0) {
            
            // child-cities
            return collect([]);
            
        } else {
            
            // child-regions
            return Region::whereHas('parent_place',function($query) {
                return $query->where('id','=',$this->place->id);
            });
            
        }
    }
    public function getChildCitiesAttribute() {
        $child_structure_elements = $this->parent_country->structure->elements->where('index','>',$this->structure_element->index);
        if($child_structure_elements->count() === 0) {
            
            // child-cities
            return City::where('parent_place_id','=',$this->place->id);
            
        } else {
            
            // child-regions
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
            
        }
    }
    public function getPlaceIdAttribute() {
        return $this->place->id;
    }
    
    public function getTextAttribute() {
        return $this->place->name;
    }
}
