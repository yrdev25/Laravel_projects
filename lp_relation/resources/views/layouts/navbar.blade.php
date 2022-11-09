<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('user.create') }}" class="nav-link">Register</a>
      </li>
    </ul>

    @if(Session::get('id') == "")
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('login') }}" class="nav-link">Login</a>
      </li>
    </ul>
    @endif

    @if(Session::has('image'))
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('user.index') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      @if(Session::has('image'))
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-info ion-log-out">
          {{ __('Logout') }}
        </button>
        </form>
      </li>
      @endif
    </ul>
    @endif

  </nav>