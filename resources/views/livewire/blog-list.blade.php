<div class="container">
    <h1 class="text-center mb-4 mt-4">Blogs</h1>
    <hr>
    @auth
        <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3 float-end d-inline-block">Create
            Blog</a>
        <div class="clearfix"></div>
    @endauth
    @if (count($blogs) > 0)
        <div class="row gx-3">
            @foreach ($blogs as $blog)
                <div class="col-md-6 col-12  mb-3">
                    <div class="card">



                        <div class="card-body">
                            <h3 class="card-title"><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a>
                            </h3>
                            <p class="card-text"><small class="text-body-secondary mb-3">Written
                                    by:
                                    {{ $blog->user->name }}</small></p>

                            {{-- <p class="card-text list-text">{{ $blog->content }}</p> --}}
                            <p class="card-text"><small class="text-body-secondary">Last
                                    updated {{\Carbon\Carbon::parse($blog->updated_at)->diffForHumans()}}
                                    </small></p>

                            <div class="d-flex w-100 justify-content-between">
                                <div class="align-self-center"> <a href="{{ route('blogs.show', $blog) }}"
                                        class="card-link">Continue
                                        Reading <i class="bi bi-chevron-right"></i></a></div>
                                <div class="align-self-center">

                                    @auth
                                        @if (auth()->user()->id == $blog->user_id)
                                            <div>
                                                <a href="{{ route('blogs.edit', $blog) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <button wire:click="delete({{ $blog->id }})"
                                                    class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            @endforeach
        </div>



        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links('pagination::bootstrap-4') }}
        </div>
    @else
        <p class="text-center">No blogs found.</p>
    @endif

</div>
