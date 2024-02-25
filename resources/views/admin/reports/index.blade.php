@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ trans('cruds.report.title') }}/ @lang('global.'.$type)</h1>
    </div><!-- End Page Title -->

    <section class="report-table">
        <div class="card p-2">
            <form action="{{ route('admin.report',$type) }}" method="GET">
                <div class="row my-2">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="from_city">{{ trans('global.from') }}</label>
                            <select name="from_city" class="form-control select2 {{ $errors->has('from_city') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}" {{ request('from_city') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="to_city">{{ trans('global.to') }}</label>
                            <select name="to_city" class="form-control select2 {{ $errors->has('to_city') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}" {{ request('to_city') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 col-12 mb-3 d-flex justify-content-end">
                        <button class="btn btn-outline-main me-2" type="submit"><i class="fa fa-magnifying-glass" aria-hidden="true"></i></button>
                        <a class="btn btn-outline-main me-2" href="{{ route('admin.track.index',$type) }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan
                        <a class="btn bg-main text-main" href="{{ route('admin.track.create',$type) }}">
                            <i class="fa-solid fa-plus"></i>{{ trans('global.new') }}{{ trans('global.add') }}
                        </a>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="border: 1px solid #959598; margin-bottom: 50px;">
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
                            <th rowspan="2">{{ trans('global.actions') }}</th>
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
                        @forelse ($reports as $index => $report)
                        <tr id="row{{ $report->id }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                @foreach ($report->fromcities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($report->tocities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td>{{ $report->times }}</td>
                            <td>{{ number_format($report->expense) }}</td>
                            <td>{{ number_format($report->total_oil) }}</td>
                            <td>{{ number_format($report->total_price) }}</td>
                            <td>{{ number_format($report->check_cost) }}</td>
                            <td>{{ number_format($report->gate_cost) }}</td>
                            <td>{{ number_format($report->food_cost) }}</td>
                            <td>{{ number_format($report->other_cost) }}</td>
                            <td>{{ number_format($report->total) }}</td>
                            <td class="text-center">
                                    <a href="{{ route('admin.report.show', [$type,$report]) }}" title="route Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                            </td>
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
@include('admin.tracks.scripts.common')
@endsection