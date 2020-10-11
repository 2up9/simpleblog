@extends('layouts.app')

@section('title','Posts')

@section('content')

<div class="d-flex justify-content-between">

    @isset($category)
    <div>
        <h3>Category : {{ $category->name }}</h3>
    </div>
    <div>
        <a href="{{ route('posts.create') }}" class="pr-2">New</a>
    </div>
    @endisset

    @isset($tag)
    <div>
        <h3>Tag : {{ $tag->name }}</h3>
    </div>
    <div>
        <a href="{{ route('posts.create') }}" class="pr-2">New</a>
    </div>
    @endisset

    @if (!isset($tag) && !isset($category))
    <div>
        <h3>Posts</h3>
    </div>
    <div>
        <a href="{{ route('posts.create') }}" class="pr-2">New</a>
    </div>
    @endif
    
    
</div>

<div class="row">
    @foreach ($posts as $post)
    <div class="col-md-4 pt-3">
        <div class="card h-100">
            @if ($post->thumbnail)
                <img src="{{ $post->takeImage() }}" alt="" class="card-img-top" height="200px">
            @else
                <img src="{{ asset("storage/images/post/default-bg.png") }}" alt="" class="card-img-top" height="200px">
            @endif
            
            <div class="card-body">
                <small class="text-secondary">
                    
                    <a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a> &middot;
                    
                @foreach ($post->tags as $item)
                    <a href="{{ route('tags.show', $item->slug) }}">{{ $item->name }}</a>
                @endforeach
                
                </small>
                <h5 class="card-title"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h5>
                <p class="card-text text-secondary">{{ \Str::limit($post->body, 100) }}</p>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <div class="media align-items-center">
                    <img src="{{ $post->user->gravatar() }}" class="mr-3 rounded-circle" width="40px" alt="...">
                    <div class="media-body">
                      {{ $post->user->name }}
                    </div>
                </div>
                <div >
                    {{ $post->created_at->format('d F Y') }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
   
</div>

<div class="d-flex justify-content-center pt-3">
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
    
@endsection