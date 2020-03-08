@extends('layouts.app')

@section('content')

    <div class="container pt-2" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if ($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <a href="{{ url('post/view/'.$post->id) }}"><img style="max-height: 500px; object-fit: cover" class="w-100 img-thumbnail" src="{{asset($post->image)}}" alt=""></a>
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <img style="height: 65px; object-fit: cover" class="w-100 rounded-circle" src="{{asset($post->profile->image ?? '/uploads/profile/default.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <a href="{{url('/profile/view/'.$post->profile->user->id)}}"><h5>{{$post->profile->user->name}}</h5></a>
                                    <p>{{$post->desc}}</p>

                                    <div class="post-footer mt-1">
                                        <a class="ml-2 d-inline-block @if(auth()->user()->isLIked($post->id)) text-danger @endif" style="font-size: 20px" href="{{url('/like/'.$post->id)}}"><i class="far fa-heart"></i></a>
                                        <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="far fa-comments"></i></a>
                                        <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="fab fa-telegram-plane"></i></a>
                                    </div>
                                    <div class="post-desc pt-2">
                                        <p class="mb-0"><small>{{ $post->heart->count() }} Like</small></p>
                                        <p class="mb-0"><small>{{$post->comment->count()}} comment</small></p>
                                        <p style="font-size: 10px; line-height: 1; margin-top: 5px; margin-bottom: 10px; color: #666">20 dec 2020</p>
                                    </div>
                                    <div class="post-comment">
                                        <form action="{{url('/comment/'.$post->id)}}" method="post">
                                            @csrf
                                            <div class="input-group">
                                                <input name="comment" type="text" class="form-control" placeholder="Type Your comment">
                                                <div class="input-group-append" id="button-addon4">
                                                    <button class="btn btn-outline-secondary" type="submit">Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @else
                        <div class="row">
                            <div class="col-md-12">
                                <h3>You don't follow anyone yet</h3>
                                <form action="{{url('search/user')}}" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="username" class="form-control" placeholder="Search username">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
            </div>
            <div class="col-md-4">
                <div class="row sticky-top">
                    <div class="col-md-12">
                        <div class="card" id="recent_user_wrap">
                            <div class="card-header d-flex align-items-center justify-content-between" >
                                <h6>Recent join users</h6>
                                <button class="btn btn-sm btn-danger" id="close_recent_user">x</button>
                            </div>
                            <div class="card-body" >
                                @foreach($recentUser as $ruser)
                                    <div class="row mb-2 align-items-center justify-content-center">
                                        <div class="col-md-3">
                                            <img style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover" src="{{asset($ruser->profile->image ?? asset('uploads/profile/default.png'))}}" alt="user">
                                        </div>
                                        <div class="col-md-5">
                                            <a href="{{url('profile/view/'.$ruser->id)}}"><h5>{{ $ruser->name }}</h5></a>
                                        </div>
                                        <div class="col-md-4">
                                            @if (Auth::User()->isFollowing($ruser->id))
                                                <a class="btn btn-sm btn-secondary" href="{{url('/follow/'.$ruser->id)}}" >Unfollow</a>
                                            @else
                                                <a class="btn btn-primary" href="{{url('/follow/'.$ruser->id)}}" >Follow</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


