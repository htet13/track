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
        <h1>{{ trans('cruds.advance_employee.title') }}/ အကျဉ်းချုပ်</h1>
    </div><!-- End Page Title -->

    <section class="advance-employee-table">
        <div class="card p-2">
            <form action="{{ route('hr.report.advanceEmployee') }}" method="GET">
                <div class="row my-2">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="employee_id">@lang('global.name')</label>
                            <select name="employee_id" class="form-control select2 {{ $errors->has('employee_id') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($employees as $id => $name)
                                    <option value="{{ $id }}" {{ request('employee_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 col-12 mb-3 d-flex justify-content-end">
                        <button class="btn btn-outline-main me-2" type="submit"><i class="fa fa-magnifying-glass" aria-hidden="true"></i></button>
                        <a class="btn btn-outline-main me-2" href="{{ route('hr.report.advanceEmployee') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        <a class="btn bg-main text-main" href="{{ route('hr.advance-employee.create') }}">
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
                        <th>{{ trans('global.advance') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($advance_employees as $index => $advance_employee)
                        <tr id="row{{ $advance_employee->id }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $advance_employee->employee->name }}</td>
                            <td>{{ $advance_employee->employee->position }}</td>
                            <td>{{ $advance_employee->employee->advance }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('hr.advance-employee.index', ['employee_id' => $advance_employee->employee_id]) }}" class="pe-3" title="Car No Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                {{ trans('global.no_data_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-2">
                <div class="col-md-5">
                    <div style="float:right">
                        {{ $advance_employees->appends(request()->input())->links() }}
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