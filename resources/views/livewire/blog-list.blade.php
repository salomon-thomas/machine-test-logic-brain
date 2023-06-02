<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title text-center">Blogs</h1>
        </div>
        <div class="card-body">
            @auth
                <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create Blog</a>
                <hr>
            @endauth
            @if (count($blogs) > 0)
                <ul class="list-group">
                    @foreach ($blogs as $blog)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h3><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></h3>
                                <small>Written by: {{ $blog->user->name }}</small>
                            </div>
                            @auth
                                @if (auth()->user()->id == $blog->user_id)
                                    <div>
                                        <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <button wire:click="delete({{ $blog->id }})" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                @endif
                            @endauth
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-center mt-4">
                    {{ $blogs->links('pagination::bootstrap-4') }}
                </div>
            @else
                <p class="text-center">No blogs found.</p>
            @endif
        </div>
    </div>
</div>
