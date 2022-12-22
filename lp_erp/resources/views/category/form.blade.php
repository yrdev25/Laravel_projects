{{--<div class="row">--}}

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="category_name">Category Name*</label>
            <input
                type="text" name="category_name"
                class="form-control @error('category_name') is-invalid @enderror"
                id="category_name" value="{{ isset($category) ? $category->category_name : old('category_name') }}"
                placeholder="Category" required
            >

            @error('category_name')
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
                id="sort_order" value="{{ isset($category) ? $category->sort_order : old('sort_order') }}"
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


    <div class="form-group">
        <button class="btn btn-danger waves-light mr-1" type="submit">
            Submit
        </button>
    </div>



