@extends('layouts.app')

@section('style')
<style>
    .custom-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: end;
}
.form-group:not(:last-child) {
    width: 18%;
}
.form-group{
    padding:0px 8px;
}
</style>
@endsection
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">

    <div class="custom-group">

        <div class="form-group ">
            <label for="select_category" class="pt-1">Category:</label>
            <select class="form-control" id="select_category">
                <option value="">Please Select</option>
                @foreach (App\Models\Category::all() as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group ">
            <label for="select_country" class="pt-1">Country:</label>
            <select class="form-control" id="select_country">
                <option value="">Please Select</option>
                @foreach (App\Models\Country::all() as $country)
                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group ">
            <label class="pt-1" for="select_state">State:</label>
            <select class="form-control" id="select_state">
                    <option value="">Please Select</option>
                    @foreach (App\Models\State::all() as $state)
                    <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                    @endforeach
            </select>
        </div>

        <div class="form-group ">
            <label class="pt-1" for="select_state">City:</label>
            <select class="form-control" id="select_city">
                <option value="">Please Select</option>
                @foreach (App\Models\City::all() as $city)
                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group ">
            <label class="pt-1" for="select_area">Area:</label>
            <select class="form-control" id="select_area">
                <option value="">Please Select</option>
                @foreach (App\Models\Area::all() as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
            </div>
            @can('create_customer')
            <div class="form-group mt-auto">
                <a href="{{ route('customer.create') }}" class="btn btn-success">Add city</a>
            </div>
            @endcan

    </div>

    {{-- <div class="d-flex align-items-end justify-content-end">


    </div> --}}
    <div class="col-md-12 card mt-2 mb-2">
        <div class="mt-2 px-2">
            <table class="table table-striped table-responsive" id="data-table" width="100%">
                <thead>
                    <tr>
                        <th>sr</th>
                        <th>name 1</th>
                        <th>name 2</th>
                        <th>mobile 1</th>
                        <th>email</th>
                        <th>category</th>
                        <th>country</th>
                        <th>state</th>
                        <th>city</th>
                        <th>area</th>
                        <th>verify</th>
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
          ajax: { url : "{{ route('city_area') }}",
                  data:function(d){
                    d.category = $('#select_category').val();
                    d.country = $('#select_country').val();
                    d.state = $('#select_state').val();
                    d.city = $('#select_city').val();
                    d.area = $('#select_area').val();
                  }
                } ,
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name_1', name: 'name_1'},
            {data: 'name_2', name: 'name_2'},
            {data: 'mobile_1', name: 'mobile_1'},
            {data: 'email', name: 'email'},
            {data: 'category_name', name: 'category_name'},
            {data: 'country_name', name: 'country_name'},
            {data: 'state_name', name: 'state_name'},
            {data: 'city_name', name: 'city_name'},
            {data: 'area_name', name: 'area_name'},
            {data: 'is_verified', name: 'is_verified'},
            {data: 'action', name: 'action'},
          ]
      });
      $('#select_category').change(function(){
          table.draw();
    });
    $('#select_country').change(function(){
          table.draw();
    });
      $('#select_state').change(function(){
          table.draw();
    });
      $('#select_city').change(function(){
          table.draw();
    });
      $('#select_area').change(function(){
          table.draw();
    });
    });
</script>

@endsection


