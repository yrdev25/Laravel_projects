@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    @if(Auth::user()->can('create_hr') || Auth::user()->can('create_employee'))
                    <div class="card-text">
                        <a class="btn btn-success bi bi-plus" href="{{ route('create') }}">Add User</a>
                    </div>
                    @endif

                    <div class="tab">
                       
                        <table class="table table-striped mt-3">
                          <tr>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Role</th>  
                          </tr>
                          @isset($users)
                          @foreach($users as $user)
                          <tr>
                            @if(Auth::user()->can('create_hr') && Auth::user()->can('create_employee'))
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->name }}</td>
                            @elseif(Auth::user()->can('create_employee'))
                                @if($user->roles[0]->name == 'employee')
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->name }}</td>
                                @endif
                            @endif                          
                           </tr>
                           @endforeach
                           @endisset                        
                        </table>   
                    </div>

   
                    @if(Auth::user()->can('create_hr') && Auth::user()->can('create_employee'))
                    <div class="card-text">
                        <a class="btn btn-info bi bi-plus" href="{{ route('importform') }}">Import Users</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
