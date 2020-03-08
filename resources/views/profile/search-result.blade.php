@extends('layouts.app')

@section('content')

    <div class="container pt-2" >
        <div class="row justify-content-center">
            <div class="col-md-5">
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
        <div class="row">
            <div class="col-md-5 m-auto">
                <div class="card" id="recent_user_wrap">
                    <div class="card-header">
                        <h5>Search Result</h5>
                    </div>
                    <div class="card-body" >
                        @if ($users->count() > 0)
                        @foreach($users as $user)
                            <div class="row no-gutters mb-2 align-items-center justify-content-center">
                                <div class="col-md-2">
                                    <img style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover" src="{{asset($user->profile->image ?? asset('uploads/profile/default.png'))}}" alt="user">
                                </div>
                                <div class="col-md-5">
                                    <a href="{{url('profile/view/'.$user->id)}}"><h5>{{ $user->name }}</h5></a>
                                </div>
                                <div class="col-md-4">
                                    @if (Auth::User()->isFollowing($user->id))
                                        <a class="btn btn-sm btn-secondary" href="{{url('/follow/'.$user->id)}}" >Unfollow</a>
                                    @else
                                        <a class="btn btn-primary" href="{{url('/follow/'.$user->id)}}" >Follow</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @else
                        <h4>user not found</h4>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


