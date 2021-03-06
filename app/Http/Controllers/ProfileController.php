<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Post;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function index($id){
        $profile = Profile::findOrFail($id);
        $posts = Post::where('profile_id', $id )->get();
        $followers = Follower::where('follow_id',$id)->get();
//        dd($followers);

        return view('profile.view-profile', compact('profile', 'posts', 'followers'));
    }

    function edit(){
        $userId = Auth::user()->id;
        $profile = Profile::findOrFail($userId);
        return view('profile/edit-profile', compact('profile'));
    }

    function update(Request $request){
        $request->validate([
            'name' => 'required|min:5|max:25',
            'bio' => 'required|min:5|max:255',

        ]);

        $userId = Auth::user()->id;
        $data = [
            'bio' => $request->bio,
        ];

        $file = $request->file('image');
        if ($file){
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg',
            ]);
            $oldImage = Profile::find($userId)->image;
            if ($oldImage){
                unlink(public_path().$oldImage);
            }
            $path = '/uploads/profile/';
            $image = $path.time().'.'.$file->getClientOriginalExtension();
            $data['image'] = $image;
            $file->move(public_path().($path), $image);
        }

        $pupdate = Profile::where('id', $userId)->update($data);
        $uupdate = User::where('id', $userId)->update([
            'name' => $request->name
        ]);;

        $notification = '';
        if ($pupdate && $uupdate){
            $notification = array(
                'message' => 'Update successful',
                'status' => 'success',
            );
        }
        else{
            $notification = array(
                'message' => 'Update fail',
                'status' => 'warning',
            );
        }
        return redirect('/profile/view/'.$userId)->with($notification);
    }

    function editPassword(){
        return view('profile/change-password');
    }

    function updatePassword(Request $request){
        $request->validate([
            'oldPassword' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Hash::check($request->oldPassword, Auth::user()->getAuthPassword())){
            $update = User::where('id', Auth::id())->update([
               'password' => Hash::make($request->password)
            ]);
            if ($update){
                $notification = array(
                    'message' => 'Password changed!',
                    'status' => 'success',
                );
            }
            else{
                $notification = array(
                    'message' => 'Something went wrong, please try again',
                    'status' => 'warning',
                );
            }
            return redirect('/profile/view/'.Auth::id())->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Password not match',
                'status' => 'warning',
            );
        }
        return back()->with($notification);
    }

}
