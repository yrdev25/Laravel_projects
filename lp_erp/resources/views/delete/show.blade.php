@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="col-md-5">


        <table class="table">
            <tr><th>Delete Reason</th><td>{{ isset($delete) ? $delete->delete_reason_name : '' }}</td></tr>
            <tr><th>Sort Order</th><td>{{ isset($delete) ? $delete->sort_order : '' }}</td></tr>
            <tr><th>Status</th><td>{{ ($delete->is_active == 1) ? 'Active' : 'Inactive' }}</td></tr>
        </table>

        </div>
    </div>
</div>
@endsection




