@extends('layouts.app')

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
  
                  <form action="{{ isset($userdata) ? route('user.update',$userdata->user->id) : route('user.store') }}" method="POST" class="mx-1 mx-md-4" enctype="multipart/form-data">
                     @csrf
                     @isset($userdata)
                      @method('PUT')
                     @endisset
                     <input type="hidden" id="token" name="token" value="{{ csrf_token() }}" />
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
                          <label class="form-label" for="form3Example1c">Date_of_Birth</label>
                          <input type="text" id="dob"  data-date-format='yyyy-mm-dd' class="form-control" name="dob" value="{{ isset($userdata) ? $userdata->user->dob : '' }}"/>
                        </div>
                    <span class="text text-danger">
                      @error('dob')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>
                    

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example1c">Age</label>    
                          <input value="{{ isset($userdata) ? $userdata->user->age : '' }}" type="text" id="age" class="form-control" name="age"/>
                        </div>
                    <span class="text text-danger">
                      @error('age')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>
                    

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Email</label>
                        <input value="{{ isset($userdata) ? $userdata->user->email : '' }}" type="email" id="form3Example3c" class="form-control" name="email"/>
                      </div>
                    <span class="text text-danger">
                      @error('email')
                      {{ $message }}
                      @enderror
                    </span>
                    </div>
                    
  
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example3c">Number</label>
                          <input value="{{ isset($userdata) ? $userdata->user->number : '' }}" type="text" id="form3Example3c" class="form-control" name="number"/>
                        </div>
                    <span class="text text-danger">
                      @error('number')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>
                    

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example3c">Upload Image</label>
                          <input value="{{ isset($userdata) ? $userdata->user->image : ''   }}" type="file" id="form3Example3c" class="form-control" name="image"/>
                        </div>
                    <span class="text text-danger">
                      @error('image')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>
                    

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input value="{{ isset($userdata) ? $userdata->user->password : '' }}" type="password" id="form3Example4c" class="form-control" name="password" />
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
                          <label class="form-label" for="form3Example4c">Address</label>
                          <input value="{{ isset($userdata) ? $userdata->address : '' }}" type="text" id="form3Example4c" class="form-control" name="address" />
                        </div>
                    <span class="text text-danger">
                      @error('address')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>
                    


                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example4c">Zip Code</label>
                          <input value="{{ isset($userdata) ? $userdata->zipcode : '' }}" type="text" id="form3Example4c" class="form-control" name="zipcode" />
                        </div>
                    <span class="text text-danger">
                      @error('zipcode')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>
                    

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example4c">Country</label>
                            <select class="form-control" id="country-dd" name="country">
                              @if(isset($userdata))
                              <option value="{{ $userdata->country->id }}">{{ $userdata->country->name }}</option> 
                              @else
                              <option value="">Please Select</option>
                              @endif
                            @isset($countries)
                              @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>      
                              @endforeach
                            @endisset
                          </select>
                        </div>
                    <span class="text text-danger">
                      @error('country')
                      {{ $message }}
                      @enderror
                    </span>
                      </div>
                    

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example4c">State</label>
                          <select id="state-dd" class="form-control" name="state">
                            @isset($userdata)
                            <option value="{{ $userdata->state->id }}">{{ $userdata->state->name }}</option> 
                            @endisset
                          </select>
                      </div>
                    <span class="text text-danger">
                      @error('state')
                      {{ $message }}
                      @enderror
                    </span>
                    </div>
                    

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">City</label>
                        <select id="city-dd" class="form-control" name="city">
                          @isset($userdata)
                            <option value="{{ $userdata->city->id }}">{{ $userdata->city->name }}</option> 
                            @endisset
                        </select>
                    </div>
                  <span class="text text-danger">
                    @error('city')
                    {{ $message }}
                    @enderror
                  </span>
                  </div>
                  
                   
                    @if(isset($userdata))
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Update</button>
                    </div>
                    @else
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </div>
                    @endif
  
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
  
    <script>
      $(document).ready(function () {

        $("#dob").datepicker({
          onSelect: function(value, ui) {      
          var today = new Date();
         //console.log(today);
         age = today.getFullYear() - ui.selectedYear;     
         $('#age').val(age);
         }, 
         dateFormat: 'yy-mm-dd',     
          // dateFormat: 'mm-dd-yy',changeMonth: true,changeYear: true,yearRange:"c-100:c+0"
        });

          $('#country-dd').on('change', function () {
              var country_id = this.value;
              var token = $('#token').val();
              
              $("#state-dd").html('');
          
              $.ajax({
                  url: "{{route('fetch_state')}}",
                  type: "POST",
                  data: {
                      country_id: country_id,
                      _token: token
                  },
                  dataType: 'json',
                  success: function (data) {
                   // console.log(result);
                      $('#state-dd').html('<option value="">Select State</option>');
                    
                      $.each(data, function (key, value) {
                       // console.log(value);
                          $("#state-dd").append('<option value="' + value
                              .id + '">' + value.name + '</option>');
                      });
                      $('#city-dd').html('<option value="">Select City</option>');
                  }
              });
          });
          $('#state-dd').on('change', function () {
              var state_id = this.value;
              var token = $('#token').val();
              $("#city-dd").html('');
              $.ajax({
                  url: "{{route('fetch_city')}}",
                  type: "POST",
                  data: {
                      state_id: state_id,
                      _token: token
                  },
                  dataType: 'json',
                  success: function (data) {
                      $('#city-dd').html('<option value="">Select City</option>');
                      $.each(data, function (key, value) {
                          $("#city-dd").append('<option value="' + value
                              .id + '">' + value.name + '</option>');
                      });
                  }
              });
          });
      });
  </script>
@endsection

