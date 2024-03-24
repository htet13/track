@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>{{ trans('cruds.issuer.title') }}/ @lang('global.show')</h1>
        <a class="btn bg-main text-main" href="{{ route('admin.issuer.index') }}">
            @lang('global.back')
        </a>
    </div><!-- End Page Title -->

    <section class="issuer-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                   <tr>
                        <th>
                            {{ trans('global.name') }}
                        </th>
                        <td>
                            {{ $issuer->name }}
                        </td>
                   </tr>
                </tbody>
            </table>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
