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
        <h1>{{ trans('cruds.driver.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="driver-table">
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
                    <form action="{{ route('admin.driver.index') }}" method="GET">
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan

                        <a class="btn bg-main text-main" href="{{ route('admin.driver.create') }}">
                            <i class="fa-solid fa-plus"></i>{{ trans('global.new') }}{{ trans('global.add') }}
                        </a>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="border: 1px solid #959598; margin-bottom: 50px;">
                    <thead class="text-center align-middle">
                        <th>{{ trans('global.no') }}</th>
                        <th>{{ trans('global.name') }}</th>
                        <th>{{ trans('global.created_at') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($drivers as $index => $driver)
                        <tr id="row{{ $driver->id }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $driver->name }}</td>
                            <td>{{ $driver->created_at->format('d-m-Y | h:i:s') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.driver.show', $driver) }}" class="pe-3" title="driver Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.driver.edit', $driver) }}" class="pe-3" title="Edit driver Details">
                                        <i class="fa-regular fa-pen-to-square text-success"></i>
                                    </a>
                                    <form action="{{ route('admin.driver.destroy', $driver) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a class="pe-3 delete text-danger" title="Delete driver">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
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
                        {{ $drivers->appends(request()->input())->links() }}
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