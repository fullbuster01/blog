@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        @if ($post->thumbnail)
            <img class="rounded w-100" src="{{ asset($post->takeImage()) }}" alt="thumbnail" style="height: 500px; object-fit: cover; object-position: center">
        @endif
        <h1>{{ $post->title }}</h1>
        <div class="text-secondary">
            <a href="/categories/{{ $post->category->name }}">{{ $post->category->name }}</a> &middot; {{ $post->created_at->format('d F Y') }} &middot;
            @foreach ($post->tags as $tag)
                <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
            @endforeach
        </div>
        <div class="media my-3 text-secondary">
            <img width="60" class="rounded-circle mr-3" src="{{ $post->user->gravatar() }}" alt="">
            <div class="media-body">
                <div>
                    {{ $post->user->name }}
                </div>
                {{ '@' . $post->user->username }}
            </div>
        </div>
        
        <p>{!! nl2br($post->body) !!}</p>
        
        @can('delete', $post)  {{-- ini adalah policy --}}
        <div class="d-flex mt-3">
            <div>
                <form action="/posts/{{ $post->slug }}/delete" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-sm btn-danger mr-2" type="submit" onclick="return confirm('apkah anda yakin ingin menghapus ?')">
                        Delete
                    </button>
                </form>
            </div>
            <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-success">Edit</a>
        </div>
        @endcan
    </div>

    <div class="col-md-4">
        @foreach ($posts as $post)
            <div class="card mb-4">
                    
                    <div class="card-body">
                        <div>
                            <a href="{{ route('categories.show', $post->category->slug) }}" class="text-secondary">
                                <small>{{ $post->category->name }} - </small>
                            </a>
                        
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}" class="text-secondary">
                                <small>{{ $tag->name }}</small>
                            </a>
                        @endforeach
                        </div>

                        <h5>
                            <a href="{{ route('post.show', $post->slug) }}" class="text-dark">
                            {{ $post->title }}
                            </a>
                        </h5>

                        <div class="text-secondary my-3">
                            {{ Str::limit($post->body, 130, '.') }}
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="media align-items-center">
                                <img width="40" class="rounded-circle mr-3" src="{{ $post->user->gravatar() }}" alt="">
                                <div class="media-body">
                                    <div>
                                        {{ $post->user->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
</div>
        
@endsection