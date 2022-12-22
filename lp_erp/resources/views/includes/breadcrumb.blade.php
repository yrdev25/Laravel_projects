@if(isset($breadcrumb))
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ isset($breadcrumb) && isset($breadcrumb['page_title']) ? $breadcrumb['page_title'] : '' }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @foreach($breadcrumb['page_items'] as $key => $value)
                            @if(isset($value) && !empty($value))
                                <li class="breadcrumb-item"><a href="{{ $value }}">{{ $key }}</a></li>
                            @else
                                <li class="breadcrumb-item active"> {{ $key }} </li>
                            @endif
                        @endforeach
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@else
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Dashboard </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"> Dashboard </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endif
