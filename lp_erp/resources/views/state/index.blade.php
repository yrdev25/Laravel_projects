@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">

    <div class="d-flex align-items-end justify-content-end">
        <div class="form-group col-md-3 d-inline-flex">
            <label class="pt-1" for="select_state">State:</label>
            <select class="form-control ml-1" id="select_state">
                <option value="">Please Select</option>
                @foreach (App\Models\State::all() as $state)
                <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3 d-inline-flex">
            <label class="pt-1" for="select_country">Country:</label>
            <select class="form-control ml-1" id="select_country">
                <option value="">Please Select</option>
                @foreach (App\Models\Country::all() as $country)
                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                @endforeach
            </select>
        </div>

        @can('create_state')
            <div class="form-group mt-auto">
                <a href="{{ route('state.create') }}" class="btn btn-success float-right">Add state</a>
            </div>
        @endcan
    </div>

    <div class="col-md-12 card mt-2 mb-2">
        <div class="mt-2 px-2">
            <table class="table table-striped" id="data-table">
                <thead>
                <tr>
                    <th>sr</th>
                    <th>country</th>
                    <th>state</th>
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
      var table = $('#data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: { url : "{{ route('state.index') }}",
                  data:function(d){
                    d.state = $('#select_state').val();
                    d.country = $('#select_country').val();
                  }
                } ,
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'country_name', name: 'country_name'},
            {data: 'state_name', name: 'state_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
          ]
      });
    $('#select_state').change(function(){
          table.draw();
    });
    $('#select_country').change(function(){
          table.draw();
    });
    });
</script>
    @endsection
