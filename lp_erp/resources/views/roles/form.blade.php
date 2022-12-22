
    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="name">Define Role*</label>
            <input
                type="text" name="name"
                class="form-control @error('name') is-invalid @enderror"
                id="name" value="{{ isset($role) ? $role->name : old('name') }}"
                placeholder="Name" required
            >

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>


    <div class="form-group">
        <button class="btn btn-danger waves-light mr-1" type="submit">
            Submit
        </button>
    </div>



