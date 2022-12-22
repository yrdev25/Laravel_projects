@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-md-5">

                    <table class="table">
                        <tr><th>Area Name</th><td>{{ isset($area) ? $area->area_name : '' }}</td></tr>
                        <tr><th>City Name</th><td>{{ isset($area) ? $area->city->city_name : '' }}</td></tr>
                        <tr><th>Status</th><td>{{ ($area->is_active == 1) ? 'Active' : 'Inactive' }}</td></tr>
                    </table>

        </div>
    </div>
</div>
@endsection

