@extends('../layouts/app')

@section('content')
<main id="main" class="main">

    <!-- <div class="pagetitle">
        <h1>{{ trans('global.dashboard') }}</h1>
    </div>End Page Title -->

    @if (Session::has('msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get("msg") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12 col-xl-12">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-12">
                      @include('admin.dashboard.purchase')
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.home', ['interval' => 'weekly']) }}">Weekly Chart</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.home', ['interval' => 'monthly']) }}">Monthly Chart</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.home', ['interval' => 'yearly']) }}">Yearly Chart</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">မှတ်တမ်းများ</h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                
                            </div>

                        </div>
                    </div><!-- End Reports -->

                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</main><!-- End #main -->

@endsection
@section('scripts')
@include('admin.dashboard.chart')
@endsection

