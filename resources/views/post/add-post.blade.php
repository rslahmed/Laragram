@extends('layouts.app')

@section('content')

    <div class="container pt-4">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header">Add New Post</div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/post/store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="desc" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea id="desc" type="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" required>{{ old('desc') }}</textarea>

                                    @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Post
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
