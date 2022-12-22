@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">
    @can('create_user')
    <div>
        <a href="{{ route('user.create') }}" class="btn btn-success float-right">Add User</a>
    </div>
    @endcan

    <div class="col-md-12 card mt-2 mb-2">
        <div class="mt-2 px-2">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>sr</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>email</th>
                        <th>username</th>
                        <th>role</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('user.index') }}",
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'fname', name: 'fname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'username', name: 'username'},
            {data: 'role', name: 'role'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
          ]
      });
    });
</script>
@endsection
