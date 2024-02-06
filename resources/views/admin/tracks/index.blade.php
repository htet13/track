@extends('layouts.app')

@section('styles')
{{-- sweet alert --}}
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<style>
.delete{
    cursor: pointer;
}
</style>
@endsection
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.track.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="route-table">
        <div class="card p-2">
            <div class="row my-2">
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                    <input type="search" class="form-control" id="search" placeholder="@lang('global.search')">
                    <button class="btn btn-outline-main" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-md-4 col-12 mb-3">
                    <form action="{{ route('admin.track.index') }}" method="GET">
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan
                    
                        <a class="btn bg-main text-main" href="{{ route('admin.track.create') }}">
                            <i class="fa-solid fa-plus"></i>{{ trans('global.new') }}{{ trans('global.add') }} 
                        </a>
                    </form>
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
                            <th colspan="2">{{ trans('global.person') }}</th>
                            <th colspan="2">{{ trans('global.oil') }}</th>
                            <th colspan="2">{{ trans('global.road_cost') }}</th>
                            <th rowspan="2">{{ trans('global.food_cost') }}</th>
                            <th colspan="2">{{ trans('global.other_cost') }}</th>
                            <th rowspan="2">{{ trans('global.total') }}</th>
                            <th rowspan="2">{{ trans('global.actions') }}</th>
                        </tr>
                        <tr>
                            <th>{{ trans('global.from') }}</th>
                            <th>{{ trans('global.to') }}</th>
                            <th>{{ trans('global.amount') }}</th>
                            <th>{{ trans('cruds.issuer.title_singular') }}</th>
                            <th>{{ trans('cruds.driver.title_singular') }}</th>
                            <th>{{ trans('cruds.spare.title_singular') }}</th>
                            <th>{{ trans('global.liter') }}</th>
                            <th>{{ trans('global.price') }}</th>
                            <th>{{ trans('global.check') }}</th>
                            <th>{{ trans('global.gate') }}</th>
                            <th>{{ trans('global.category') }}</th>
                            <th>{{ trans('global.cost') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($tracks as $index => $track)
                            <tr id="row{{ $track->id }}">
                                <td class="text-center">{{ $index+1 }}</td>
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
                                <td>{{ $track->driver->name }}</td>
                                <td>{{ $track->spare->name }}</td>
                                <td>
                                    @foreach ($track->oilCosts as $oil)
                                        <div>{{ $oil->liter }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($track->oilCosts as $oil)
                                        <div>{{ $oil->price }}</div>
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
                                        <div>{{ $other->cost }}</div>
                                    @endforeach
                                </td>
                                <td>{{ number_format($track->total) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.track.show', $track) }}" class="pe-3" title="route Details">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.track.edit', $track) }}" class="pe-3" title="Edit route Details">
                                            <i class="fa-regular fa-pen-to-square text-success"></i>
                                        </a>
                                        <form action="{{ route('admin.track.destroy', $track) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a class="pe-3 delete text-danger" title="Delete Track">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </form>
                                    </div>
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
var table = $('.table').DataTable({
    sPaginationType: "first_last_numbers",
    autoWidth: false,
    dom: "tp",
    pageLength: 30,
});
$('#search').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
$('.delete').on('click', function(){
    Swal.fire({
        title: '<span class="text-warning">သတိ!</span>',
        text: "စာရင်းဖျက်သိမ်းခြင်း ပြုလုပ်ရန် သေချာပါသလား။",
        icon: 'warning',
        confirmButtonText: 'Yes',
        showCancelButton: true,
    }).then((result) => {
        if(result.isConfirmed){
            $(this).parent().submit()
        }
    })
})
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
