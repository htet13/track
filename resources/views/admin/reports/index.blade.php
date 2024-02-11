@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ trans('cruds.report.title') }}/ @lang('global.'.$type)</h1>
    </div><!-- End Page Title -->

    <section class="report-table">
        <div class="card p-2">
            <div class="row my-2">
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                        <input type="search" class="form-control" id="search" placeholder="@lang('global.search')">
                        <button class="btn btn-outline-main" onclick="location.reload()" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-md-4 col-12 mb-3 d-flex justify-content-end">
                    <form action="{{ route('admin.report',$type) }}" method="GET">
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped data-table" style="border: 1px solid #959598; margin-bottom: 50px;">
                    <thead class="text-center align-middle">
                        <tr>
                            <th rowspan="2">{{ trans('global.no') }}</th>
                            <th colspan="3">{{ trans('cruds.track.title_singular') }}</th>
                            <th rowspan="2">{{ trans('global.expense') }}</th>
                            <th colspan="2">{{ trans('global.oil') }}</th>
                            <th colspan="2">{{ trans('global.road_cost') }}</th>
                            <th rowspan="2">{{ trans('global.food_cost') }}</th>
                            <th rowspan="2">{{ trans('global.other_cost') }}</th>
                            <th rowspan="2">{{ trans('global.total') }}</th>
                        </tr>
                        <tr>
                            <th>{{ trans('global.from') }}</th>
                            <th>{{ trans('global.to') }}</th>
                            <th>အကြိမ်ရေ</th>
                            <th>{{ trans('global.liter') }}</th>
                            <th>{{ trans('global.price') }}</th>
                            <th>{{ trans('global.check') }}</th>
                            <th>{{ trans('global.gate') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($reports as $index => $track)
                        <tr id="row{{ $track->id }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                @foreach ($track->fromcities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($track->tocities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td>{{ $track->times }}</td>
                            <td>{{ number_format($track->expense) }}</td>
                            <td>{{ number_format($track->total_oil) }}</td>
                            <td>{{ number_format($track->total_price) }}</td>
                            <td>{{ number_format($track->check_cost) }}</td>
                            <td>{{ number_format($track->gate_cost) }}</td>
                            <td>{{ number_format($track->food_cost) }}</td>
                            <td>{{ number_format($track->other_cost) }}</td>
                            <td>{{ number_format($track->total) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="18" class="text-center">
                                {{ trans('global.no_data_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div style="float:right">
                        {{ $reports->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
@section('scripts')
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