@extends('layouts.app')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.track.index', [$type,'departure']) }}"><h1>{{ trans("cruds.track.title") }}/ @lang('global.'.$type)</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }} {{ trans('global.'.$form_type) }}</li>
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
                                <input type="text" name="date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ $track ? $track->date : old('date') }}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
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
                                <select name="car_no_id" class="form-control select2 {{ $errors->has('car_no_id') ? 'is-invalid' : '' }}">
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
                                <select name="issuer_id" id="issuer_id" class="form-control select2 {{ $errors->has('issuer_id') ? 'is-invalid' : '' }}">
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
                    @include('admin.tracks.layouts.driver')
                    @include('admin.tracks.layouts.spare')
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2" for="remark">@lang('global.remarks')</label>
                                <textarea name="remark" id="remark">{{ old('remark') ?? ($track ? $track->remark : old('remark')) }}</textarea>
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
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.track.index',[$type,'departure']) }}">{{ trans('global.cancel') }}</a>
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
@include('admin.tracks.scripts.driver-track-plus')
@include('admin.tracks.scripts.spare-track-plus')
@include('admin.tracks.scripts.common')
@endsection
