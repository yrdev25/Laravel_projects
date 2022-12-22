@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">
    @can('create_delete')
    <div>
        <a href="{{ route('delete.create') }}" class="btn btn-success float-right">Add Delete</a>
    </div>
    @endcan
        <div class="col-md-12 card mt-2 mb-2">
            <div class="mt-2 px-2">
                <table class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>sr</th>
                                <th>reason</th>
                                <th>sort order</th>
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
          ajax: "{{ route('delete.index') }}",
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'delete_reason_name', name: 'delete_reason_name'},
            {data: 'sort_order', name: 'sort_order'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'}
          ]
      });
    });
</script>
@endsection
