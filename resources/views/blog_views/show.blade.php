<!-- resources/views/blogs/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="mx-3">
        <h1>{{ $blog->title }}</h1>
        <p>Written by: {{ $blog->user->name }}</p>
        <p>{{ $blog->content }}</p>
        <hr>
        <h3>Comments</h3>
        @if (count($blog->comments) > 0)
            <ul class="list-group">
                @foreach ($blog->comments as $comment)
                    <li class="list-group-item">
                        <p>{{ $comment->content }}</p>
                        <small>Commented by: {{ $comment->user->name }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No comments yet.</p>
        @endif
        <hr>
        @auth
            <h3>Add Comment</h3>
            <form class="mt-2" method="POST" action="{{ route('comments.store', $blog) }}">
                @csrf
                <div class="form-group">
                    <textarea name="content" id="comment" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to add comments.</p>
        @endauth
    </div>
@endsection
