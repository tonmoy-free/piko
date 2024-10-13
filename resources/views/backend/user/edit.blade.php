@extends('layouts.admin')

@section('content')
  <div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Edit Profile Info</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('user.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Username" value="{{ Auth::user()->name}}">
                        @error('name')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control"  placeholder="Email" value="{{ Auth::user()->email}}">
                        @error('email')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Update Password</h3>
            </div>
            <div class="card-body">
                @if(session('pass_update'))
                <div class="alert alert-success">{{ session('pass_update') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Current Password</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Current Password" >
                        @error('current_password')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if(session('curnt'))
                        <strong class="text-danger">{{ session('curnt') }}</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="New Password" >
                        @error('password')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="New Password" >
                        @error('password_confirmation')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Update Profile Photo</h3>
            </div>
            <div class="card-body">
                @if(session('photo_update'))
                <div class="alert alert-success">{{ session('photo_update') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('user.photo.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Upload Photo</label>
                        <input type="file" name="profile_photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('profile_photo')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <div class="my-2">
                            <img src="{{asset('/uploads/user')}}/{{Auth::user()->image}}" id="blah" alt="" width="200">
                        </div>
                    </div>
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection