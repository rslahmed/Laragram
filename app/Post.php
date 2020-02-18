<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['desc', 'image', 'profile_id'];

    function profile(){
        return $this->belongsTo(Profile::class);
    }
}
