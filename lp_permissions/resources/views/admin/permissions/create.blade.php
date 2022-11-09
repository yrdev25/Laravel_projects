@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($permission) ? __('Update Permission') : __('Add Permission') }}</div>

                <div class="card-body">
                    <form action={{ isset($permission) ? route('admin.permissions.update',$permission->id) : route('admin.permissions.store') }} method="POST">
                        @csrf
                        @isset($permission)
                        @method('PUT')
                        @endisset
                        <div class="card-text">
                        <label for="name">Define Permission:</label>
                        <input class="form-control" type="text" name="name" value="{{ isset($permission) ? $permission->name : '' }}">
                        </div>
                        <span class="text text-danger">@error('name') {{ $message }} @enderror</span>

                        <div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>

                    </form>                   
                </div>
            </div>
        </div>
    </div>
</div>
