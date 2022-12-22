{{--<div class="row">--}}

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="state_name">State Name*</label>
            <input
                type="text" name="state_name"
                class="form-control @error('state_name') is-invalid @enderror"
                id="state_name" value="{{ isset($state) ? $state->state_name : old('state_name') }}"
                placeholder="State Name" required
            >

            @error('state_name')
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
            <!--         <option value="{{ $country->id }}">{{ $country->country_name }}</option> -->
                    <option value="{{ $country->id }}" {{ isset($state) && $country->id == $state->country_id ? 'selected' : ( old('country_id') == $country ? 'selected' : '') }}>{{ $country->country_name }}</option>
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

    </div>

    {{--</div>--}}


    <div class="form-group">
        <button class="btn btn-danger waves-light mr-1" type="submit">
            Submit
        </button>
    </div>



