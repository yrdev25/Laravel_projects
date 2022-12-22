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

    <div class="col-md-12 card mt-2 mb-2" >
        <div class="mt-2 px-2 ">
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>sr</th>
                        <th>name 1</th>
                        <th>name 2</th>
                        <th>mobile 1</th>
                        <th>email</th>
                        <th>category</th>
                        <th>verify</th>
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
          ajax: {
            url : "{{ route('customer.index') }}",
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
{{-- <tr>
    <td>{{ $customer->category->category_name }}</td>
    <td>{{ $customer->first_name_1 }}</td>
    <td>{{ $customer->middle_name_1 }}</td>
    <td>{{ $customer->last_name_1 }}</td>
    <td>{{ $customer->first_name_2 }}</td>
    <td>{{ $customer->middle_name_2 }}</td>
    <td>{{ $customer->last_name_2 }}</td>
    <td>{{ $customer->line_1 }}</td>
    <td>{{ $customer->line_2 }}</td>
    <td>{{ $customer->landmark }}</td>
    <td>{{ $customer->country->country_name }}</td>
    <td>{{ $customer->state->state_name }}</td>
    <td>{{ $customer->city->city_name }}</td>
    <td>{{ $customer->area->area_name }}</td>
    <td>{{ $customer->pincode }}</td>
    <td>{{ $customer->mobile_1 }}</td>
    <td>{{ $customer->mobile_2 }}</td>
    <td>{{ $customer->res_no }}</td>
    <td>{{ $customer->office_no }}</td>
    <td>{{ $customer->email }}</td>
    <td>{{ $customer->dob->toDateString() }}</td>
    <td>{{ $customer->marriage_anniversary->toDateString() }}</td>
    <td>{{ $customer->like }}</td>
    <td>{{ $customer->dislike }}</td>
    <td><a href="{{ route('customer.verify',[$customer->id,$customer->is_verified]) }}">@if($customer->is_verified == 1)<i class="fa fa-check"></i>@else<i class="fa fa-times"></i>@endif</a></td>
    <td>{{ $customer->remarks }}</td>
    {{--<i class="bi bi-eye"></i> <td><form action="{{ route('customer.softdeletes',$customer->id) }}" method="POST">@csrf<button type="submit" class="btn btn-warning">Softdelete</button></form></td> --}}
    {{-- <td class="d-flex">
        @can('show_customer')
        <a href="{{ route('customer.show',$customer->id) }}" class="btn btn-info ml-1"><i class="fa fa-eye"></i></a>
        @endcan
        @can('destroy_customer')
        <form action="{{ route('customer.destroy',$customer->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger ml-1"><i class="fa fa-trash"></i></button></form>
        @endcan
        @can('edit_customer')
        <a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-primary ml-1"><i class="fa fa-edit"></i></a>
        @endcan
    </td>
</tr> --}}
