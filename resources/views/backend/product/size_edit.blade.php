@extends('layouts.admin')

@section("content")
<div class="row">
   <div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h3>Add Size</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('size.update', $sizes->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Size Name</label>

                    <input type="text" class="form-control" name="size_name" value="{{ $sizes->size_name }}">
                    @error('size_name')
                       <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Size</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
