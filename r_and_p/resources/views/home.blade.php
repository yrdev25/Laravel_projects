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

             

                    @can('add_hr')
                    <div>
                    <a href={{ route('admin.create') }} name="create" class="btn btn-primary mt-3">Create HR/Employee</a>     
                    </div>

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
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if($user->role_id == '2')
                            <td>Hr</td>
                            @else
                            <td>Employee</td>
                            @endif  
                           </tr>
                           @endforeach
                           @endisset                        
                        </table>   
                    </div>
                    @endcan

                    @can('add_employee')
                    <div>
                    <a href={{ route('hr.create') }} name="employee_create" class="btn btn-primary">Create Employee</a>    
                    </div>
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
                            <td>{{ $user->roles['0']->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if($user->role_id == '2')
                            <td>Hr</td>
                            @else
                            <td>Employee</td>
                            @endif    
                           </tr>
                           @endforeach
                           @endisset                        
                        </table>   
                    </div>
                    @endcan

                    @role('employee')
                      <h3>You are an employee!</h3>
                    @endrole

                 
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
