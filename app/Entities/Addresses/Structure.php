<?php

namespace App\Entities\Addresses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Structure extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_addr';
    
    protected $fillable = [
        'description'
    ];
    protected $appends = [
        'text',
        'structure'
    ];
    
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function elements() {
        return $this->hasMany('App\Entities\Addresses\StructureElement')->orderBy('index');
    }
    
    public function depending_countries() {
        return $this->hasMany('App\Entities\Addresses\Country');
    }
    
    public function getTextAttribute() {
        return $this->description . " (" . $this->structure . ")";
    }
    
    public function getStructureAttribute() {
        $result = "Country, ";
        foreach($this->elements as $index => $element) {
            $result .= $element->description . ", ";
        }
        return $result . "City";
    }
}
