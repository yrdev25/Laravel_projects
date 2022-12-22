@extends('layouts.app')

@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')


                    <div class="card-box">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <form action="{{ route('customer.update',$customer->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        @include('customer.form')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



@endsection
