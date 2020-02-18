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
                        <img style="height: 70px; object-fit: cover" class="w-100 rounded-circle" src="{{asset($post->profile->image)}}" alt="">
                    </div>
                    <div class="col-md-8">
                        <h5>{{$post->profile->user->name}}</h5>
                        <p>{{$post->desc}}</p>

                        <div class="post-footer mt-5">
                            <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="far fa-heart"></i></a>
                            <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="far fa-comments"></i></a>
                            <a class="ml-2 d-inline-block" style="font-size: 20px" href="#"><i class="fab fa-telegram-plane"></i></a>
                        </div>
                        <div class="post-desc pt-2">
                            <p class="mb-0"><small>1 Like</small></p>
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
    </div>

@endsection
