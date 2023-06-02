<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $blog->title }}</div>

                <div class="card-body">
                    <p>Written by: {{ $blog->user->name }}</p>
                    <p>{!! $blog->content !!}</p>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Add Comment</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <textarea wire:model.defer="content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Save</button>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Comments</div>

                <div class="card-body">
                    @if ($comments->count() > 0)
                        <ul class="list-group">
                            @foreach ($comments as $comment)
                                <li class="list-group-item">
                                    <p>{{ $comment->content }}</p>
                                    <small>Commented by: {{ $comment->user ? $comment->user->name : 'Guest' }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No comments yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
