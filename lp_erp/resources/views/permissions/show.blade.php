@extends('layouts.app')

@section('title')
    {{$breadcrumb['page_title']}}
@stop


@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $permission->name }}
        </div>
    </div>
</div>
@endsection

