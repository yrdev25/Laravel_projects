@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.14.1/echo.common.js" integrity="sha512-/2wQCUhg3Y4oL4yTMPRgUDH5/aEy1WerU7Sl6MazsPcD6DRNxVBPlElSbLW07H8dCLzhvAFOsekxUEI2VmYPeQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.14.1/echo.js" integrity="sha512-Bx8O6rnCN/Ypq1fqgTmk/aZTCY2C69NnQL6QPfGR7CxcIno/8l8QDk9XLc/x8CSRJBQT4pV+3gniIZN16PZEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.14.1/echo.min.js" integrity="sha512-jCxbR9pml3/QJvAPAs0VZlhtWTT0EaYVFnW7HWM8omFOfPU+0m2u3xRQWbpcp00Sn/OV5gR8IY46GTet4WmXuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.5.0/pusher.min.js" integrity="sha512-gMIYkbO5/ZWa84EDeuy8ahVMc0wkQpYqTIdStCwMI8B+S/8+TmxkY+R7gOjO/V3nDySRbrZ7OjFAW+gliWPp0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        
        Echo.channel('events').listen('ForWebsocket', (data) => {
            console.log('1');
            i++;
            console.log('here');
        });
   
       
    </script>
@endsection
