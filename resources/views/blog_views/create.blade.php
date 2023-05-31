<!-- resources/views/blogs/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-3">
        <h1>Create Blog</h1>
        <form method="POST" action="{{ route('blogs.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </form>

    </div>
@endsection
