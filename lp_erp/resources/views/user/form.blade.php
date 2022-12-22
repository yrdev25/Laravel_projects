{{--<div class="row">--}}

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="fname">First Name*</label>
            <input
                type="text" name="fname"
                class="form-control @error('fname') is-invalid @enderror"
                id="fname" value="{{ isset($user) ? $user->fname : old('fname') }}"
                placeholder="First Name" required
            >

            @error('fname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="lname">Last Name*</label>
            <input
                type="text" name="lname"
                class="form-control @error('lname') is-invalid @enderror"
                id="lname" value="{{ isset($user) ? $user->lname : old('lname') }}"
                placeholder="Last Name" required
            >

            @error('lname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="email">E-Mail*</label>
            <input
                type="text" name="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email" value="{{ isset($user) ? $user->email : old('email') }}"
                placeholder="E-Mail" required
            >

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="username">Username*</label>
            <input
                type="text" name="username"
                class="form-control @error('username') is-invalid @enderror"
                id="username" value="{{ isset($user) ? $user->username : old('username') }}"
                placeholder="Username" required
            >

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="password">Password*</label>
            <input
                type="text" name="password"
                class="form-control @error('password') is-invalid @enderror"
                id="password" value="{{ old('password') }}"
                placeholder="Password" required
            >

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="password_confirmation">Confirm Password*</label>
            <input
                type="text" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" value="{{ old('password_confirmation') }}"
                placeholder="Confirm Password" required
            >
        </div>

        <div class="form-group col-md-6">
            <label for="role_id">Role*</label>
            <select class="form-control select2 select2-multiple @error('role_id') is-invalid @enderror" required name="role_id" id="role_id">
                <option value="" >Select</option>
                @forelse($roles as $role)
            <!--         <option value="{{ $role->id }}">{{ $role->role_name }}</option> -->
                    <option value="{{ $role->id }}" {{ isset($user) && $role->id == $user->role_id ? 'selected' : ( old('role_id') == $role ? 'selected' : '') }}>{{ $role->name }}</option>
                @empty
                    <option value="">No Data Found.</option>
                @endforelse
            </select>
            @error('role_id')
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



