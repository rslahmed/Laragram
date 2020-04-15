<?php

namespace App\Http\Controllers;

use App\Comment;
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
        $comments = Comment::where('post_id', $id)->get();
        return view('post/view-post', compact('post', 'comments'));


    }

    function index(){
        $users = auth()->user()->follows()->pluck('follow_id');
        $posts = Post::whereIn('profile_id', $users)->latest()->get();
        $recentUser = User::orderBy('created_at', 'DESC')->whereNotIn('id', array(Auth::id()))->limit(4)->get();
        return view('post.post-index', compact('posts', 'recentUser'));
    }

    function delete($id){
        $post = Post::where('id', $id)->first();
        $profile = $post->profile->id;
        $delete = $post->delete();
        if ($delete){
            $notification = array(
                'message' => 'Delete successful',
                'status' => 'success',
            );
        }
        else{
            $notification = array(
                'message' => 'Delete failed',
                'status' => 'warning',
            );
        }
        return redirect('profile/view/'.$profile)->with($notification);
    }

    function edit($id){
        $post = Post::where('id', $id)->first();
        return view('post/edit-post', compact('post'));
    }

    function update(Request $request, $id){
        $request->validate([
           'desc' => 'required',
        ]);
        $data = [
          'desc' => $request->desc
        ];

        $file = $request->file('image');
        if ($file){
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg',
            ]);
            $oldImage = Post::find($id)->image;
            if ($oldImage){
                unlink(public_path().$oldImage);
            }
            $path = '/uploads/post/';
            $image = $path.time().'.'.$file->getClientOriginalExtension();
            $data['image'] = $image;
            $file->move(public_path().($path), $image);
        }

        $update = Post::where('id', $id)->update($data);

        $notification = '';
        if ($update){
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
        return redirect('/post/view/'.$id)->with($notification);
    }
}
