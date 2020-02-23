<?php

namespace App\Http\Controllers;

use App\Heart;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeartController extends Controller
{


    function like($post){
        $didLike = Heart::where('user_id', Auth::id())->where('post_id', $post)->first();
        if (!$didLike){
            Heart::create([
                'user_id' => Auth::id(),
                'post_id' => $post,
            ]);
        }
        else{
            Heart::where('user_id', Auth::id())->where('post_id', $post)->delete();
        }
        return back();

    }
}
