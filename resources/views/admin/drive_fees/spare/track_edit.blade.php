@extends('layouts.hr.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ trans('global.drive_fee') }}/ @lang('cruds.spare.title_singular')</h1>
    </div><!-- End Page Title -->

    <form action="{{ route('admin.fee.spare.update', $spare_track) }}" method="post">
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
                                    <option value="paid" {{ $spare_track->is_paid == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                                    <option value="unpaid" {{ $spare_track->is_paid == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
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
                                <label class="mb-2" for="payment_date">@lang('global.payment_date')</label>
                                <input type="text" name="payment_date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ $spare_track->payment_date }}"  class="form-control {{ $errors->has('payment_date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('payment_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payment_date') }}
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
                                <textarea name="remark" id="remark">{{ $spare_track->remark }}</textarea>
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
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.fee.spare.detail',['spare_id' => $spare_track->spare_id, 'driver_is_paid' => request('driver_is_paid')]) }}">{{ trans('global.cancel') }}</a>
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
