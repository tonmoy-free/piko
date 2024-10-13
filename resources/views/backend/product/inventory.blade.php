@extends('layouts.admin')

@section('content')
 <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Inventory List -<strong>{{ $products->product_name }}</strong></h3>
            </div>
            <div class="card-body">
                @if (session('success_delete'))
                <div class="alert alert-success">{{ session('success_delete') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($inventories as $inventory)
                    <tr class="{{ $inventory->quantity <=5?'bg-light':'' }}">
                        <td>{{ $inventory->rel_to_color->color_name }}</td>
                        <td>{{ $inventory->rel_to_size->size_name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ $inventory->price }}</td>
                        <td>{{ $inventory->after_discount }}</td>
                        <td>
                            @if ($inventory->quantity <=5)
                              <span class="badge badge-danger">Stock Out</span>
                            @else
                               <span class="badge badge-success">Stock In</span>
                            @endif
                        </td>
                        <td>
                            <a title="Delete" data-link="{{ route('inventory.delete',$inventory->id ) }}" class="btn btn-danger btn-icon del">
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
                <h3>Add Inventory</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('inventory.store', $products->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" disabled class="form-control" value="{{ $products->product_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Select Color</label>
                        <select name="color_id" id="" class="form-control">
                            <option value="">Select Color</option>
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Select Size</label>
                        <select name="size_id" id="" class="form-control">
                            <option value="">Select Color</option>
                            @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Inventory</button>
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
  <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection

