@extends('layouts.app')

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
                            <label class="required mb-2" for="driver_id">{{ trans('cruds.driver.title_singular') }}</label>
                            <select name="driver_id" class="form-control select2 {{ $errors->has('driver_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($drivers as $id => $name)
                                    <option value="{{ $id }}" {{ request('driver_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="spare_id">{{ trans('cruds.spare.title_singular') }}</label>
                            <select name="spare_id" class="form-control select2 {{ $errors->has('spare_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($spares as $id => $name)
                                    <option value="{{ $id }}" {{ request('spare_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
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
                            <th colspan="2">{{ trans('global.expense') }}</th>
                            <th colspan="3">{{ trans('cruds.driver.title_singular') }}</th>
                            <th colspan="3">{{ trans('cruds.spare.title_singular') }}</th>
                            <th colspan="2">{{ trans('global.oil') }}</th>
                            <th colspan="2">{{ trans('global.road_cost') }}</th>
                            <th rowspan="2">{{ trans('global.food_cost') }}</th>
                            <th colspan="2">{{ trans('global.other_cost') }}</th>
                            <th rowspan="2">{{ trans('global.total') }}</th>
                            <th rowspan="2">{{ trans('cruds.track.action') }}</th>
                        </tr>
                        <tr>
                            <th>{{ trans('global.from') }}</th>
                            <th>{{ trans('global.to') }}</th>
                            <th>{{ trans('global.amount') }}</th>
                            <th>{{ trans('cruds.issuer.title_singular') }}</th>
                            <th>{{ trans('global.name') }}</th>
                            <th>{{ trans('global.drive_fee') }}</th>
                            <th>ရှင်း/ မရှင်း</th>
                            <th>{{ trans('global.name') }}</th>
                            <th>{{ trans('global.drive_fee') }}</th>
                            <th>ရှင်း/ မရှင်း</th>
                            <th>{{ trans('global.liter') }}</th>
                            <th>{{ trans('global.price') }}</th>
                            <th>{{ trans('global.check') }}</th>
                            <th>{{ trans('global.gate') }}</th>
                            <th>{{ trans('global.category') }}</th>
                            <th>{{ trans('global.cost') }}</th>
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
                            <td rowspan="{{ $maxCount }}" class="text-center">{{ $index + 1 }}</td>
                            <td rowspan="{{ $maxCount }}" class="w-90">{{ $track->date->format('d-m-Y') }}</td>
                            <td rowspan="{{ $maxCount }}" class="w-90">{{ $track->carNo->name }}</td>
                            <td rowspan="{{ $maxCount }}">
                                @foreach ($track->fromcities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td rowspan="{{ $maxCount }}">
                                @foreach ($track->tocities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td rowspan="{{ $maxCount }}">{{ number_format($track->expense) }}</td>
                            <td rowspan="{{ $maxCount }}">{{ $track->issuer->name }}</td>
                            <td>{{ $track->driverTracks[0]->driver->name }}</td>
                            <td>{{ $track->driverTracks[0]->fee }}</td>
                            <td>@lang('global.'.$track->driverTracks[0]->is_paid)</td>
                            <td>{{ $track->spareTracks[0]->spare->name }}</td>
                            <td>{{ $track->spareTracks[0]->fee }}</td>
                            <td>@lang('global.'.$track->spareTracks[0]->is_paid)</td>
                            <td rowspan="{{ $maxCount }}">
                                @foreach ($track->oilCosts as $oil)
                                <div>{{ number_format($oil->liter) }}</div>
                                @endforeach
                            </td>
                            <td rowspan="{{ $maxCount }}">
                                @foreach ($track->oilCosts as $oil)
                                <div>{{ number_format($oil->price) }}</div>
                                @endforeach
                            </td>
                            <td rowspan="{{ $maxCount }}">{{ number_format($track->check_cost) }}</td>
                            <td rowspan="{{ $maxCount }}">{{ number_format($track->gate_cost) }}</td>
                            <td rowspan="{{ $maxCount }}">{{ number_format($track->food_cost) }}</td>
                            <td rowspan="{{ $maxCount }}">
                                @foreach ($track->otherCosts as $other)
                                <div style=" @if(!$loop->last) border-bottom: 1px solid #031F63; @endif padding-top: 5px; padding-bottom: 5px;">{{ $other->category }}</div>
                                @endforeach
                            </td>
                            <td rowspan="{{ $maxCount }}">
                                @foreach ($track->otherCosts as $other)
                                <div>{{ number_format($other->cost) }}</div>
                                @endforeach
                            </td>
                            <td rowspan="{{ $maxCount }}">{{ number_format($track->total) }}</td>
                            <td rowspan="{{ $maxCount }}">
                                    <a href="{{ route('admin.fee.spare.edit', $track->id) }}" class="pe-3" title="route Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                            </td>
                        </tr>
                        @for($i=1; $i < $maxCount; $i++)
                        <tr>
                            @if($i < $driverTracksCount)
                            <td>{{ $track->driverTracks[$i]->driver->name }}</td>
                            <td>{{ $track->driverTracks[$i]->fee }}</td>
                            <td>@lang('global.'.$track->driverTracks[$i]->is_paid)</td>
                            @else
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                            @if($i < $spareTracksCount)
                            <td>{{ $track->spareTracks[$i]->spare->name }}</td>
                            <td>{{ $track->spareTracks[$i]->fee }}</td>
                            <td>@lang('global.'.$track->spareTracks[$i]->is_paid)</td>
                            @else
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                        </tr>
                        @endfor
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