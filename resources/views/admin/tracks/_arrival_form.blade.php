@extends('layouts.app')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.track.index', [$type,'arrival']) }}"><h1>{{ trans("cruds.track.title") }}/ @lang('global.'.$type)</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }} {{ trans('global.'.$type) }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <form action="{{ route('admin.arrival.update',[$type,$track]) }}" method="post">
        @csrf
        @method("PATCH")
        <section class="track-info">
            <div class="card">
                <div class="card-header">
                <h6>{{ trans('cruds.track.title_singular') }}{{ trans('global.infos') }}</h6>
                </div>
                <div class="card-body p-2">
                    
                    @include('admin.tracks.layouts.oil', ['track' => $track ? $track->oilCosts : []])
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
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.track.index',[$type,'arrival']) }}">{{ trans('global.cancel') }}</a>
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
