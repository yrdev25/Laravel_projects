@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-md-5">

                    <table class="table">
                        <tr>
                            <th>Firstname</th>
                            <td>{{ isset($user) ? $user->fname : '' }}</td>
                        </tr>
                        <tr>
                            <th>Lastname</th>
                            <td>{{ isset($user) ? $user->lname : '' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ isset($user) ? $user->email : '' }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ isset($user) ? $user->username : '' }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ isset($user) ? $user->role->name : '' }}</td>
                        </tr>
                    </table>

        </div>
    </div>
</div>

@endsection

