@extends('layouts.app')

@section('header')
Dashboard
@endsection

@section('content')
      <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>id</th>
                <th>fname</th>
                <th>lname</th>
                <th>dob</th>
                <th>age</th>
                <th>email</th>
                <th>number</th>
                <th>image</th>
                <th>password</th>
                <th>address</th>
                <th>zipcode</th>
                <th>country</th>
                <th>state</th>
                <th>city</th>
                <th>update</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
            <td>{{ $user->user->id }}</td>
            <td>{{ $user->user->fname }}</td>
            <td>{{ $user->user->lname }}</td>
            <td>{{ $user->user->dob }}</td>
            <td>{{ $user->user->age }}</td>
            <td>{{ $user->user->email }}</td>
            <td>{{ $user->user->number }}</td>
            <td><img style="width : 50px; height : 50px;" src="{{ $user->user->image }}"/></td>
            <td>{{ $user->user->password }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->zipcode }}</td>
            <td>{{ $user->country->name }}</td>
            <td>{{ $user->state->name }}</td>
            <td>{{ $user->city->name }}</td>
            <td><a class="btn btn-primary" href="{{ route('user.edit',$user->user->id) }}">Edit</a></td>
            <td><form method="post" action="{{ route('user.destroy',$user->user->id) }}">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger">
              Delete</button></form></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <script type="text/javascript">
        $(document).ready(function() {
             $('.data-table').DataTable();
         });
      </script>
@endsection('content')

