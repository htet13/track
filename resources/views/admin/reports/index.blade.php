@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.report.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="report-table">
        <div class="card p-2">

            <form action="{{ route('admin.report') }}" method="GET">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="input-group">
                        <select name="from" id="from" class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.from') }}</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}"{{ old('from') || request('from') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <select name="to" id="to" class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.to') }}</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}"{{ old('to') || request('to') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    @can('Excel Export')
                    <div class="col-md-6">
                        <div class="d-flex" style="float:right">
                            <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                                {{ trans('global.excel') }} {{ trans('global.export') }}
                            </button>
                        </div>
                    </div>
                    @endcan
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>@lang('global.no')</th>
                    <th>@lang('cruds.track.title_singular')</th>
                    <th>@lang('global.quantity')</th>
                    <th>@lang('global.total')</th>
                    <th>@lang('global.transportation_cost') </th>
                    <th>@lang('global.average_date') </th>
                    </thead>
                    <tbody>
                        @forelse ($reports as $index => $report)
                            <tr id="row{{ $report->id }}">
                                <td>{{ $index+1 }}</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
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