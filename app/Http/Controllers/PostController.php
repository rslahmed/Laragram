<?php

namespace App\Http\Controllers;

use App\Heart;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function create(){
        return view('post/add-post');
    }

    function store(Request $request){
        $request->validate([
            'desc' => 'required|min:5|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        $file = $request->file('image');
        $path = '/uploads/post/';
        $image = $path.time().'.'.$file->getClientOriginalExtension();
        $userId = Auth::user()->id;
        $data = [
            'desc' => $request->desc,
            'image' => $image,
            'profile_id' =>$userId
        ];

        $notification = '';

        $insert = Post::create($data);
        if ($insert){
            $file->move(public_path().($path), $image);
            $notification = array(
                'message' => 'insert succfull',
                'status' => 'success',
            );
        }
        else{
            $notification = array(
                'message' => 'insert fail',
                'status' => 'warning',
            );
        }
        return redirect('/profile/view/'.$userId)->with($notification);

    }

    function view($id){

        $post = Post::findOrFail($id);
        $heart = Heart::where('post_id', $id)->get();
        return view('post/view-post', compact('post', 'heart'));


    }

    function index(){
        $users = auth()->user()->follows()->pluck('follow_id');
        $posts = Post::whereIn('profile_id', $users)->latest()->get();
        $recentUser = User::orderBy('created_at', 'DESC')->whereNotIn('id', array(Auth::id()))->limit(4)->get();
        return view('post.post-index', compact('posts', 'recentUser', 'heart'));
    }
}
