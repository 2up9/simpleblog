@extends('layouts.app')

@section('title')

{{ $post->title }}
    
@endsection

@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="card">

            <a href="{{ route('posts.index') }}" class="close p-3 ml-auto" data-dismiss="card" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
    
        @if ($post->thumbnail)
            
            <img src="{{ $post->takeImage() }}" alt="" class="card-img-top" style="height: 550px;">
        @else 
            <img src="{{ asset("storage/images/post/default-bg.png") }}" alt="" class="card-img-top" style="height: 450px;">
        @endif
        
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <div class="media">
                <img src="{{ $post->user->gravatar() }}" alt="" class="rounded-circle mr-3" width="40px">
                <div class="media-body">
                    
                    <div class="media-text mb-3">
                        <div>{{ $post->user->name }}</div>
                        {{ $post->user->email }}
                    </div>
    
                </div>
            </div>


            <small><a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a> &middot;
            
                @foreach ($post->tags as $item)
                    #{{ $item->name }}
                        
                @endforeach

            </small>
            <p class="card-text">

                {!! nl2br($post->body) !!}
            </p>
            <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-primary">Edit</a>
            @include('posts.partials.modal')
        </div>
    </div>
    </div>

    {{-- Category --}}
    <div class="col-md-3">
        <h3>Category : </h3>
        <hr>
        @foreach ($posts as $item)
        
        <div class="media py-2">
            <img src="{{ $item->thumbnail ? $item->takeImage() : asset('storage/images/post/default-bg.png') }}" class="mr-3" alt="..." width="64" height="64">
            <div class="media-body">
                <h5 class="mt-0"><a href="{{ route('posts.show', $item->slug) }}">{{ $item->title }}</a></h5>
                {{ \Str::limit($item->body, 20) }}
            </div>
        </div>

        {{-- Tags --}}
        @endforeach
        <h3 class="pt-3">Tags :</h3>
        <hr>
        @foreach ($tagx as $item)
        <div class="media py-2">
            <img src="{{ $item->thumbnail ? $item->takeImage() : asset('storage/images/post/default-bg.png') }}" class="mr-3" alt="..." width="64" height="64">
            <div class="media-body">
                <h5 class="mt-0"><a href="{{ route('posts.show', $item->slug) }}">{{ $item->title }}</a></h5>
                {{ \Str::limit($item->body, 20) }}
            </div>
        </div>
        @endforeach
    </div>
</div>

    
@endsection