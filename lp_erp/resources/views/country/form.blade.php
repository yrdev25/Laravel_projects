{{--<div class="row">--}}

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="country_name">Country Name*</label>
            <input
                type="text" name="country_name"
                class="form-control @error('country_name') is-invalid @enderror"
                id="country_name" value="{{ isset($country) ? $country->country_name : old('country_name') }}"
                placeholder="Country Name" required
            >

            @error('country_name')
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



