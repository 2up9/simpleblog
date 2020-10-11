@extends('layouts.app')

@section('title', 'Create')

@section('content')

<div class="d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Create</div>
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('posts.partials.form-control')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection