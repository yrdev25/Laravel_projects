@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Role Dashboard') }}</div>

                <div class="card-body">
                    <div class="card-text">
                        <a class="btn btn-success bi bi-plus" href="{{ route('admin.roles.create') }}">Add Role</a>
                    </div>
                    <div class="tab">
                        <table class="table table-striped mt-3">
                          <tr>
                           <th>Id</th>
                           <th>Name</th>
                           <th>Guard</th> 
                           <th>Edit</th>
                           <th>Delete</th> 
                          </tr>
                          @isset($roles)
                          @foreach($roles as $role)
                          <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.roles.edit',$role->id) }}">Edit</a></td>
                            <td><form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Delete</button></form></td>
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