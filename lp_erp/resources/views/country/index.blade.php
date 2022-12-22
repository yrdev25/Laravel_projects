@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">

    @can('create_country')
    <div>
        <a href="{{ route('country.create') }}" class="btn btn-success float-right">Add Country</a>
    </div>
    @endcan

    <div class="col-md-12 card mt-2 mb-2">
        <div class="mt-2 px-2">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>country</th>
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
          ajax: "{{ route('country.index') }}",
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'country_name', name: 'country_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
          ]
      });
    });
</script>
@endsection
