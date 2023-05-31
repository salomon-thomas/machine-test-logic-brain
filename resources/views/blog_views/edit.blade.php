<!-- resources/views/blogs/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-3">
        <h1>Edit Blog</h1>
        <form method="POST" action="{{ route('blogs.update', $blog) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
