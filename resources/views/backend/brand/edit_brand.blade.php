@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Edit Brand</h3>
                <h5>Last Updated :{{ $brands->updated_at }}</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success')}}</div>
            @endif
      <form action="{{ route('update.brand',$brands->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Brand Name</label>
            <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" value="{{ $brands->brand_name }}">
            @error('brand_name')
                 <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Brand Logo</label>
            <input type="file" name="brand_logo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            @error('brand_logo')
                 <strong class="text-danger">{{ $message }}</strong>
            @enderror
            <div class="my-2">
                <img src="{{ asset('uploads/brand/') }}/{{ $brands->brand_logo }}" id="blah" alt="" width="200">
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update Brand</button>
        </div>
      </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection



