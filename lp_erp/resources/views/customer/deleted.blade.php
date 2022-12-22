@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop
@section('content')
<div class="row">

    <div class="d-flex align-items-end justify-content-end">

        <div class="form-group col-md-3 d-inline-flex">
            <label class="pt-1" for="select_category mt">Category:</label>
            <select class="form-control ml-1" id="select_category">
                <option value="">Please Select</option>
                @foreach (App\Models\Category::all() as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        @can('create_customer')
            <div class="form-group mt-auto">
                <a href="{{ route('customer.create') }}" class="btn btn-success float-right">Add customer</a>
            </div>
        @endcan

    </div>

    <table class="table table-striped" id="data-table"  cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>sr</th>
                <th>name 1</th>
                <th>name 2</th>
                <th>mobile 1</th>
                <th>email</th>
                <th>category</th>
                <th>add</th>
                <th>verify</th>
                <th>action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
          ajax: { url : "{{ route('deleted') }}",
                  data:function(d){
                    d.category = $('#select_category').val();
                  }
                } ,
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name_1', name: 'name_1'},
            {data: 'name_2', name: 'name_2'},
            {data: 'mobile_1', name: 'mobile_1'},
            {data: 'email', name: 'email'},
            {data: 'category_name', name: 'category_name'},
            {data: 'add', name: 'add'},
            {data: 'is_verified', name: 'is_verified'},
            {data: 'action', name: 'action'},
          ]
      });
      $('#select_category').change(function(){
          table.draw();
    });
    });
</script>
@endsection


