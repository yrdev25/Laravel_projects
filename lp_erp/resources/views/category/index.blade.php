@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">
    @can('create_category')
        <div>
            <a href="{{ route('category.create') }}" class="btn btn-success float-right">Add Category</a>
        </div>
    @endcan
        <div class="col-md-12 card mt-2 mb-2">
            <div class="mt-2 px-2">
                <table class="table table-striped data-table">
                    <thead>
                        <tr>
                            <th>sr</th>
                            <th>category</th>
                            <th>sort order</th>
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
          ajax: "{{ route('category.index') }}",
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'category_name', name: 'category_name'},
            {data: 'sort_order', name: 'sort_order'},
            {data: 'action', name: 'action'},
          ]
      });
    });
</script>
@endsection
{{-- <tbody>
    <tr>
        <td>{{ $category->category_name }}</td>
        <td>{{ $category->sort_order }}</td>
        <td><a href="{{ route('category.status',[$category->id,$category->is_active]) }}">{{ ($category->is_active == 1) ? _('Active') : _('Inactive')}}</a></td>
        <td class="d-flex">
            @can('show_category')
            <a href="{{ route('category.show',$category->id) }}" class="btn btn-info ml-1"><i class="fa fa-eye"></i></a>
            @endcan
            @can('destroy_category')
            <form action="{{ route('category.destroy',$category->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger ml-1"><i class="fa fa-trash"></i></button></form>
            @endcan
            @can('edit_category')
            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-primary ml-1"><i class="fa fa-edit"></i></a>
            @endcan
        </td>
    </tr>
    <thead>
        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Sort Order</th>
            <th>Action</th>
         </tr>
     </thead>
</tbody> --}}
