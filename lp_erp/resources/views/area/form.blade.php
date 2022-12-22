{{--<div class="row">--}}

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="area_name">Area Name*</label>
            <input
                type="text" name="area_name"
                class="form-control @error('area_name') is-invalid @enderror"
                id="area_name" value="{{ isset($area) ? $area->area_name : old('area_name') }}"
                placeholder="City Name" required
            >

            @error('area_name')
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
                    <option value="{{ $city->id }}" {{ isset($area) && $city->id == $area->city_id ? 'selected' : ( old('city_id') == $city ? 'selected' : '') }}>{{ $city->city_name }}</option>
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

    </div>

    {{--</div>--}}


    <div class="form-group">
        <button class="btn btn-danger waves-light mr-1" type="submit">
            Submit
        </button>
    </div>



