@extends('layouts.admin')

@section('content')
@can('product_access')


 <div class="row">
  <div class="col-lg-12">
   <div class="card">
    <div class="card-header">
        <h3>Product List</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered" id="myTable">
            <thead>
            <tr>
                <th>Category</th>
                <th>Product</th>
                <th>Discount</th>
                <th>Preview</th>
                <th>Gallery</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
             <tr>
                <th>{{ $product->rel_to_cat->category_name  }}</th>
                 <td>{{ $product->product_name }}</td>
                 <td>{{ $product->discount }}%</td>
                 <td><img width="100" src="{{ asset('uploads/product/preview') }}/{{ $product->preview }}" alt=""></td>
                 <td>
                    @foreach (App\Models\Thumbnail::where('product_id',$product->id)->get() as $thumb)
                        <img src="{{ asset('uploads/product/thumbnail') }}/{{ $thumb->thumbnail }}" alt="">
                    @endforeach
                 </td>
                 <td>
                    <a title="View" href="{{ route('product.view',$product->id ) }}" class="btn btn-info btn-icon">
                        <i data-feather="eye"></i>
                    </a>
                    <a  title="Inventory" href="{{ route('inventory',$product->id) }}" class="btn btn-primary btn-icon">
                        <i data-feather="file-text"></i>
                    </a>
                    <a title="Delete" data-link="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-icon del">
                        <i data-feather="trash"></i>
                    </a>
                 </td>
             </tr>
            @endforeach
           </tbody>
        </table>
    </div>
   </div>
  </div>
 </div>
 @endcan
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


