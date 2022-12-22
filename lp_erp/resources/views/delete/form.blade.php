{{--<div class="row">--}}

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="delete_reason_name">Delete Reason*</label>
            <input
                type="text" name="delete_reason_name"
                class="form-control @error('delete_reason_name') is-invalid @enderror"
                id="delete_reason_name" value="{{ isset($delete) ? $delete->delete_reason_name : old('delete_reason_name') }}"
                placeholder="Delete Reason" required
            >

            @error('delete_reason_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="sort_order">Sort Order*</label>
            <input
                type="text" name="sort_order"
                class="form-control @error('sort_order') is-invalid @enderror"
                id="sort_order" value="{{ isset($delete) ? $delete->sort_order : old('sort_order') }}"
                placeholder="Sort Order" required
            >

            @error('sort_order')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    {{--</div>--}}


    <div class="form-group text-right mb-0">
        <button class="btn btn-danger waves-light mr-1" type="submit">
            Submit
        </button>
    </div>



