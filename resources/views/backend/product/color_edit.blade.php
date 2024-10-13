@extends('layouts.admin')

@section('content')
 <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Add Color</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('color.update',$colors->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" class="form-control" name="color_name" value="{{ $colors->color_name }}">
                        @error('color_name')
                           <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="color" class="form-control" name="color_code" value="{{ $colors->color_code }}">
                        @error('color_code')
                           <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Color</button>
                    </div>
                </form>
            </div>
          </div>
    </div>
 </div>
@endsection
