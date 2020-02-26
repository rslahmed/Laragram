@extends('layouts.app')

@section('content')

    <div class="container pt-4">
        <div class="row">
            <div class="col-md-8">
                <img style="max-height: 500px; object-fit: cover" class="w-100 img-thumbnail" src="{{asset($post->image)}}" alt="">
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <img style="height: 70px; object-fit: cover" class="w-100 rounded-circle" src="{{asset($post->profile->image ?? asset('uploads/profile/default.png'))}}" alt="">
                    </div>
                    <div class="col-md-8">
                        <a href="{{url('/profile/view/'.$post->profile->id)}}"><h5>{{$post->profile->user->name}}</h5></a>
                        <p>{{$post->desc}}</p>

                        <div class="post-footer mt-5">
{{--                            \App\Heart::where('user_id', Auth::id())->where('post_id', $post->id)->first()--}}
                            <a class="ml-2 d-inline-block @if(auth()->user()->isLIked($post->id)) text-danger @endif" style="font-size: 20px" href="{{url('/like/'.$post->id)}}"><i class="far fa-heart"></i></a>
                            <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="far fa-comments"></i></a>
                            <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="fab fa-telegram-plane"></i></a>
                        </div>
                        <div class="post-desc pt-2">
                            <p class="mb-0"><small>{{$post->heart->count() }} Like</small></p>
                            <p class="mb-0"><small>{{$post->comment->count()}} comment</small></p>
                            <p><small>20 dec 2020</small></p>
                        </div>

                    </div>
                    <div class="col-md-1">
                        @if($post->profile->user->id == auth()->id())
                        <div class="dropdown dropleft">
                            <button class="dropdown-toggle" type="button" id="editProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="editProfile">
                                <a class="dropdown-item" href="{{ url('post/edit/'.$post->id) }}">Edit</a>
                                <a class="dropdown-item" href="{{url('post/delete/'.$post->id)}}">Delete</a>
                                <a class="dropdown-item" href="#">Share</a>
                            </div>
                        </div>
                            @endif

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
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

                <div class="row mt-4">
                    <div class="col-md-12">
                        @foreach($comments as $comment)
                            <div class="row no-gutters align-items-start mb-3">
                                <div class="col-md-2">
                                    <img style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" src="{{asset($comment->user->profile->image ?? asset('uploads/profile/default.png'))}}" alt="">
                                </div>
                                <div class="col-md-10">
                                    <a href="{{url('/profile/view/'.$comment->user->id)}}"><h6 class="mb-1">{{$comment->user->name}}</h6></a>
                                    <p style="line-height: 1; word-break: break-all" class="mb-0">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>


        </div>
    </div>

@endsection
