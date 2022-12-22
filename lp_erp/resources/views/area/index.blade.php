@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">

    <div class="d-flex align-items-end justify-content-end">

        <div class="form-group col-md-3 d-inline-flex">
            <label class="pt-1" for="select_area">Area:</label>
            <select class="form-control ml-1" id="select_area">
                <option value="">Please Select</option>
                @foreach (App\Models\Area::all() as $area)
                <option value="{{ $area->area_name }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3 d-inline-flex">
        <label class="pt-1" for="select_city">City:</label>
        <select class="form-control ml-1" id="select_city">
            <option value="">Please Select</option>
            @foreach (App\Models\City::all() as $city)
            <option value="{{ $city->id }}">{{ $city->city_name }}</option>
            @endforeach
        </select>
        </div>


        @can('create_area')
        <div class="form-group mt-auto">
            <a href="{{ route('area.create') }}" class="btn btn-success float-right">Add area</a>
        </div>
        @endcan

    </div>

    <div class="col-md-12 card mt-2 mb-2">
        <div class="mt-2 px-2">

            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>sr</th>
                        <th>city</th>
                        <th>area</th>
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
          ajax: { url : "{{ route('area.index') }}",
                  data:function(d){
                    d.area = $('#select_area').val();
                    d.city = $('#select_city').val();
                  }
                } ,
          columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'city_name', name: 'city_name'},
            {data: 'area_name', name: 'area_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
          ]
      });
      $('#select_area').change(function(){
          table.draw();
    });
      $('#select_city').change(function(){
          table.draw();
    });
    });
</script>

@endsection
{{-- @isset($areas)
@foreach($areas as $area)
      <tr>
          <td>{{ $area->area_name }}</td>
          <td>{{ $area->city->city_name }}</td>
          <td><a href="{{ route('area.status',[$area->id,$area->is_active]) }}">{{ ($area->is_active == 1) ? _('Active') : _('Inactive')}}</a></td>
          {{-- <td><form action="{{ route('area.softdeletes',$area->id) }}" method="POST">@csrf<button type="submit" class="btn btn-warning">Softdelete</button></form></td> --}}
          {{-- <td class="d-flex">
              @can('show_area')
              <a href="{{ route('area.show',$area->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
              @endcan
              @can('destroy_area')
              <form action="{{ route('area.destroy',$area->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger ml-1"><i class="fa fa-trash"></i></button></form>
              @endcan
              @can('edit_area')
              <a href="{{ route('area.edit',$area->id) }}" class="btn btn-primary ml-1"><i class="fa fa-edit"></i></a>
              @endcan
          </td>
      </tr>
@endforeach
@endisset --}}
{{-- ->addColumn('action', function($row){
    $authUserObj = Auth::user();
    $isActionshow = false;
    $isActionedit = false;
    $isActiondelete = false;

    if ($authUserObj->can('show_area')) {
        $isActionshow = 'show';
    }
    if ($authUserObj->can('edit_area')) {
        $isActionedit = 'edit';
    }
    if ($authUserObj->can('destroy_area')) {
        $isActiondelete = 'destroy';
    }
    $btn = ``;
    if ($isActionedit == 'show') {
    $btn .= `<a href="`.url('area/'.$row->id).`" class="btn btn-info"><i class="fa fa-eye"></i></a>`;
    }
    if ($isActionedit == 'edit') {
        $btn .= `<a href="`.url('area/'.$row->id.'/edit').`" class="btn btn-info"><i class="fa fa-eye"></i></a>`;
    }
    if ($isActionedit == 'delete') {
        $btn .= `<a href="javascript:;" class="btn btn-info"><i class="fa fa-eye"></i></a>`;
    }
    return $btn;
})
->rawColumns(['action']) --}}
