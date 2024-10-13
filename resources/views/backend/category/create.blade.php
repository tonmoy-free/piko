@extends('layouts.admin')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.panel') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category Add Page</li>
    </ol>
</nav>
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Category Insert Form</h6>
        @if (session('category_add'))
            <div class="alert alert-success">{{session('category_add')}}</div>
    @endif
        <form class="forms-sample" action="{{ route('category.insert')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputUsername1">Category Name</label>
                <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="name" name="category_name">
                @error('category_name')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category Slug</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="slug" name="category_slug">
                @error('category_slug')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Category Description</label>
                <textarea class="form-control" rows="8" name="category_description"></textarea>
                @error('category_description')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Category Image</label>
                <input type="file" class="form-control"  name="category_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                @error('category_image')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="my-2">
                    <img src="{{asset('/uploads/user')}}/{{Auth::user()->image}}" id="blah" alt="" width="200">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
      </div>
    </div>


    <div class="col-md- grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
                            <h6 class="card-title">Category Table</h6>
                            @if (session('category_delete'))
                            <div class="alert alert-success">{{session('category_delete')}}</div>
                            @endif
                            <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category Image</th>
                                                <th>Category Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                            <tr>
                                                <th>{{$loop->index+1}}</th>
                                                <td>
                                                    <img src="{{ asset('uploads/category/')}}/{{$category->category_image}}" alt="" style="width: 100px, height:100px, border-radius:100%">
                                                </td>
                                                <td>{{$category->category_name}}</td>
                                                <td>
                                                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#showData{{$category->id}}">
                                                    <i class="material-symbols-outlined">
                                                        visibility
                                                    </i>
                                                   </button>
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editData{{$category->id}}">
                                                    <i class="material-symbols-outlined">
                                                        edit
                                                    </i>
                                                   </button>


                                                   <form action="{{ route('category.distroy', $category->id)}}" method="POST">
                                                    @csrf
                                                   <button type="submit" class="btn btn-danger mt-1">
                                                    <i class="material-symbols-outlined">
                                                    delete
                                                    </i>
                                                   </button>
                                                   </form>

                                                </td>
                                            </tr>
                                            {{--modal for showing data --}}
                                            <div class="modal fade" id="showData{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Showing {{$category->category_name}} Data</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="row">
                                                         <div class="col-12">
                                                          <div class="card">
                                                            <div class="card-head">

                                                            </div>
                                                            <div class="card-body">
                                                              <span>Image :</span> <img src="{{ asset('uploads/category/')}}/{{$category->category_image}}" style="width: 100px; height:100px; border-radius:50%;" alt="">
                                                              <p>Title : {{$category->category_name}}</Title></p>
                                                              <p>Slug : {{$category->category_slug}}</Title></p>
                                                              <p>Description : {{$category->category_description}}</Title></p>
                                                            </div>

                                                          </div>
                                                         </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                             {{--modal for showing data --}}

                                             {{--modal for edit data --}}
                                            <div class="modal fade" id="editData{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Showing {{$category->category_name}} Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="row">
                                                       <div class="col-12">
                                                        <div class="card">
                                                          <div class="card-head">

                                                          </div>
                                                          <div class="card-body">
                                                            <form class="forms-sample" action="{{ route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                                                              @csrf
                                                              <div class="form-group">
                                                                  <label for="exampleInputUsername1">Category Name</label>
                                                                  <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="name" name="category_name" value="{{$category->category_name}}">

                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="exampleInputEmail1">Category Slug</label>
                                                                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="slug" name="category_slug" value="{{$category->category_slug}}">

                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="exampleInputPassword1">Category Description</label>
                                                                  <textarea class="form-control" rows="8" name="category_description">{{$category->category_description}}
                                                                  </textarea>

                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="exampleInputPassword1">Category Image</label>
                                                                  <input type="file" class="form-control"  name="category_image" onchange="document.getElementById('bl').src = window.URL.createObjectURL(this.files[0])">
                                                                  <img src="{{ asset('uploads/category/')}}/{{$category->category_image}}" style="width: 100px; height:100px; border-radius:;" alt="">

                                                                  <div class="my-2">
                                                                      <img src="{{asset('/uploads/user')}}/{{Auth::user()->image}}" id="bl" alt="" width="200">
                                                                  </div>
                                                              </div>

                                                              <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                                          </form>
                                                          </div>

                                                        </div>
                                                       </div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                           {{--modal for edit data --}}
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
          </div>
        </div>
                </div>



            </div>

@endsection
