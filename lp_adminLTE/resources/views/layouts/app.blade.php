<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header_scripts')
</head> 
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.navbar')
        
        @include('layouts.sidebar')

        <section class="content" style="margin : 0px 0px 0px 250px">
              <div class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0">
                        @yield('header')
                      </h1>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
              </div>

              <div class="container-fluid">
                  @yield('content')
              </div>
        </section>       

        @include('layouts.footer')
    </div>
    @include('layouts.footer_scripts')
</body>        
