@extends('layouts.hr.app')

@section('styles')
{{-- sweet alert --}}
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    .delete {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ trans('global.drive_fee') }}/ @lang('cruds.driver.title_singular')</h1>
    </div><!-- End Page Title -->

    <section class="issuer-table">
        <div class="card p-2">
            <form action="{{ route('admin.fee.driver') }}" method="GET">
                <div class="row my-2">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <select name="driver_id" class="form-control select2 {{ $errors->has('driver_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($drivers as $id => $name)
                                    <option value="{{ $id }}" {{ request('driver_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-6 col-12 mb-3 d-flex justify-content-end">
                        <button class="btn btn-outline-main me-2" type="submit"><i class="fa fa-magnifying-glass" aria-hidden="true"></i></button>
                        <a class="btn btn-outline-main me-2" href="{{ route('admin.fee.driver') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="border: 1px solid #959598; margin-bottom: 50px;">
                    <thead class="text-center align-middle">
                        <tr>
                            <th rowspan="2">{{ trans('global.no') }}</th>
                            <th rowspan="2">{{ trans('global.name') }}</th>
                            <th colspan="2">@lang('cruds.track.title_singular')</th>
                            <th colspan="2">@lang('global.drive_fee')</th>
                            <th rowspan="2">{{ trans('global.actions') }}</th>
                        </tr>
                        <tr>
                            <th>ရှင်းပြီး</th>
                            <th>မရှင်း</th>
                            <th>ရှင်းပြီး</th>
                            <th>မရှင်း</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($driver_tracks as $index => $driver)
                        <tr id="row{{ $driver->id }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $driver->driver->name }}</td>
                            <td>{{ $driver->paid_track_count }}</td>
                            <td>{{ $driver->unpaid_track_count }}</td>
                            <td>{{ $driver->paid_fee_sum }}</td>
                            <td>{{ $driver->unpaid_fee_sum }}</td>
                            <td class="d-flex justify-content-center gap-1 align-items-center w-100" style="min-width: 195px;">
                                <a style="text-decoration: none;" href="{{ route('admin.track.index','tachileik') }}" title="Driver Fee Details">
                                    <i class="fa-regular fa-eye icon-box"></i>
                                </a>
                                <a class="btn btn-success" href="{{ route('admin.fee.driver.detail',['driver_id' => $driver->driver_id, 'driver_is_paid' => 'paid']) }}" title="Driver Fee Details">
                                    ရှင်းပြီး
                                </a>
                                <a class="btn btn-main" href="{{ route('admin.fee.driver.detail',['driver_id' => $driver->driver_id, 'driver_is_paid' => 'unpaid']) }}" title="Driver Fee Details">
                                    မရှင်း
                                </a>
                            </td>
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
                        {{ $driver_tracks->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
@section('scripts')
@include('admin.tracks.scripts.common')
@endsection