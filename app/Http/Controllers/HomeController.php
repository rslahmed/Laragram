<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $profile = Profile::find($userId);
        return view('home', compact('profile'));
    }

    function search(Request $request){
        $users = User::where('username', $request->username)->orWhere('name','LIKE','%'.$request->username.'%')->get();
        return view('profile.search-result', compact('users'));
    }
}
