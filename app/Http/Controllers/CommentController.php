<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function comment(Request $request,$post){

        $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post,
            'comment' => $request->comment
        ]);

        return back();
    }
}
