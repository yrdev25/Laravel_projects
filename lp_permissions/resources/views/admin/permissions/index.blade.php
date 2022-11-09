@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Permission Dashboard') }}</div>

                <div class="card-body">
                    <div class="card-text">
                        <a class="btn btn-success bi bi-plus" href="{{ route('admin.permissions.create') }}">Add Permission</a>
                    </div>
                    <div class="tab">
                        <table class="table table-striped mt-3">
                          <tr>
                           <th>Id</th>
                           <th>Name</th>
                           <th>Guard</th>
                           <th>Edit</th>
                           <th>Update</th>  
                          </tr>
                          @isset($permissions)
                          @foreach($permissions as $permission)
                          <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.permissions.edit',$permission->id) }}">Edit</a></td>
                            <td><form action="{{ route('admin.permissions.destroy',$permission->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Delete</button></form></td>
                          </tr>
                           @endforeach
                           @endisset                        
                        </table>   
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>  