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
        <h1>{{ trans('cruds.employee.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="employee-table">
        <div class="card p-2">
            <form action="{{ route('hr.employee.index') }}" method="GET">
                <div class="row my-2">
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <input type="text" name="name" value="{{ request('name') }}" class="form-control" id="search" placeholder="@lang('global.search')">
                            <button class="btn btn-outline-main" type="submit"><i class="fa fa-magnifying-glass" aria-hidden="true"></i></button>
                            <a class="btn btn-outline-main" href="{{ route('hr.employee.index') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-md-4 col-12 mb-3 d-flex justify-content-end">
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan

                        <a class="btn bg-main text-main" href="{{ route('hr.employee.create') }}">
                            <i class="fa-solid fa-plus"></i>{{ trans('global.new') }}{{ trans('global.add') }}
                        </a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="border: 1px solid #959598; margin-bottom: 50px;">
                    <thead class="text-center align-middle">
                        <th>{{ trans('global.no') }}</th>
                        <th>{{ trans('global.name') }}</th>
                        <th>{{ trans('global.position') }}</th>
                        <th>{{ trans('global.created_at') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($employees as $index => $employee)
                        <tr id="row{{ $employee->id }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>@lang("cruds.$employee->position.title_singular")</td>
                            <td>{{ $employee->created_at->format('d-m-Y | h:i:s') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('hr.employee.show', $employee) }}" class="pe-3" title="Employee Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="{{ route('hr.employee.edit', $employee) }}" class="pe-3" title="Edit Employee Details">
                                        <i class="fa-regular fa-pen-to-square text-success"></i>
                                    </a>
                                    <form action="{{ route('hr.employee.destroy', $employee) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a class="pe-3 delete text-danger" title="Delete employee">
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
                        {{ $employees->appends(request()->input())->links() }}
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