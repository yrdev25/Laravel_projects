@extends('layouts.app')

@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')


                    <div class="card-box">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <form action="{{ route('permissions.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        @include('permissions.form')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



@endsection
