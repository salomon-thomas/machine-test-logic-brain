<!-- resources/views/blogs/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-3">
        <h1>Blogs</h1>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create Blog</a>
        <hr>
        @if (count($blogs) > 0)
            <ul class="list-group">
                @foreach ($blogs as $blog)
                    <li class="list-group-item">
                        <h3><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></h3>
                        <small>Written by: {{ $blog->user->name }}</small>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-center mt-4 pagination">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
        @else
            <p>No blogs found.</p>
        @endif
    </div>
@endsection
