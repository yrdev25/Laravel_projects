@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-md-5">

                    <table class="table">
                        <tr><th>State Name</th><td>{{ isset($state) ? $state->state_name : '' }}</td></tr>
                        <tr><th>Country Name</th><td>{{ isset($state) ? $state->country->country_name : '' }}</td></tr>
                        <tr><th>Status</th><td>{{ ($state->is_active == 1) ? 'Active' : 'Inactive' }}</td></tr>
                    </table>

    </div>
    </div>
</div>
@endsection

