@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
        {{ __('Import File') }}
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" class="form-control" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <span class="text text-danger">
                    @error('file')
                    {{ $message }}
                    @enderror
                  </span>
                <br>
                <button class="btn btn-primary mt-3" type="submit">Import</button>
            </form>
        </div>
    </div>
</div>
@endsection