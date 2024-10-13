@extends('layouts.admin')

@section('content')
@can('trash_category')
 <div class="row">
  <div class="col-lg-8">
    <form action="{{ route('restore.checked') }}" method="POST">
        @csrf
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Trash Category List</h3>
            <div>
               <button name="abc" value="1" type="submit" href="" class="btn btn-success">Restore Cheecked</button>
               <button name="abc" value="2" type="submit" href="" class="btn btn-danger">Delete Cheecked</button>
            </div>
        </div>
        <div class="card-body">
             <table class="table table-border">
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
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Action</th>
                </tr>
                @forelse ($trashed as $sl=>$trash )
                <tr>
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                               <input type="checkbox" class="form-check-input chkDel" name="category_id[]" value="{{ $trash->id}}">

                           <i class="input-frame"></i>
                           </label>
                          </div>
                    </td>
                    <td>{{ $sl+1}}</td>
                    <td>{{ $trash->category_name}}</td>
                    <td><img src="{{ asset('uploads/category')}}/{{ $trash->category_image }}" alt=""></td>
                    <td>
                        <a title="Restore" href="{{ route('category.restore', $trash->id)}}" class="btn btn-success btn-icon">
                            <i data-feather="rotate-cw"></i>
                        </a>
                        <a title="Delete" data-link="{{ route('hard.delete.category',$trash->id ) }}" class="btn btn-danger btn-icon del">
                            <i data-feather="trash"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Trash Category List is empty</td>
                </tr>
               @endforelse
             </table>
        </div>
    </div>
</form>
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
@endsection


