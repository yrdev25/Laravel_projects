@extends('layouts.app_rl')
@section('header')
Register
@endsection

@section('content')

    <div class="container h-100">

        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form action="{{ route('register') }}" method="POST" class="mx-1 mx-md-4">
                    @csrf

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example1c">fname</label>
                          <input value="{{ isset($userdata) ? $userdata->user->fname : '' }}" type="text" id="form3Example1c" class="form-control" name="fname" />
                        </div>
                      <span class="text text-danger">
                        @error('fname')
                        {{ $message }}
                        @enderror
                      </span>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example1c">lname</label>
                          <input value="{{ isset($userdata) ? $userdata->user->lname : '' }}" type="text" id="form3Example1c" class="form-control" name="lname" />
                        </div>
                    <span class="text text-danger">
                      @error('lname')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example1c">Email</label>
                          <input type="text" id="form3Example1c" class="form-control" name="email" />
                        </div>
                    <span class="text text-danger">
                      @error('email')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>


                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Username</label>
                        <input type="text" id="form3Example1c" class="form-control" name="username" />
                      </div>
                    <span class="text text-danger">
                      @error('username')
                      {{ $message }}
                      @enderror
                    </span>
                    </div>


                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input type="password" id="form3Example4c" class="form-control" name="password" />
                      </div>
                    <span class="text text-danger">
                      @error('password')
                      {{ $message }}
                      @enderror
                    </span>
                    </div>


                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example4c">Confirm Password</label>
                          <input type="text" id="form3Example4c" class="form-control" name="password_confirmation" />
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example4c">Role</label>
                          <select name="role_id" class="form-control">
                             @foreach(Spatie\Permission\Models\Role::all() as $role)
                                 <option value="{{ $role->id }}">{{ $role->name }}</option>
                             @endforeach
                          </select>
                        </div>
                      </div>


                      <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                     </button>


                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">

                </div>
              </div>
            </div>
          </div>
        </div>

    </div>

@endsection

