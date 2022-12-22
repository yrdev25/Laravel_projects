@extends('layouts.app')

@section('header')
Update Role
@endsection

@section('content')
<div class="container h-100">

    {{-- <div class="col-lg-12 col-xl-11">
      <div class="card text-black" style="border-radius: 25px;">
        <div class="card-body p-md-5">
          <div class="row">
            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1"> --}}

<div class="card-box">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <form action={{ route('admin.roles.update',$role->id) }}  method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @include('admin.roles.form')
                </form>
            </div>
            <!-- end row -->
        </div>
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

<div class="card ml-1">
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
            {{-- </div>
          </div>
        </div>
      </div>
    </div> --}}
</div>

@endsection
