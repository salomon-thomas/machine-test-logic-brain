<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Create Blog</h1>
        </div>

        <!-- Success message -->
        @if ($successMessage)
            <div class="alert alert-success" wire:click="dismissSuccessMessage" role="alert">
                {{ $successMessage }}
            </div>
            <script>
                setTimeout(function() {
                    Livewire.emit('dismissSuccessMessage');
                }, 5000);
            </script>
        @endif

        <div class="card-body">
            <form wire:submit.prevent="store" wire:loading.remove>
                <div class="form-group">
                    <label for="title" class="form-label">Title:</label>
                    <input wire:model="title" type="text" name="title" id="title" class="form-control"
                        required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Content:</label>
                    <div wire:ignore>
                        <div id="editor">{!! $content !!}</div>
                    </div>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-2">Create</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            var quill = new Quill('#editor', {
                theme: 'snow',
            });

            quill.on('text-change', function() {
                @this.set('content', quill.root.innerHTML);
            });
        });
    </script>
@endpush
