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

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>{{ trans('global.salary') }}</h1>
    </div><!-- End Page Title -->

    <section class="salary-table">
        <div class="card p-2">
            <form action="{{ route('hr.salary.index') }}" method="GET">
                <div class="row my-2">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="month">{{ trans('global.month') }}</label>
                            <select name="month" class="form-control select2 {{ $errors->has('month') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month }}" {{ (request('month') ?? date('m')-1) == $month ? 'selected' : '' }}>@lang("month.".$month)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="year">{{ trans('global.year') }}</label>
                            <input type="number" name="year" placeholder="@lang('global.number_placeholder')" value="{{ request('year') ?? date('Y') }}"  class="form-control {{ $errors->has('expense') ? 'is-invalid' : '' }}"/>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required mb-2" for="employee_id">{{ trans('global.name') }}</label>
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
                    <div class="col-md-6 text-second"></div>
                    <div class="col-md-6 col-12 mb-3 d-flex justify-content-end">
                        <button class="btn btn-outline-main me-2" type="submit"><i class="fa fa-magnifying-glass" aria-hidden="true"></i></button>
                        <a class="btn btn-outline-main me-2" href="{{ route('hr.salary.index') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        @can('Excel Export')
                        <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                            {{ trans('global.excel') }} {{ trans('global.export') }}
                        </button>
                        @endcan
                        <a class="btn bg-main text-main" href="{{ route('hr.sync_employee') }}">
                            <i class="fa-solid fa-plus"></i>လစာပေးရန်
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
                        <th>{{ trans('global.month') }}</th>
                        <th>{{ trans('global.year') }}</th>
                        <th>{{ trans('global.paid') }}/ {{ trans('global.unpaid') }}</th>
                        <th>{{ trans('global.payment_date') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($salaries as $index => $salary)
                        <tr id="row{{ $salary->id }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $salary->employee->name }} (@lang("global.".$salary->employee->salary_type))</td>
                            <td>@lang("cruds.".$salary->employee->position.".title_singular")</td>
                            <td>@lang("month.".$salary->month)</td>
                            <td>{{ $salary->year }}</td>
                            <td>
                                <div @if($salary->is_paid == 'paid') class="badge bg-success rounded-pill" @endif>@lang("global.".$salary->is_paid)</div>
                            </td>
                            <td>{{ optional($salary->payment_date)->format('d-m-Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="pe-3" title="View Remarks">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="{{ route('hr.salary.edit', $salary) }}" class="pe-3" title="Edit Salary Details">
                                        <i class="fa-regular fa-pen-to-square text-success"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @include('common.modal', ['remark' => $salary->remark])
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
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
                        {{ $salaries->appends(request()->input())->links() }}
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