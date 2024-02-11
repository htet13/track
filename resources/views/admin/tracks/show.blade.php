@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.track.index',$type) }}">
                        <h1>{{ trans('cruds.track.title') }}/ @lang('global.'.$type)</h1>
                    </a></li>
                <li class="breadcrumb-item active">{{ trans('cruds.track.title_singular') }} {{ trans('global.show') }}</li>
            </ol>
        </nav>
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
            <div class="row">
                <div class="col-md-12">
                    <div style="float: right">
                        <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.track.index', $type) }}">{{ trans('global.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection