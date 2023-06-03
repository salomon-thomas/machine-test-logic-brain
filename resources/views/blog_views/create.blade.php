@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h2 class="mb-4 mt-4">Create Blog</h1>
            <hr>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3"
                role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('blogs.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" id="title"
                        class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea name="content" id="content"
                        class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Blog</button>
            </form>

        </div>
    </div>
</div>
@endsection
