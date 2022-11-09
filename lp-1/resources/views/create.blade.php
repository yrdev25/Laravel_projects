<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">

  <a class="btn btn-success" href="{{ route('user.index') }}">See Users</a>

  <form action="{{ isset($userdata) ? route('user.update',$userdata->id) : route('user.store') }}" method="post">
    @csrf
    @isset($userdata)
    @method('PUT')
    @endisset
      <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="name" class="form-control" id="name" placeholder="Enter name" value="{{ isset($userdata) ? $userdata->name : "" }}" name="name">
      </div>
      <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ isset($userdata) ? $userdata->email : "" }}">
      </div>
      <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="{{ isset($userdata) ? $userdata->password : "" }}">
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>

</body>
</html>
