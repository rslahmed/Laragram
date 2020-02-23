@extends('layouts.app')

@section('content')

    <div class="container pt-4">
        <div class="row">
            <div class="col-md-3 offset-1">
                <img style="width: 180px; height: 180px; object-fit: cover" class="rounded-circle" src="{{asset($profile->image ?? '/uploads/profile/default.png')}}" alt="">
            </div>
            <div class="com-md-6 pt-4">
                <div class="d-flex justify-content-between align-items-center">
                   <h2 class="mr-5">{{$profile->user->username}}</h2>
                    @if($profile->id == \Illuminate\Support\Facades\Auth::id())
                    <a class="btn btn-sm btn-secondary" href="/profile/edit" >Edit Profile</a>
                        @else
                        @if (Auth::User()->isFollowing($profile->user->id))
                            <a class="btn btn-sm btn-secondary" href="{{url('/unfollow/'.$profile->user->id)}}" >Unfollow</a>
                        @else
                            <a class="btn btn-sm btn-secondary" href="{{url('/follow/'.$profile->user->id)}}" >Follow</a>
                        @endif
                    @endif
                </div>
                <div class="d-flex">
                    <p class="mr-3">{{count($posts)}} post</p>
                    <p class="mr-3">{{ $followers->count()}} follower</p>
                    <p class="mr-3">{{ $profile->user->follows->count()}} following</p>
                </div>

                <h6 class="mt-4 font-weight-bold">{{$profile->user->name}}</h6>
                <h6 class="mt-1">{{$profile->bio}}</h6>
                @if($profile->id == \Illuminate\Support\Facades\Auth::id())
                    <a class="" href="/post/add" >Add Post+</a>
                @endif
            </div>
        </div>

        <hr>

        <div class="row mt-4">
            @foreach($posts as $post)
            <div class="col-md-4">
                <a href="{{ url('post/view/'.$post->id) }}"><img style="max-height: 250px; object-fit: cover" class="w-100 img-thumbnail" src="{{asset($post->image)}}" alt=""></a>
            </div>
            @endforeach

        </div>
    </div>

@endsection
