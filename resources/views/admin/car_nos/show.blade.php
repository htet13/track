@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>{{ trans('cruds.car_no.title') }}/ @lang('global.show')</h1>
        <a class="btn bg-main text-main" href="{{ route('admin.car-no.index') }}">
            @lang('global.back')
        </a>
    </div><!-- End Page Title -->

    <section class="car-no-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                   <tr>
                        <th>
                            {{ trans('global.name') }}
                        </th>
                        <td>
                            {{ $car_no->name }}
                        </td>
                   </tr>
                </tbody>
            </table>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
