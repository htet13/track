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
        <h1>{{ trans('cruds.track.title') }}/ @lang('global.'.$type)</h1>
    </div><!-- End Page Title -->

    <section class="route-table">
        <div class="card p-2">
            <form action="{{ route('admin.track.index',[$type,$status]) }}" method="GET">
                <div class="row my-2">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="date">@lang('global.date')</label>
                            <input type="text" name="date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ request('date') }}"  class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
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
                        <div class="input-group">
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
                        <div class="input-group">
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
                        <div class="input-group">
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
                        <div class="input-group">
                            <label class="required mb-2" for="driver_id">{{ trans('cruds.driver.title_singular') }}</label>
                            <select name="driver_id" class="form-control select2 {{ $errors->has('driver_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }} ( @lang("global.$driver->salary_type") )</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <label class="required mb-2" for="spare_id">{{ trans('cruds.spare.title_singular') }}</label>
                            <select name="spare_id" class="form-control select2 {{ $errors->has('spare_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($spares as $spare)
                                    <option value="{{ $spare->id }}" {{ request('spare_id') == $spare->id ? 'selected' : '' }}>{{ $spare->name }} ( @lang("global.$spare->salary_type") )</option>
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
                        <a class="btn btn-outline-main me-2" href="{{ route('admin.track.index',[$type,$status]) }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan
                        @if($status == 'departure')
                        <a class="btn bg-main text-main" href="{{ route('admin.track.create',[$type,$status]) }}">
                            <i class="fa-solid fa-plus"></i>{{ trans('global.new') }}{{ trans('global.add') }}
                        </a>
                        @endif
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" style="border: 1px solid #959598; margin-bottom: 50px;">
                    <thead class="text-center align-middle">
                        <tr>
                            <th rowspan="2">{{ trans('global.no') }}</th>
                            <th rowspan="2" class="w-90">{{ trans('global.date') }}</th>
                            <th rowspan="2" class="w-90">{{ trans('cruds.car_no.title_singular') }}</th>
                            <th colspan="2">{{ trans('cruds.track.title_singular') }}</th>
                            <th colspan="2">{{ trans('global.expense') }}</th>
                            <th colspan="3">{{ trans('cruds.driver.title_singular') }}</th>
                            <th colspan="3">{{ trans('cruds.spare.title_singular') }}</th>
                            @if($status == 'arrival')
                            <th colspan="2">{{ trans('global.oil') }}</th>
                            <th colspan="2">{{ trans('global.road_cost') }}</th>
                            <th rowspan="2">{{ trans('global.food_cost') }}</th>
                            <th colspan="2">{{ trans('global.other_cost') }}</th>
                            <th rowspan="2">{{ trans('global.total') }}</th>
                            @endif
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
                            @if($status == 'arrival')
                            <th>{{ trans('global.liter') }}</th>
                            <th>{{ trans('global.price') }}</th>
                            <th>{{ trans('global.check') }}</th>
                            <th>{{ trans('global.gate') }}</th>
                            <th>{{ trans('global.category') }}</th>
                            <th>{{ trans('global.cost') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($tracks as $index => $track)
                        @php 
                            $driverTracksCount = count($track->driverTracks);
                            $spareTracksCount = count($track->spareTracks);
                            $difference = abs($driverTracksCount - $spareTracksCount);
                            $maxCount = max($driverTracksCount, $spareTracksCount);

                            $driver = $track->driverTracks[0]->driver;
                            $spare = $track->spareTracks[0]->spare;
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
                            <td>{{ $driver->name }} ( @lang("global.$driver->salary_type") )</td>
                            <td>{{ $driver->salary_type == 'monthly' ? '-' : $track->driverTracks[0]->fee }}</td>
                            <td>{{ $driver->salary_type == 'monthly' ? '-' : trans("global.".$track->driverTracks[0]->is_paid)}}</td>
                            <td>{{ $spare->name }} ( @lang("global.$spare->salary_type") )</td>
                            <td>{{ $spare->salary_type == 'monthly' ? '-' : $track->spareTracks[0]->fee }}</td>
                            <td>{{ $spare->salary_type == 'monthly' ? '-' : trans("global.".$track->spareTracks[0]->is_paid)}}</td>
                            @if($status == 'arrival')
                            <td rowspan="{{ $maxCount }}">
                                @foreach ($track->oilCosts as $oil)
                                <div>{{ number_format($oil->liter,2) }}</div>
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
                            @endif
                            <td rowspan="{{ $maxCount }}">
                                <div  class="d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        @if($status == 'departure')
                                        <a href="{{ route('admin.track.show', [$type,$status,$track]) }}" title="route Details">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.track.edit', [$type,$status,$track]) }}" title="Edit route Details">
                                            <i class="fa-regular fa-pen-to-square text-success"></i>
                                        </a>
                                        <form action="{{ route('admin.track.destroy', [$type,$status,$track]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a class="delete text-danger" title="Delete Track">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </form>
                                        @endif
                                    </div>
                                    <div style="width: 100px;" class="d-flex justify-content-between align-items-center">
                                        <a class="btn bg-main text-main pointer" href="{{ route('admin.arrival.edit',[$type,$status,$track]) }}">
                                            @if($status == 'departure')
                                            <i class="fa-solid fa-plus"></i>ရောက်ရှိ
                                            @elseif($status == 'arrival')
                                            <i class="fa-regular fa-pen-to-square"></i><span class="ms-1">ပြင်ရန်</span>
                                            @endif
                                        </a>
                                        @if($status == 'arrival')
                                        <form action="{{ route('admin.track.destroy', [$type,$status,$track]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a class="delete text-danger" title="Delete Track">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @for($i=1; $i < $maxCount; $i++)
                        <tr>
                            @if($i < $driverTracksCount)
                            <td>{{ $track->driverTracks[$i]->driver->name }} ( @lang('global.'.$track->driverTracks[$i]->driver->salary_type) )</td>
                            <td>{{ $track->driverTracks[$i]->driver->salary_type == 'monthly' ? '-' : $track->driverTracks[$i]->fee }}</td>
                            <td>{{ $track->driverTracks[$i]->driver->salary_type == 'monthly' ? '-' : trans("global.".$track->driverTracks[$i]->is_paid)}}</td>
                            @else
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                            @if($i < $spareTracksCount)
                            <td>{{ $track->spareTracks[$i]->spare->name }} ( @lang('global.'.$track->spareTracks[$i]->spare->salary_type) )</td>
                            <td>{{ $track->spareTracks[$i]->spare->salary_type == 'monthly' ? '-' : $track->spareTracks[$i]->fee }}</td>
                            <td>{{ $track->spareTracks[$i]->spare->salary_type == 'monthly' ? '-' : trans('global.'.$track->spareTracks[$i]->is_paid) }}</td>
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
                        {{ $tracks->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection

@section('scripts')
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $('.delete').on('click', function() {
        Swal.fire({
            title: '<span class="text-warning">သတိ!</span>',
            text: "စာရင်းဖျက်သိမ်းခြင်း ပြုလုပ်ရန် သေချာပါသလား။",
            icon: 'warning',
            confirmButtonText: 'Yes',
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit()
            }
        })
    })
</script>
@include('admin.tracks.scripts.common')
@endsection