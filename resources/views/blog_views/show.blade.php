@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $blog->title }}</div>

                    <div class="card-body">
                        <p>Written by: {{ $blog->user->name }}</p>
                        <p>{{ $blog->content }}</p>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Comments</div>

                    <div class="card-body">
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
                    </div>
                </div>

                @auth
                    <div class="card mt-4">
                        <div class="card-header">Add Comment</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('comments.store', $blog) }}">
                                @csrf
                                <div class="form-group">
                                    <textarea name="content" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card mt-4">
                        <div class="card-body">
                            <p>Please <a href="{{ route('login') }}">login</a> to add comments.</p>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
