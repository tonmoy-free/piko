@extends('layouts.admin')

@section('content')
@can('brand_access')


<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('check.delete') }}" method="POST">
            @csrf
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Brand List</h3>
                <button type="submit" href="" class="btn btn-danger">Delete Cheecked</button>

            </div>

            <div class="card-body">
                @if (session('che_success'))
                  <div class="alert alert-success">{{ session('che_success') }}</div>
                @endif
                @if (session('brand_success'))
                   <div class="alert alert-success">{{ session('brand_success') }}</div>
                @endif
                <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <label class="form-check-label">
                                   <input type="checkbox" class="form-check-input" id="chkSelectAll">
                                   Check All
                               <i class="input-frame"></i>
                               </label>
                              </div>
                        </th>
                        <th>SL</th>
                        <th>Brand Name</th>
                        <th>Brand Slug</th>
                        <th>Brand Logo</th>
                        <th>Last Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @foreach ($brands as $sl=>$brand )

                    <tr>
                        <td>
                            <div class="form-check">
                                <label class="form-check-label">
                                   <input type="checkbox" class="form-check-input chkDel" name="brand_id[]" value="{{ $brand->id}}">

                               <i class="input-frame"></i>
                               </label>
                              </div>
                        </td>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $brand->brand_name }}</td>
                        <td>{{ $brand->brand_slug }}</td>
                        <td><img src="{{ asset('uploads/brand/') }}/{{ $brand->brand_logo }}" alt=""></td>
                        <td>{{ $brand->updated_at }}</td>
                        <td>
                            <a  title="Edit" href="{{ route('edit.brand', $brand->id) }}" class="btn btn-primary btn-icon">
                                <i data-feather="edit"></i>
                            </a>
                            <a title="Delete" data-link="{{ route('brand.delete', $brand->id) }}" class="btn btn-danger btn-icon del">
                                <i data-feather="trash"></i>
                            </a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </form>
    </div>
    <div class="col-lg-4">
        <div class="card-header">
            <h3>Add New Brand</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success')}}</div>
            @endif
      <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Brand Name</label>
            <input type="text" name="brand_name" class="form-control" placeholder="Brand Name">
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
                <img src="" id="blah" alt="" width="200">
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Add Brand</button>
        </div>
      </form>
        </div>
    </div>
</div>
@endcan

@endsection

@section('footer_script')
<script>
  let table = new DataTable('#myTable');
</script>
<script>
    $("#chkSelectAll").on('click', function(){
     this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
})
</script>
<script>
  $('.del').click(function(){
    var link =$(this).attr('data-link');

    Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
    }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = link;
    }
    });
  });
</script>
@if (session('delete'))
<script>
    Swal.fire({
        title:"Deleted",
        text:'{{ session('delete')}}',
        icon:"success"
    })
</script>

@endif
@endsection
