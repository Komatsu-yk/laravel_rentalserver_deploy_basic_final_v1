<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'body', 'position_x', 'position_y'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}

