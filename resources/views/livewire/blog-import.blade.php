<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <h2 class="mb-4 mt-4">Import Blogs</h1>
                <hr>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="import" class="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">CSV File</label>
                            <input wire:model="csvFile" class="form-control" type="file" name="csv_file"
                                id="csv_file" required accept=".csv, .txt">
                        </div>
                        <div>
                            @error('csvFile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
</div>
