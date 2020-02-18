<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['full_name','bio', 'image'];

    function user(){
        return $this->belongsTo(User::class);
    }

    function post(){
        return $this->hasMany(Post::class);
    }
}
