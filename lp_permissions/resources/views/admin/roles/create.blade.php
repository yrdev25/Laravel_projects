@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($role) ? __('Update Role') : __('Add Role') }}</div>

                <div class="card-body">
                   <form action={{ isset($role) ? route('admin.roles.update',$role->id) : route('admin.roles.store') }} method="POST">
                        @csrf
                        @isset($role)
                        @method('PUT')
                        @endisset
                        <div class="card-text">
                        <label for="name">Define Role:</label>
                        <input class="form-control" type="text" name="name" value="{{ isset($role) ? $role->name : '' }}">
                        </div>
                        <span class="text text-danger">@error('name') {{ $message }} @enderror</span>

                        <div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>

                    </form>                   
                </div>
            </div>

            @isset($role)

            <div class="card">
                <div class="card-header">Has Permissions</div>
            @if($role->permissions)
            <table class="table table-striped">
                <tr>
                    <th>Permission</th>
                    <th>Delete</th>
                </tr>    
        
                @foreach($role->permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td><form action="{{ route('admin.roles.permissions.revoke',[$role->id,$permission->id]) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Delete</button></form></td>

                </tr> 
                @endforeach
            </table>
            @endif
            </div>

            <div class="card">
                @isset($message)
                    {{ $message }}
                @endisset
                <div class="card-header">{{ __('Permissions') }}</div>
                <div class="card-body">
                   <form action={{ route('admin.roles.permission',$role->id) }} method="POST">
                        @csrf
                        <div class="card-text">

                        <label for="name">Define Permission:</label>
                        <select class="form-control" name="permission">
                        @foreach($permissions as $permission)    
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                        </select> 

                        </div>
                        <span class="text text-danger">@error('name') {{ $message }} @enderror</span>

                        <div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>

                    </form>                   
                </div>
            </div>
            @endisset



        </div>
    </div>
</div>
@endsection
