<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'comment'];

    function post(){
        return $this->belongsTo(Post::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
