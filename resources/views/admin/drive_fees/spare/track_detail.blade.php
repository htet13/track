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
        <h1>{{ trans('global.drive_fee') }}/ @lang('cruds.spare.title_singular')</h1>
    </div><!-- End Page Title -->

    <section class="route-table">
        <div class="card p-2">
            <form action="{{ route('admin.fee.spare.detail',$spare_id) }}" method="GET">
                <div class="row my-2">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="date">@lang('global.date')</label>
                            <input type="text" name="date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ request('date') }}"  class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="car_no_id">@lang('cruds.car_no.title_singular')</label>
                            <select name="car_no_id" class="form-control select2 {{ $errors->has('car_no_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($car_nos as $id => $name)
                                    <option value="{{ $id }}" {{ request('car_no_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="issuer_id">{{ trans('cruds.issuer.title_singular') }}</label>
                            <select name="issuer_id" class="form-control select2 {{ $errors->has('issuer_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($issuers as $id => $name)
                                    <option value="{{ $id }}" {{ request('issuer_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="route">@lang('global.route')</label>
                            <select name="route" class="form-control select2 {{ $errors->has('route') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                <option value="tachileik" {{ request('route') == 'tachileik' ? 'selected' : '' }}>@lang('global.tachileik')</option>
                                <option value="other" {{ request('route') == 'other' ? 'selected' : '' }}>@lang('global.other')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="driver_is_paid">@lang('global.paid')/ @lang('global.unpaid')</label>
                            <select name="driver_is_paid" class="form-control select2 {{ $errors->has('driver_is_paid') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                <option value="paid" {{ request('driver_is_paid') == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                                <option value="unpaid" {{ request('driver_is_paid') == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="other_cost">@lang('global.other_cost')</label>
                            <input type="text" name="other_cost" placeholder="အမျိုးအမည်ဖြင့် @lang('global.search')" value="{{ request('other_cost') }}"  class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 col-12 mb-3 d-flex justify-content-end">
                        <button class="btn btn-outline-main me-2" type="submit"><i class="fa fa-magnifying-glass" aria-hidden="true"></i></button>
                        <a class="btn btn-outline-main me-2" href="{{ route('admin.fee.spare.detail',$spare_id) }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="border: 1px solid #959598; margin-bottom: 50px;">
                    <thead class="text-center align-middle">
                        <tr>
                            <th rowspan="2">{{ trans('global.no') }}</th>
                            <th rowspan="2" class="w-90">{{ trans('global.date') }}</th>
                            <th rowspan="2" class="w-90">{{ trans('cruds.car_no.title_singular') }}</th>
                            <th colspan="2">{{ trans('cruds.track.title_singular') }}</th>
                            <th rowspan="2">{{ trans('cruds.track.action') }}</th>
                        </tr>
                        <tr>
                        <th>{{ trans('global.from') }}</th>
                            <th>{{ trans('global.to') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse($spare_tracks as $index => $spare_track)
                        @php 
                            $track = $spare_track->track;
                            $driverTracksCount = count($track->driverTracks);
                            $spareTracksCount = count($track->spareTracks);
                            $difference = abs($driverTracksCount - $spareTracksCount);
                            $maxCount = max($driverTracksCount, $spareTracksCount);
                        @endphp
                        <tr id="row{{ $track->id }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="w-90">{{ $track->date->format('d-m-Y') }}</td>
                            <td class="w-90">{{ $track->carNo->name }}</td>
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
                            <td>
                                <a href="{{ route('admin.fee.spare.edit', ['track_id' => $track->id, 'driver_is_paid' => request('driver_is_paid')]) }}" class="pe-3" title="route Details">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                       
                        @empty
                        <tr>
                            <td colspan="22" class="text-center">
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