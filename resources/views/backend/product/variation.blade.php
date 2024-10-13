@extends('layouts.admin')

@section('content')
   <div class="row">
     <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
             <h3>Color List</h3>
            </div>
            <div class="card-body">
                @if (session('success_delete'))
                    <div class="alert alert-success">{{ session('success_delete') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>Color Name</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($colors as $color)
                    <tr>
                        <td>{{ $color->color_name }}</td>
                        <td><span class="badge py-3" style="background:{{ $color->color_code }}; color:transparent">Primary</span></td>
                        <td>
                            <a  title="Edit" href="{{ route('color.edit', $color->id) }}" class="btn btn-primary btn-icon">
                                <i data-feather="edit"></i>
                            </a>
                            <a title="Delete" data-link="{{ route('color.delete',$color->id) }}" class="btn btn-danger btn-icon del">
                                <i data-feather="trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
             <h3>Size List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Size Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->size_name }}</td>
                        <td>
                            <a  title="Edit" href="{{ route('size.edit', $size->id) }}" class="btn btn-primary btn-icon">
                                <i data-feather="edit"></i>
                            </a>
                            <a title="Delete" data-link="" class="btn btn-danger btn-icon del">
                                <i data-feather="trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
     </div>
     <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
                <h3>Add Color</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('color.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" class="form-control" name="color_name">
                        @error('color_name')
                           <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="color" class="form-control" name="color_code">
                        @error('color_code')
                           <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
          </div>
          <div class="card mt-3">
            <div class="card-header">
                <h3>Add Size</h3>
            </div>
            <div class="card-body">
                @if (session('success1'))
                    <div class="alert alert-success">{{ session('success1') }}</div>
                @endif
                <form action="{{ route('size.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Size Name</label>

                        <input type="text" class="form-control" name="size_name">
                        @error('size_name')
                           <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Size</button>
                    </div>
                </form>
            </div>
          </div>
     </div>
   </div>
@endsection

@section('footer_script')
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
