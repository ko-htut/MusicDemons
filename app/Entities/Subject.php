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
    
    public function like_users() {
        return $this->belongsToMany('App\User','likes','subject_id','user_id')->withPivot('like');
    }
    
    public function likes() {
        return $this->like_users()->wherePivot('like',true);
    }
    
    public function dislikes() {
        return $this->like_users()->wherePivot('like',false);
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
    
    public function getHasImageAttribute() {
        return file_exists(public_path('images/' . $this->id));
    }
    public function getImageAttribute() {
        if(file_exists(public_path('images/' . $this->id))){
            return '/images/' . $this->id;
        } else {
            return null;
        }
    }
}
