<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\MediumType;
use App\Entities\Medium;

class Subject extends Model
{
    protected $hidden = [
        'user_insert',
        'user_update',
        'user_delete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function subjectable() {
        return $this->morphTo();
    }
    
    public function media() {
        return $this->hasMany('App\Entities\Medium');
    }
    
    public function getYoutubeIdAttribute() {
        $youtube_type = MediumType::where('description','Youtube')->first();
        
        if($youtube_type === null) {
            return null;
        } else {
            $youtube_video = Medium::where('medium_type_id',$youtube_type->id)->where('subject_id',$this->id)->first();
            if($youtube_video === null) {
                return null;
            } else {
                $parts = parse_url($youtube_video->value);
                parse_str($parts['query'], $parameters);
                return $parameters["v"];
            }
        }
    }
}
