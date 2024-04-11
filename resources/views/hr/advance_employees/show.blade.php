@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>{{ trans('cruds.advance_employee.title_singular') }}/ @lang('global.show')</h1>
        <a class="btn bg-main text-main" href="{{ route('hr.advance-employee.index', ['employee_id' => $advance_employee->employee_id]) }}">
            @lang('global.back')
        </a>
    </div><!-- End Page Title -->

    <section class="car-no-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                   <tr>
                        <th>
                            {{ trans('global.reason') }}
                        </th>
                        <td>
                            {{ $advance_employee->reason }}
                        </td>
                   </tr>
                   <tr>
                        <th>
                            {{ trans('global.remarks') }}
                        </th>
                        <td>
                            {{ $advance_employee->remark }}
                        </td>
                   </tr>
                </tbody>
            </table>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
