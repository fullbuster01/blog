@extends('layouts.app' , ['title' => 'Update Post'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update Post : {{ $post->title }}</div>
                <div class="card-body">
                    <form action="/posts/{{ $post->slug }}/edit" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        {{-- @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $post->title }}">
                            @error('title')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" name="body" id="body" class="form-control">{{ old('body') ?? $post->body }}</textarea>
                            @error('body')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Save</button> --}}
                        @include('pages.posts.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection