@extends('layouts.app')

@section('content')

    <div class="container pt-2" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach($posts as $post)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <img style="max-height: 500px; object-fit: cover" class="w-100 img-thumbnail" src="{{asset($post->image)}}" alt="">
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <img style="height: 65px; object-fit: cover" class="w-100 rounded-circle" src="{{asset($post->profile->image)}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <a href="{{url('/profile/view/'.$post->profile->user->id)}}"><h5>{{$post->profile->user->name}}</h5></a>
                                    <p>{{$post->desc}}</p>

                                    <div class="post-footer mt-1">
                                        <a class="ml-2 d-inline-block"><i class="far fa-heart"></i></a>
                                        <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="far fa-comments"></i></a>
                                        <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="fab fa-telegram-plane"></i></a>
                                    </div>
                                    <div class="post-desc pt-2">
                                        <p class="mb-0"><small>{{ \App\Heart::where('post_id', $post->id)->get()->count() }} Like</small></p>
                                        <p><small>20 dec 2020</small></p>
                                    </div>
                                    <div class="post-comment">
                                        <form action="#">
                                            <input class="form-control" type="text" placeholder="comment">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                                            <img style="width: 100%; height: 60px; border-radius: 50%;" src="{{asset($ruser->profile->image ?? asset('uploads/profile/default.png'))}}" alt="user">
                                        </div>
                                        <div class="col-md-5">
                                            <a href="{{url('profile/view/'.$ruser->id)}}"><h5>{{ $ruser->name }}</h5></a>
                                        </div>
                                        <div class="col-md-4">
                                            @if (Auth::User()->isFollowing($ruser->id))
                                                <a class="btn btn-sm btn-secondary" href="{{url('/unfollow/'.$ruser->id)}}" >Unfollow</a>
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


