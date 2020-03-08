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

            return back()->with('success', 'You are now following '. $user->name);
        } elseif(Auth::user()->isFollowing($user->id)){
            $follow = Auth::user()->follows()->where('follow_id', $user->id)->first();
            $follow->delete();

            return back()->with('success', 'You have unfollow '. $user->name);
        }

    }
}
