@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-md-5">

                <table class="table">
                    <tr><th>Country Name</th><td>{{ isset($country) ? $country->country_name : '' }}</td></tr>
                    <tr><th>Status</th><td>{{ ($country->is_active == 1) ? 'Active' : 'Inactive' }}</td></tr>
                </table>

    </div>
    </div>
</div>

@endsection

