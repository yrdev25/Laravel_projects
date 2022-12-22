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
                        <th>Category</th>
                        <td>{{ isset($customer) ? $customer->category->category_name : '' }}</td>
                    </tr>
                    <tr>
                        <th>First Name 1</th>
                        <td>{{ isset($customer) ? $customer->first_name_1 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Middle Name 1</th>
                        <td>{{ isset($customer) ? $customer->middle_name_1 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Last Name 1</th>
                        <td>{{ isset($customer) ? $customer->last_name_1 : '' }}</td>
                    </tr>
                    <tr>
                        <th>First Name 2</th>
                        <td>{{ isset($customer) ? $customer->first_name_2 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Middle Name 2</th>
                        <td>{{ isset($customer) ? $customer->middle_name_2 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Last Name 2</th>
                        <td>{{ isset($customer) ? $customer->last_name_2 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Line 1</th>
                        <td>{{ isset($customer) ? $customer->line_1 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Line 2</th>
                        <td>{{ isset($customer) ? $customer->line_2 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Landmark</th>
                        <td>{{ isset($customer) ? $customer->landmark : '' }}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{ isset($customer) ? $customer->country->country_name : '' }}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{ isset($customer) ? $customer->state->state_name : '' }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ isset($customer) ? $customer->city->city_name : '' }}</td>
                    </tr>
                    <tr>
                        <th>Area</th>
                        <td>{{ isset($customer) ? $customer->area->area_name : '' }}</td>
                    </tr>
                    <tr>
                        <th>Pincode</th>
                        <td>{{ isset($customer) ? $customer->pincode : '' }}</td>
                    </tr>
                    <tr>
                        <th>Mobile 1</th>
                        <td>{{ isset($customer) ? $customer->mobile_1 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Mobile 2</th>
                        <td>{{ isset($customer) ? $customer->mobile_2 : '' }}</td>
                    </tr>
                    <tr>
                        <th>Residence Number</th>
                        <td>{{ isset($customer) ? $customer->res_no : '' }}</td>
                    </tr>
                    <tr>
                        <th>Office Number</th>
                        <td>{{ isset($customer) ? $customer->office_no : '' }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{{ isset($customer) ? $customer->email : '' }}</td>
                    </tr>
                    <tr>
                        <th>Dob</th>
                        <td>{{ isset($customer) ? $customer->dob->toDateString() : '' }}</td>
                    </tr>
                    <tr>
                        <th>Marriage Anniversary</th>
                        <td>{{ isset($customer) ? $customer->marriage_anniversary->toDateString() : '' }}</td>
                    </tr>
                    <tr>
                        <th>Like</th>
                        <td>{{ isset($customer) ? $customer->like : '' }}</td>
                    </tr>
                    <tr>
                        <th>Disike</th>
                        <td>{{ isset($customer) ? $customer->dislike : '' }}</td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td>{{ isset($customer) ? $customer->remarks : '' }}</td>
                    </tr>
                </table>

        </div>
    </div>
</div>


@endsection





