<!DOCTYPE html>
<html lang="en">
<head>
  <title>User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    table{
      text-align : center;
    }
  </style>
</head>
<body>

<div class="container mt-3">

    <a class="btn btn-warning" href="{{ route('user.create') }}">Create User</a>
          
    <table class="table table-striped table-bordered mt-3">
      <thead>
        <tr>
          <th>Sr no.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @php
         $i = 1;   
        @endphp
        @foreach($usersarr as $user)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->password }}</td>
              <td>
                <a class="btn btn-info" href="{{ route('user.edit',$user->id) }}">Update</a>
              </td>
              <td>
              <form action="{{ route('user.destroy',$user->id) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button> 
              </form>
              </td>
            </tr>
            @php
            $i++
            @endphp 
        @endforeach
      </tbody>
    </table>
  </div>
  
  </body>
  </html>
  