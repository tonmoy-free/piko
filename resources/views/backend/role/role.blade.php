@extends('layouts.admin')
@section('content')
@can('role_access')


<div class="row">
  <div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <h3>Role List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Role</th>
                    <th>Permisions</th>
                    <th>Action</th>
                </tr>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td class="text-wrap">
                        @foreach ($role->getAllPermissions() as $permission)
                          <span class="badge badge-primary my-1">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td><a class="btn btn-danger" href="{{ route('del.role', $role->id) }}">Delete</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h3>User List & Role</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td class="text-wrap">
                        @forelse ($user->getRoleNames() as $role)
                          <span class="badge badge-primary my-1">{{ $role }}</span>
                        @empty
                           Not Assigned
                        @endforelse
                    </td>
                    <td><a class="btn btn-danger" href="{{ route('remove.role', $user->id) }}">Removed Role</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
  </div>
  <div class="col-lg-3">
     {{-- <div class="card">
         <div class="card-header">
             <h3>Add New Permission</h3>
         </div>
         <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
             <form action="{{ route('permission.store') }}" method="POST">
                 @csrf
                    <div class="mb-3">
                      <label for="" class="form-label">Permission Name</label>
                     <input type="" name="permission_name" class="form-control">
                   </div>
                   <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add permission</button>
                  </div>
            </form>
        </div>
    </div> --}}
    <div class="card">
        <div class="card-header">
            <h3>Add New Roll</h3>
        </div>
        <div class="card-body">
            @if (session('role_success'))
                <div class="alert alert-success">{{ session('role_success') }}</div>
            @endif
            <form action="{{ route('add.role') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Role Name</label>
                    <input type="text" name="role_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Select Permissions</label>
                    <div class="form-group">
                        @foreach ($permissions as $permission)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="permission[]" value="{{ $permission->name }}" class="form-check-input">
                                 {{ $permission->name }}
                                <i class="input-frame"></i>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h3>Assign Role</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('role.assign') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <select name="user_id" class="form-control">
                        <option value="">Select User</option>
                          @foreach ($users as $user)
                           <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <select name="role_name" class="form-control">
                        <option value="">Select Role</option>
                          @foreach ($roles as $role)
                           <option value="{{ $role->name }}">{{ $role->name }}</option>
                          @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Assign Role</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@else
You Dont have to access this page
@endcan



@endsection
