@extends('frontend.master')

@section('content')
 <div class="container py-5">
    <div class="row">
        @include('frontend.customer.side_bar')
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.info.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" value="{{ Auth::guard('customer')->user()->name }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" value="{{ Auth::guard('customer')->user()->email }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">New Password</label>
                                    <input name="password" type="password" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input name="password_confirmation" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="c" class="form-label">Country</label>
                                    <input id="c" type="text" name="country" class="form-control" value="{{ Auth::guard('customer')->user()->country }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="ct" class="form-label">City</label>
                                    <input id="ct" type="text" name="city" class="form-control" value="{{ Auth::guard('customer')->user()->city }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="a" class="form-label">Address</label>
                                    <input id="a" type="text" name="address" class="form-control" value="{{ Auth::guard('customer')->user()->address }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="z" class="form-label">Zip</label>
                                    <input id="z" type="text" name="zip" class="form-control" value="{{ Auth::guard('customer')->user()->zip }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Photo</label>
                                    <input type="file" name="photo" class="form-control" value="{{ Auth::guard('customer')->user()->photo }}">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>

 </div>
@endsection
