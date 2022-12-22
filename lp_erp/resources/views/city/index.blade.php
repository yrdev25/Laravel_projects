@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">

     <div class="d-flex align-items-end justify-content-end">
        <div class="form-group col-md-3 d-inline-flex">
            <label class="pt-1" for="select_city">City:</label>
            <select class="form-control ml-1" id="select_city">
                <option value="">Please Select</option>
                @foreach (App\Models\City::all() as $city)
                <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-3 d-inline-flex">
            <label class="pt-1" for="select_state">State:</label>
            <select class="form-control ml-1" id="select_state">
                <option value="">Please Select</option>
                @foreach (App\Models\State::all() as $state)
                <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                @endforeach
            </select>
        </div>

        @can('create_city')
        <div class="form-group mt-auto">
            <a href="{{ route('city.create') }}" class="btn btn-success">Add city</a>
        </div>
        @endcan
    </div>

    <div class="col-md-12 card mt-2 mb-2">
        <div class="mt-2 px-2">
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>city</th>
                        <th>state</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
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
          ajax: { url : "{{ route('city.index') }}",
                  data:function(d){
                    d.city = $('#select_city').val();
                    d.state = $('#select_state').val();
                  }
                } ,
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'state_name', name: 'state_name'},
            {data: 'city_name', name: 'city_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
          ]
      });
      $('#select_city').change(function(){
          table.draw();
    });
      $('#select_state').change(function(){
          table.draw();
    });
    });
</script>
@endsection

