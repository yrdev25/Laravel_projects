@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-md-5">

                    <table class="table">
                        <tr><th>City Name</th><td>{{ isset($city) ? $city->city_name : '' }}</td></tr>
                        <tr><th>State Name</th><td>{{ isset($city) ? $city->state->state_name : '' }}</td></tr>
                        <tr><th>Status</th><td>{{ ($city->is_active == 1) ? 'Active' : 'Inactive' }}</td></tr>
                    </table>

    </div>
    </div>
</div>
@endsection

