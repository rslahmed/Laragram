<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{


    public function follow(User $user)
    {
        if (!Auth::user()->isFollowing($user->id)) {
            // Create a new follow instance for the authenticated user
            Auth::user()->follows()->create([
                'follow_id' => $user->id,
            ]);

            return back()->with('success', 'You are now friends with '. $user->name);
        } else {
            return back()->with('error', 'You are already following this person');
        }

    }

    public function unfollow(User $user)
    {
        if (Auth::user()->isFollowing($user->id)) {
            $follow = Auth::user()->follows()->where('follow_id', $user->id)->first();
            $follow->delete();

            $notification = array([
                'message' => 'You are no longer friends with '. $user->name,
                'status' => 'success'
            ]);

            return back()->with($notification);
        } else {
            $notification = array([
                'message' => 'You are not following '. $user->name,
                'status' => 'error'
            ]);
            return back()->with($notification);
        }
    }
}
