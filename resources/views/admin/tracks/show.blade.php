@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>{{ trans('cruds.track.title') }}/ @lang('global.'.$type)/ {{ trans('cruds.track.title_singular') }} {{ trans('global.show') }}</h1>
        <a class="btn bg-main text-main" href="{{ route('admin.track.index', [$type,'departure']) }}">
            @lang('global.back')
        </a>
    </div><!-- End Page Title -->

    <section class="track-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                    <tr>
                        <th>{{ trans('global.remarks') }}</th>
                        <td>{!! $track->remark !!}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('global.created_at') }}</th>
                        <td>{{ $track->created_at->format('Y-m-d | H:i:s') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</main><!-- End #main -->

@endsection