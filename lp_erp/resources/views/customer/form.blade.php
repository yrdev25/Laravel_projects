{{--<div class="row">--}}
{{-- $customer --}}
    <div class="form-row">

        <div class="form-group col-md-6">
                <label for="category_id">Category*</label>
                <select class="form-control select2 select2-multiple @error('category_id') is-invalid @enderror" required name="category_id" id="category_id">
                    <option value="" >Select</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($customer) && $category->id == $customer->category_id ? 'selected' : ( old('category_id') == $category ? 'selected' : '') }}>{{ $category->category_name }}</option>
                    @empty
                        <option value="">No Data Found.</option>
                    @endforelse
                </select>
                @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="first_name_1">Firstname 1*</label>
            <input
                type="text" name="first_name_1"
                class="form-control @error('first_name_1') is-invalid @enderror"
                id="first_name_1" value="{{ isset($customer->first_name_1) ? $customer->first_name_1 : old('first_name_1') }}"
                placeholder="First Name 1" required
            >

            @error('first_name_1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="middle_name_1">Middlename 1*</label>
            <input
                type="text" name="middle_name_1"
                class="form-control @error('middle_name_1') is-invalid @enderror"
                id="middle_name_1" value="{{ isset($customer->middle_name_1) ? $customer->middle_name_1 : old('middle_name_1') }}"
                placeholder="Middle Name 1" required
            >

            @error('middle_name_1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="last_name_1">Lastname 1*</label>
            <input
                type="text" name="last_name_1"
                class="form-control @error('last_name_1') is-invalid @enderror"
                id="last_name_1" value="{{ isset($customer->last_name_1) ? $customer->last_name_1 : old('last_name_1') }}"
                placeholder="Last Name 1" required
            >

            @error('last_name_1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="first_name_2">Firstname 2*</label>
            <input
                type="text" name="first_name_2"
                class="form-control @error('first_name_2') is-invalid @enderror"
                id="first_name_2" value="{{ isset($customer->first_name_2) ? $customer->first_name_2 : old('first_name_2') }}"
                placeholder="First Name 2" required
            >

            @error('first_name_2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="middle_name_2">Middlename 2*</label>
            <input
                type="text" name="middle_name_2"
                class="form-control @error('middle_name_2') is-invalid @enderror"
                id="middle_name_2" value="{{ isset($customer->middle_name_2) ? $customer->middle_name_2 : old('middle_name_2') }}"
                placeholder="Middle Name 2" required
            >

            @error('middle_name_2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="last_name_2">Lastname 2*</label>
            <input
                type="text" name="last_name_2"
                class="form-control @error('last_name_2') is-invalid @enderror"
                id="last_name_2" value="{{ isset($customer->last_name_2) ? $customer->last_name_2 : old('last_name_2') }}"
                placeholder="Last Name 2" required
            >

            @error('last_name_2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="line_1">Line 1*</label>
            <input
                id="line_1" type="line_1"
                class="form-control @error('line_1') is-invalid @enderror"
                name="line_1" value="{{ isset($customer->line_1) ? $customer->line_1 : old('line_1') }}"
                autocomplete="line_1" placeholder="Line 1"
                required
            >

            @error('line_1')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="line_2">Line 2*</label>
            <input
                id="line_2" type="text"
                class="form-control @error('line_2') is-invalid @enderror"
                name="line_2" value="{{ isset($customer->line_2) ? $customer->line_2 : old('line_2') }}"
                autocomplete="line_2" placeholder="Line 2"
                required
            >

            @error('line_2')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="landmark">Landmark*</label>
            <input
                id="landmark" type="text"
                class="form-control @error('landmark') is-invalid @enderror"
                name="landmark" value="{{ isset($customer->landmark) ? $customer->landmark : old('landmark') }}"
                autocomplete="landmark" placeholder="Landmark"
                required
            >

            @error('landmark')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
                <label for="country_id">Country*</label>
                <select class="form-control select2 select2-multiple @error('country_id') is-invalid @enderror" required name="country_id" id="country_id">
                    <option value="" >Select</option>
                    @forelse($countries as $country)
                        <option value="{{ $country->id }}" {{ isset($customer) && $country->id == $customer->country_id ? 'selected' : ( old('country_id') == $country ? 'selected' : '') }}>{{ $country->country_name }}</option>
                    @empty
                        <option value="">No Data Found.</option>
                    @endforelse
                </select>
                @error('country_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group col-md-6">
                <label for="state_id">State*</label>
                <select class="form-control select2 select2-multiple @error('state_id') is-invalid @enderror" required name="state_id" id="state_id">
                    <option value="" >Select</option>
                    @forelse($states as $state)
                        <option value="{{ $state->id }}" {{ isset($customer) && $state->id == $customer->state_id ? 'selected' : ( old('state_id') == $state ? 'selected' : '') }}>{{ $state->state_name }}</option>
                    @empty
                        <option value="">No Data Found.</option>
                    @endforelse
                </select>
                @error('state_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group col-md-6">
                <label for="city_id">City*</label>
                <select class="form-control select2 select2-multiple @error('city_id') is-invalid @enderror" required name="city_id" id="city_id">
                    <option value="" >Select</option>
                    @forelse($cities as $city)
                        <option value="{{ $city->id }}" {{ isset($customer) && $city->id == $customer->city_id ? 'selected' : ( old('city_id') == $city ? 'selected' : '') }}>{{ $city->city_name }}</option>
                    @empty
                        <option value="">No Data Found.</option>
                    @endforelse
                </select>
                @error('city_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

          <div class="form-group col-md-6">
                <label for="area_id">Area*</label>
                <select class="form-control select2 select2-multiple @error('area_id') is-invalid @enderror" required name="area_id" id="area_id">
                    <option value="" >Select</option>
                    @forelse($areas as $area)
                        <option value="{{ $area->id }}" {{ isset($customer) && $area->id == $customer->area_id ? 'selected' : ( old('area_id') == $area ? 'selected' : '') }}>{{ $area->area_name }}</option>
                    @empty
                        <option value="">No Data Found.</option>
                    @endforelse
                </select>
                @error('area_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="pincode">Pincode*</label>
            <input
                id="pincode" type="text"
                class="form-control @error('pincode') is-invalid @enderror"
                name="pincode" value="{{ isset($customer->pincode) ? $customer->pincode : old('pincode') }}"
                autocomplete="pincode" placeholder="Pincode"
                required
            >

            @error('pincode')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="mobile_1">Mobile 1*</label>
            <input
                id="mobile_1" type="text"
                class="form-control @error('mobile_1') is-invalid @enderror"
                name="mobile_1" value="{{ isset($customer->mobile_1) ? $customer->mobile_1 : old('mobile_1') }}"
                autocomplete="mobile_1" placeholder="mobile_1"
                required
            >

            @error('mobile_1')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="mobile_2">Mobile 2*</label>
            <input
                id="mobile_2" type="text"
                class="form-control @error('mobile_2') is-invalid @enderror"
                name="mobile_2" value="{{ isset($customer->mobile_2) ? $customer->mobile_2 : old('mobile_2') }}"
                autocomplete="mobile_2" placeholder="Mobile 2"
                required
            >

            @error('mobile_2')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="res_no">Residence Number*</label>
            <input
                id="res_no" type="text"
                class="form-control @error('res_no') is-invalid @enderror"
                name="res_no" value="{{ isset($customer->res_no) ? $customer->res_no : old('res_no') }}"
                autocomplete="res_no" placeholder="Residence Number"
                required
            >

            @error('res_no')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="office_no">Office Number*</label>
            <input
                id="office_no" type="text"
                class="form-control @error('office_no') is-invalid @enderror"
                name="office_no" value="{{ isset($customer->office_no) ? $customer->office_no : old('office_no') }}"
                autocomplete="office_no" placeholder="Office Number"
                required
            >

            @error('office_no')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email*</label>
            <input
                id="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ isset($customer->email) ? $customer->email : old('email') }}"
                autocomplete="email" placeholder="Email"
                required
            >

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="dob">Date Of Birth</label>
            <input
                id="dob" type="text"
                class="form-control @error('dob') is-invalid @enderror"
                name="dob" value="{{ isset($customer->dob) ? $customer->dob : old('dob') }}"
                autocomplete="dob"
                required
            >

            @error('dob')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="marriage_anniversary">Marriage Anniversary</label>
            <input
                id="marriage_anniversary" type="text"
                class="form-control @error('marriage_anniversary') is-invalid @enderror"
                name="marriage_anniversary" value="{{ isset($customer->marriage_anniversary) ? $customer->marriage_anniversary : old('marriage_anniversary') }}"
                autocomplete="marriage_anniversary"
                required
            >

            @error('marriage_anniversary')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="like">Like*</label>
              <textarea name="like" class="form-control">{{ isset($customer) ? $customer->like : '' }}</textarea>
            @error('like')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="remarks">Dislike*</label>
              <textarea name="dislike" class="form-control">{{ isset($customer) ? $customer->dislike : '' }}</textarea>
            @error('dislike')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="remarks">Remarks*</label>
              <textarea name="remarks" class="form-control">{{ isset($customer) ? $customer->remarks : '' }}</textarea>
            @error('remarks')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    {{--</div>--}}


    <div class="form-group">
        <button class="btn btn-danger waves-light mr-1" type="submit">
            Submit
        </button>
    </div>

    @section('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
      $(document).ready(function(){
        $( "#dob" ).datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
              $("#marriage_anniversary").datepicker("option","minDate", selected)
            }
    });
        $( "#marriage_anniversary" ).datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
               $("#dob").datepicker("option","maxDate", selected)
            }
    });
      });
    </script>
    @endsection
