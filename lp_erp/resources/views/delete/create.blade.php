@extends('layouts.app')

@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')


                    <div class="card-box">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <form action="{{ route('delete.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        @include('delete.form')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


@endsection
