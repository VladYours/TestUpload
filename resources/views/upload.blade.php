@extends('layout')

@section('title')
Upload Users Info File
@endsection

@section('content')
    <h1 class="w-100 text-center">Upload File with Users Info</h1>
    <form method="POST" enctype="multipart/form-data" class="row g-3 text-center justify-content-center">
        @csrf
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
        <div class="col-auto">
          <label for="formFile" class="form-label">File with Users</label>
          <input class="form-control" type="file" name="csv" id="formFile">
          <button class="btn btn-primary mt-3" type="submit">Upload</button>
        </div>
    </form>
@endsection