@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Import Blogs</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('import_blogs') }}" class="mx-3" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="csv_file">CSV File</label>
                                <input type="file" name="csv_file" id="csv_file" class="form-control-file" required accept=".csv, .txt">
                            </div>

                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
