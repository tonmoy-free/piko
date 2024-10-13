@extends('layouts.admin')
 @section('content')
 @can('subcategory_access')
  <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>SubCategory List</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    @foreach ($categories as $category )
                    <div class="col-lg-6 my-2">
                    <div class="card">
                        <div class="card-header"><h3>{{ $category->category_name }}</h3></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>SL</th>

                                    <th>SubCategory Name</th>
                                    <th>Action</th>
                                </tr>
                                @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $sl=>$subcategory)
                                <tr>
                                    <td>{{ $sl+1 }}</td>
                           <!-- <td>{{ $subcategory->rel_to_category->category_name }}</td> -->
                                    <td>{{ $subcategory->subcategory_name }}</td>
                                    <td>
                                        <a  title="Edit" href="{{ route('edit.subcategory',$subcategory->id) }}" class="btn btn-primary btn-icon">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <a title="Delete" href="{{ route('delete.subcategory',$subcategory->id) }}" data-link="" class="btn btn-danger btn-icon del">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-header">
            <h3>ADD New SubCategory</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('exists'))
                <div class="alert alert-warning">{{ session('exists') }}</div>
            @endif
            <form action="{{ route('subcategory.store') }}" method="POST">
                @csrf
             <div class="mb-3">
                <label for="" class="form-label">Select Category</label>
                <select name="category_id" class="form-control">
                  <option value="">Select Category</option>
                   @foreach ( $categories as $category)
                      <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                   @endforeach
                </select>
                @error('category_id')
                   <strong class="text-danger">{{ $message }}</strong>
                @enderror
             </div>
             <div class="mb-3">
                <label for="" class="form-label">SubCAtegory Name</label>
                <input type="text" name="subcategory_name" class="form-control">
                @error('subcategory_name')
                   <strong class="text-danger">{{ $message }}</strong>
                @enderror
             </div>
             <div class="mb-3">
                <button class="btn btn-primary">ADD SubCategory</button>
             </div>
            </form>
        </div>
    </div>
  </div>
  @endcan
 @endsection
