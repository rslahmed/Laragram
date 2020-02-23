<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Heart;

class Post extends Model
{
    protected $fillable = ['desc', 'image', 'profile_id'];

    function profile(){
        return $this->belongsTo(Profile::class);
    }

    function heart(){
        $this->hasMany(Heart::class, 'post_id', 'id');
    }


}
