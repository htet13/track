@extends('layouts.hr.app')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.fee.driver') }}"><h1>{{ trans("cruds.track.title") }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <form action="{{ route('admin.fee.driver.update', $driver_track) }}" method="post">
        @csrf
        @method('PUT')
        <section class="track-info">
            <div class="card">
                <div class="card-header">
                <h6>{{ trans('cruds.track.title_singular') }}{{ trans('global.infos') }}</h6>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="is_paid">@lang('global.paid')/ @lang('global.unpaid')</label>
                                <select name="is_paid" class="form-control select2">
                                    <option value="paid" {{ $driver_track->is_paid == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                                    <option value="unpaid" {{ $driver_track->is_paid == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
                                </select>
                                @if($errors->has('is_paid'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_paid') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2" for="remark">@lang('global.remarks')</label>
                                <textarea name="remark" id="remark">{{ $driver_track->remark }}</textarea>
                                @if($errors->has('remark'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('remark') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.fee.driver.detail',['driver_id' => $driver_track->driver_id, 'driver_is_paid' => request('driver_is_paid')]) }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn bg-main text-main btn-sm float-right">{{ trans('global.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

  </main><!-- End #main -->

@endsection
@section('scripts')
@include('admin.tracks.scripts.common')
@endsection
