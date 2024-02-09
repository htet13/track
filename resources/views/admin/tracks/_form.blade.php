@extends('layouts.app')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.track.index') }}"><h1>{{ trans("cruds.track.title") }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }} {{ trans('global.'.$type) }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <form action="{{ $route }}" method="post">
        @csrf
        @method($method)
        <section class="track-info">
            <div class="card">
                <div class="card-header">
                <h6>{{ trans('cruds.track.title_singular') }}{{ trans('global.infos') }}</h6>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="date">@lang('global.date')</label>
                                <input type="text" name="date" id="date" value="{{ $track ? $track->date : old('date') }}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="car_no_id">@lang('cruds.car_no.title_singular')</label>
                                <select name="car_no_id" id="car_no_id" class="form-control {{ $errors->has('car_no_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($car_nos as $id => $name)
                                        <option value="{{ $id }}"{{ ($track ? $track->car_no_id : old('car_no_id')) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('car_no_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    @include('admin.tracks.layouts.from-to')
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="expense">@lang('global.expense')</label>
                                <input type="number" name="expense" placeholder="@lang('global.number_placeholder')" id="expense" value="{{ $track ? $track->expense : old('expense') }}"  class="form-control {{ $errors->has('expense') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('expense'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('expense') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="issuer_id">@lang('cruds.issuer.title_singular')</label>
                                <select name="issuer_id" id="issuer_id" class="form-control {{ $errors->has('issuer_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($issuers as $id => $name)
                                        <option value="{{ $id }}"{{ ($track ? $track->issuer_id : old('issuer_id')) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('issuer_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('issuer_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="diver_id">@lang('cruds.driver.title_singular')</label>
                                <select name="driver_id" id="driver_id" class="form-control {{ $errors->has('driver_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($drivers as $id => $name)
                                        <option value="{{ $id }}"{{ ($track ? $track->driver_id : old('driver_id')) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('driver_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('driver_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="spare_id">@lang('cruds.spare.title_singular')</label>
                                <select name="spare_id" id="spare_id" class="form-control {{ $errors->has('spare_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($spares as $id => $name)
                                        <option value="{{ $id }}"{{ ($track ? $track->spare_id : old('spare_id')) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('spare_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('spare_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="drive_fee">@lang('global.drive_fee')</label>
                                <select name="drive_fee" id="drive_fee" class="form-control {{ $errors->has('drive_fee') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    <option value="paid" {{ ($track ? $track->drive_fee : old('drive_fee')) == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                                    <option value="unpaid" {{ ($track ? $track->drive_fee : old('drive_fee')) == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
                                </select>
                                @if($errors->has('drive_fee'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('drive_fee') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    @include('admin.tracks.layouts.oil')
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-6 col-sm-6 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="check_cost">@lang('global.check')</label>
                                <input type="number" name="check_cost" placeholder="@lang('global.number_placeholder')" id="check_cost" value="{{ $track ? $track->check_cost : old('check_cost') }}"  class="form-control {{ $errors->has('check_cost') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('check_cost'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('check_cost') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-6 col-sm-6 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="gate_cost">@lang('global.gate')</label>
                                <input type="number" name="gate_cost" placeholder="@lang('global.number_placeholder')" id="gate_cost" value="{{ $track ? $track->gate_cost : old('gate_cost') }}"  class="form-control {{ $errors->has('gate_cost') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('gate_cost'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('gate_cost') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="food_cost">@lang('global.food_cost')</label>
                                <input type="number" name="food_cost" placeholder="@lang('global.number_placeholder')" id="food_cost" value="{{ $track ? $track->food_cost : old('food_cost') }}"  class="form-control {{ $errors->has('food_cost') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('food_cost'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('food_cost') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    @include('admin.tracks.layouts.other', ['track' => $track ? $track->otherCosts : []])
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2" for="remark">@lang('global.remarks')</label>
                                <textarea name="remark" id="remark" rows="4" cols="50" class="form-control summernote {{ $errors->has('remark') ? 'is-invalid' : '' }}">
                                    {{ $track ? $track->remark : old('remark') }}
                                </textarea>
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
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.track.index') }}">{{ trans('global.cancel') }}</a>
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
@include('admin.tracks.scripts.liter-price-plus')
@include('admin.tracks.scripts.other-plus')
@include('admin.tracks.scripts.common')
@endsection
