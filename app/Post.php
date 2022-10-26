<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'comment', 'image'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    // public function scopeRecommend($query){
    //     return $query->latest()->limit(3);
    // }
}
