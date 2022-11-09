@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add HR or Add Employee') }}</div>

                <div class="card-body">
                   <form action={{ route('admin.store') }} method="POST">
                      @csrf
                      <div class="card-text">
                      <label for="name">Name</label>
                      <input class="form-control" type="text" name="name">
                      </div>
                      <span class="text text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                      </span>

                      <div class="card-text mt-3">
                      <label for="email">Email</label>
                      <input class="form-control" type="text" name="email">
                      </div>
                      <span class="text text-danger">
                        @error('email')
                        {{ $message }}
                        @enderror
                      </span>

                      <div class="card-text mt-3">
                      <label for="password">Password</label>
                      <input class="form-control" type="text" name="password">
                      </div>
                      <span class="text text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                      </span>

                      <div class="card-text mt-3">
                      <label for="role">Role</label>
                      <select name="role_id" class="form-control">
                        <option value="2">Hr</option>
                        <option value="3">Employee</option>
                      </select>
                      </div>
                      <span class="text text-danger">
                        @error('role_id')
                        {{ $message }}
                        @enderror
                      </span>

                    <div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>

                    </form>                   
                </div>
            </div>
        </div>
    </div>
</div>


