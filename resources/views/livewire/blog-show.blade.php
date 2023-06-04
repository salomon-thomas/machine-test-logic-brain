<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h2 class="mb-4 mt-4">{{ $blog->title }}</h2>
            <hr>

            <p class="card-text"><small class="text-body-secondary mb-3">Written
                    by:
                    {{ $blog->user->name }}</small></p>
            <p>{!! $blog->content !!}</p>
            <p class="card-text"><small class="text-body-secondary">Last updated {{ \Carbon\Carbon::parse($blog->updated_at)->diffForHumans() }}</small></p>
            <div class="mt-4">

                <h4 class=" mb-3">Add Comment</h4>
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
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>

            </div>
            <div class=" mt-4">

                <h4 class=" mb-3">Comments</h4>
                @if ($comments->count() > 0)
                    @foreach ($comments as $comment)
                        <ul class="list-group">

                            <li class="list-group-item pt-3 pb-3 mb-3">
                                <h5>{{ $comment->user ? $comment->user->name : 'Guest' }}</h5>
                                <p class="mb-0">{{ $comment->content }}</p>
                                <p class="card-text"><small class="text-body-secondary">Commented {{ \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() }}</small></p>

                            </li>


                        </ul>
                    @endforeach
                @else
                    <p>No comments yet.</p>
                @endif

            </div>
        </div>
    </div>
</div>
