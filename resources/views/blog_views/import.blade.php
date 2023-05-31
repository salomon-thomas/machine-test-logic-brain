@extends('layouts.app')

@section('content')
    <div class="mx-4">
        <h2>Import Blogs</h2>

        <form action="{{ route('import_blogs') }}" class="mx-3" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="csv_file">CSV File</label>
                <input type="file" name="csv_file" id="csv_file" class="form-control-file" required accept=".csv, .txt">
            </div>

            <button type="submit" class="btn btn-primary mt-2">Import</button>
        </form>
    </div>
@endsection
