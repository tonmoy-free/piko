@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Edit Tag</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('update.tag', $tags->id) }}" method="POST">
                @csrf
               <div class="mb-3">
                <label for="" class="form-label">Tag Name</label>
                <input type="text" name="tag_name" class="form-control" value="{{ $tags->tag_name }}">
                @error('tag_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
               </div>
               <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update TAG</button>
               </div>
            </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Last Updated</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                   <tr>
                      <td>
                        {{$tags->updated_at == NULL?$tags->created_at:$tags->updated_at }}</td>
                   </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
