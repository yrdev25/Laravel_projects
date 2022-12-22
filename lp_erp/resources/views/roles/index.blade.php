@extends('layouts.app')

@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">

     @can('create_role')
    <div>
     <a class="btn btn-success bi bi-plus float-right" href="{{ route('roles.create') }}">Add Role</a>
    </div>
     @endcan

    <div class="col-md-12 card mt-2 mb-2">
        <div class="mt-2 px-2">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>sr</th>
                        <th>name</th>
                        <th>guard</th>
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
      var table = $('table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('roles.index') }}",
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name', name: 'name'},
            {data: 'guard_name', name: 'guard_name'},
            {data: 'action', name: 'action'},
          ]
      });
    });
</script>
@endsection
