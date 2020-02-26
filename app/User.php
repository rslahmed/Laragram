<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'password', 'username'
    ];

    function profile(){
        return $this->hasOne(Profile::class);
    }



    protected static function boot()
    {
        parent::boot();
        static::created(function ($user){
            $user->profile()->create([
                'bio' => 'Description',
            ]);
        });
    }

//    followers
    public function follows() {
        return $this->hasMany(Follower::class);
    }

    // is following
    public function isFollowing($target_id)
    {
        return (bool)$this->follows()->where('follow_id', $target_id)->first(['id']);
    }

    //heart
    function heart(){
        return $this->hasMany('Heart', 'user_id', 'id');
    }

    // is liked
    function isLIked($post){
//        Heart::where('post_id', $id)->first();
        return (bool)Heart::where('post_id', $post)->where('user_id', Auth::id())->first();
    }

    //comment
    function comment(){
        return $this->hasMany('comments', 'user_id', 'id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
