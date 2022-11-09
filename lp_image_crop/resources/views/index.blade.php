<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
        </tr>
        @isset($users)
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><img src="{{ $user->image }}" /></td>
        </tr>
        @endforeach
        @endisset
    </table>    
</body>
</html>