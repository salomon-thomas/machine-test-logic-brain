@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="mb-4 mt-4">Edit Blog</h1>
                    <hr>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('blogs.update', $blog) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="form-label" for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $blog->title }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="content">Content:</label>
                            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Blog</button>
                        </div>
                    </form>
            </div>
        </div>

    </div>
@endsection
