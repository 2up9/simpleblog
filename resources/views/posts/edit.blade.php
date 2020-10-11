@extends('layouts.app')

@section('title', 'Edit')

@section('content')

<div class="d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Edit</div>
            <form action="{{ route('posts.edit', $post->slug) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="card-body">
                    @include('posts.partials.form-control')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection