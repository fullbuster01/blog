@extends('layouts.app' , ['title' => 'New Post'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Post</div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                        {{-- @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                            @error('title')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" name="body" id="body" class="form-control"></textarea>
                            @error('body')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Save</button> --}}
                        @include('pages.posts.form', ['submit' => 'Create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection