<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('assets/dist/img/CompanyLogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user_icon.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/userprofile" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->username }}</a>
            </div>
            <div class="info float-right" id="" style="flex-grow: 1; text-align: right;">
                <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                    @canany(['edit_user','create_user','destroy_user','view_users'])

                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>

                    </li>
                    @endcanany

                    @canany(['edit_customer','create_customer','destroy_customer','view_customers'])

                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}" class="nav-link  {{ request()->is('customer*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Customers
                                </p>
                            </a>

                        </li>

                    @endcanany

                    @canany(['edit_permission','create_permission','destroy_permission','view_permissions','edit_role','create_role','destroy_role','view_roles'])
                        <li class="nav-item {{ request()->is('roles*') || request()->is('permissions*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('roles*') || request()->is('permissions*') ? 'active' : '' }}">
                            {{-- <i class="nav-icon fas fa-circle"></i> --}}
                            <i class="nav-icon fas fa-user-lock"></i>
                            <p>
                                Role | Permission
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @canany(['edit_role','create_role','destroy_role','view_roles'])
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Role</p>
                                    </a>
                                </li>
                                @endcanany
                                @canany(['edit_permission','create_permission','destroy_permission','view_permissions'])
                                <li class="nav-item">
                                    <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->is('permissions*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permission</p>
                                    </a>
                                </li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany

                    @canany(['edit_country','create_country','destroy_country','view_countries','edit_state','create_state','destroy_state','view_states','edit_city','create_city','destroy_city','view_cities','edit_area','create_area','destroy_area','view_areas'])
                    <li class="nav-item {{ request()->is('country*') || request()->is('state*') || request()->is('city') || request()->is('city/*') || request()->is('area*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('country*') || request()->is('state*') || request()->is('city') || request()->is('city/*') || request()->is('area*') ? 'active' : '' }}">
                        {{-- <i class="nav-icon fas fa-circle"></i> --}}
                        <i class="fas fa-map-marker-alt  ml-2"></i>
                        <p class="ml-2">
                            Location
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['edit_country','create_country','destroy_country','view_countries'])
                            <li class="nav-item">
                                <a href="{{ route('country.index') }}" class="nav-link {{ request()->is('country*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Country</p>
                                </a>
                            </li>
                            @endcanany
                            @canany(['edit_state','create_state','destroy_state','view_states'])
                            <li class="nav-item">
                                <a href="{{ route('state.index') }}" class="nav-link {{ request()->is('state*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>State</p>
                                </a>
                            </li>
                            @endcanany
                            @canany(['edit_city','create_city','destroy_city','view_cities'])
                            <li class="nav-item">
                                <a href="{{ route('city.index') }}" class="nav-link {{ request()->is('city/*') || request()->is('city') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>City</p>
                                </a>
                            </li>
                            @endcanany
                            @canany(['edit_area','create_area','destroy_area','view_areas'])
                            <li class="nav-item">
                                <a href="{{ route('area.index') }}" class="nav-link {{ request()->is('area*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Area</p>
                                </a>
                            </li>
                            @endcanany
                        </ul>
                    </li>
                    @endcanany

                    @canany(['edit_category','create_category','destroy_category','view_catgories'])

                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link  {{ request()->is('category*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Categories
                            </p>
                        </a>

                    </li>

                @endcanany

                @canany(['edit_delete','create_delete','destroy_delete','view_deletes'])

                <li class="nav-item">
                    <a href="{{ route('delete.index') }}" class="nav-link  {{ request()->is('delete/*') || request()->is('delete') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trash"></i>
                        <p>
                            Deletes
                        </p>
                    </a>

                </li>

                @endcanany

                @canany(['edit_customer','create_customer','destroy_customer','view_customers'])
                <li class="nav-item {{ request()->is('verified') ||  request()->is('unverified') ||
                    request()->is('anniversary') || request()->is('dob') || request()->is('withoutdob') ||
                    request()->is('city_area') || request()->is('deleted') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link {{ request()->is('verified') ||  request()->is('unverified') ||
                    request()->is('anniversary') || request()->is('dob') || request()->is('withoutdob') ||
                    request()->is('city_area') || request()->is('deleted') ? 'active' : '' }}">
                    {{-- <i class="nav-icon fas fa-circle"></i> --}}
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Reports
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('verified') }}" class="nav-link {{ request()->is('verified') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Verified</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('unverified') }}" class="nav-link {{ request()->is('unverified') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Unverified</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('anniversary') }}" class="nav-link {{ request()->is('anniversary') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Anniversary</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dob') }}" class="nav-link {{ request()->is('dob') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DOB</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('withoutdob') }}" class="nav-link {{ request()->is('withoutdob') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Without DOB</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('city_area') }}" class="nav-link {{ request()->is('city_area') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>City/Area</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('deleted') }}" class="nav-link {{ request()->is('deleted') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Deleted</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcanany

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
