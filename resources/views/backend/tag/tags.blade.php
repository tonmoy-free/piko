@extends('layouts.admin')

@section('content')
@can('tag_access')


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Tag List</h3>
            </div>
            <div class="card-body">
                @if (session('tag_success'))
                    <div class="alert alert-success">{{ session('tag_success') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Tag Name</th>
                        <th>Slug</th>
                        <th>Last Updated</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($tags as $sl=>$tag)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $tag->tag_name }}</td>
                        <td>{{ $tag->tag_slug }}</td>
                        <td>
                            {{ $tag->updated_at == NULL?$tag->created_at:$tag->updated_at }}
                        </td>
                        <td>

                            <a  title="Edit" href="{{ route('edit.tag', $tag->id) }}" class="btn btn-primary btn-icon">
                                <i data-feather="edit"></i>
                            </a>
                            <a title="Delete" data-link="{{ route('tag.delete', $tag->id) }}" class="btn btn-danger btn-icon del">
                                <i data-feather="trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="my-2">
                    {{$tags->links()  }}
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-header">
            <h3>Add New Tag</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('tag.store') }}" method="POST">
                @csrf
               <div class="mb-3">
                <label for="" class="form-label">Tag Name</label>
                <input type="text" name="tag_name" class="form-control">
                @error('tag_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
               </div>
               <div class="mb-3">
                <button type="submit" class="btn btn-primary">ADD TAG</button>
               </div>
            </form>
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
@endsection
