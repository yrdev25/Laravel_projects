{{--<div class="row">--}}

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="city_name">City Name*</label>
            <input
                type="text" name="city_name"
                class="form-control @error('city_name') is-invalid @enderror"
                id="city_name" value="{{ isset($city) ? $city->city_name : old('city_name') }}"
                placeholder="City Name" required
            >

            @error('category_name')
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
                    <option value="{{ $state->id }}" {{ isset($city) && $state->id == $city->state_id ? 'selected' : ( old('state_id') == $state ? 'selected' : '') }}>{{ $state->state_name }}</option>
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

    </div>

    {{--</div>--}}


    <div class="form-group">
        <button class="btn btn-danger waves-light mr-1" type="submit">
            Submit
        </button>
    </div>



