@extends('layouts.app')
@section('title')
    {{$breadcrumb['page_title']}}
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-md-5">

                    <table class="table">

                        <tr>
                          <th>Category Name</th>
                          <td>{{ isset($category) ? $category->category_name : '' }}</td>
                        </tr>


                        <tr>
                          <th>Sort Order</th>
                          <td>{{ isset($category) ? $category->sort_order : '' }}</td>
                        </tr>

                    </table>
        </div>
    </div>
</div>

@endsection

