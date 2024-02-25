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
            <div class="row my-2">
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" placeholder="@lang('global.search')">
                        <button class="btn btn-outline-main" onclick="location.reload()" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

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
                        @forelse ($report->reportTracks()->get() as $index => $track)
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
                            <td>{{ number_format($track->expense) }}</td>
                            <td>{{ $track->issuer->name }}</td>
                            <td style="padding: unset; margin: unset" colspan="3">
                                <table class="table table-bordered table-striped" style="margin: unset;">
                                    <tbody>
                                    @foreach ($track->driverTracks as $driverTrack)
                                        <tr @if(!$loop->last) style="border-bottom: 1px solid gray;" @endif>
                                            <td style="border-right: 1px solid gray;">{{ $driverTrack->driver->name }}</td>
                                            <td style="border-right: 1px solid gray;">{{ $driverTrack->fee }}</td>
                                            <td>@lang('global.'.$driverTrack->is_paid)</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td style="padding: unset; margin: unset" colspan="3">
                                <table class="table table-bordered table-striped" style="margin: unset;">
                                    <tbody>
                                    @foreach ($track->spareTracks as $spareTrack)
                                        <tr @if(!$loop->last) style="border-bottom: 1px solid gray;" @endif>
                                            <td style="border-right: 1px solid gray;">{{ $spareTrack->spare->name }}</td>
                                            <td style="border-right: 1px solid gray;">{{ $spareTrack->fee }}</td>
                                            <td>@lang('global.'.$spareTrack->is_paid)</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                @foreach ($track->oilCosts as $oil)
                                <div>{{ number_format($oil->liter) }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($track->oilCosts as $oil)
                                <div>{{ number_format($oil->price) }}</div>
                                @endforeach
                            </td>
                            <td>{{ number_format($track->check_cost) }}</td>
                            <td>{{ number_format($track->gate_cost) }}</td>
                            <td>{{ number_format($track->food_cost) }}</td>
                            <td>
                                @foreach ($track->otherCosts as $other)
                                <div style=" @if(!$loop->last) border-bottom: 1px solid #031F63; @endif padding-top: 5px; padding-bottom: 5px;">{{ $other->category }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($track->otherCosts as $other)
                                <div>{{ number_format($other->cost) }}</div>
                                @endforeach
                            </td>
                            <td>{{ number_format($track->total) }}</td>
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
@endsection