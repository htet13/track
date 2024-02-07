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
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12 col-xl-12">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.home') }}" method="GET" class="mb-4">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" value="{{ request('from_date') }}" />
                                        <input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date" value="{{ request('to_date') }}" />
                                        <button class="btn btn-outline-main" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @include('admin.dashboard.issuer')
                        @if(!$tracks->isEmpty())
                        <div class="card">
                            <div class="row m-3">
                                <div class="col-12">
                                    <div id="lineChart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row m-1 border rounded">
                                <div class="col-md-6 col-12" style="background-color: antiquewhite;">
                                    <div id="pieChart"></div>
                                </div>
                                <div class="col-md-6 col-12" style="background-color: #b8c2ca;">
                                    <div id="barChart"></div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
@section('scripts')
@include('admin.dashboard.chart')
<script>
    flatpickr('#from_date', {
        enableTime: false, // If you want to enable time as well
        dateFormat: "Y-m-d", // Specify your desired date format
        placeholder: "From Date"
    });

    flatpickr('#to_date', {
        enableTime: false, // If you want to enable time as well
        dateFormat: "Y-m-d", // Specify your desired date format
        placeholder: "To Date"
    });
</script>
@endsection

