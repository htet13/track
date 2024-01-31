@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.track.index') }}"><h1>{{ trans("cruds.track.title") }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }} {{ trans('global.create') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <form action="{{ route('admin.track.store') }}" method="post">
        @csrf
        <section class="track-info">
            <div class="card">
                <div class="card-header">
                    <h6>{{ trans('cruds.track.title_singular') }}{{ trans('global.infos') }}</h6>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="date">ရက်စွဲ</label>
                                <input type="text" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
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
                                <label class="required mb-2" for="car_no_id">ကားနံပါတ်</label>
                                <select name="car_no_id" id="car_no_id" class="form-control {{ $errors->has('car_no_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($car_nos as $id => $name)
                                        <option value="{{ $id }}"{{ old('car_no_id') ? 'selected' : '' }}>{{ $name }}</option>
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
                    <hr>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-4 col-sm-4 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="from">{{ trans('global.from') }}</label>
                                <select name="from" id="from" class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($cities as $id => $name)
                                        <option value="{{ $id }}"{{ old('from') ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('from'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('from') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-2 col-sm-2 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-primary from-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-4 col-sm-4 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="to">{{ trans('global.to') }}</label>
                                <select name="to" id="to" class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($cities as $id => $name)
                                        <option value="{{ $id }}"{{ old('to') ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('to'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('to') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-1 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-primary to-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 from-append"></div>
                        <div class="col-6 to-append"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="expense">စရိတ်</label>
                                <input type="number" name="expense" id="expense" value="{{old('expense')}}"  class="form-control {{ $errors->has('expense') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('expense'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('expense') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="issuer">ထုတ်ပေးသူ</label>
                                <input type="text" name="issuer" id="issuer" value="{{old('issuer')}}"  class="form-control {{ $errors->has('issuer') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('issuer'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('issuer') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="diver_id">ယာဉ်မောင်း</label>
                                <select name="driver_id" id="driver_id" class="form-control {{ $errors->has('driver_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($drivers as $id => $name)
                                        <option value="{{ $id }}"{{ old('driver_id') ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('driver_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('driver_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="spare_id">ယာဉ်နောက်လိုက်</label>
                                <select name="spare_id" id="spare_id" class="form-control {{ $errors->has('spare_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($spares as $id => $name)
                                        <option value="{{ $id }}"{{ old('spare_id') ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('spare_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('spare_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">လီတာ</label>
                                <input type="number" name="liter" id="liter" value="{{old('liter')}}"  class="form-control {{ $errors->has('liter') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('liter'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('liter') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="price">ဈေးနှုန်း</label>
                                <input type="text" name="price" id="price" value="{{old('price')}}"  class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-2 col-sm-2 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-primary liter-price-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 liter-price-append"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="check_cost">ရဲ/စစ်</label>
                                <input type="number" name="check_cost" id="check_cost" value="{{old('check_cost')}}"  class="form-control {{ $errors->has('check_cost') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('check_cost'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('check_cost') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="gate_cost">တိုးဂိတ်</label>
                                <input type="number" name="gate_cost" id="gate_cost" value="{{old('gate_cost')}}"  class="form-control {{ $errors->has('gate_cost') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('gate_cost'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('gate_cost') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="food_cost">စားစရိတ်</label>
                                <input type="number" name="food_cost" id="food_cost" value="{{old('food_cost')}}"  class="form-control {{ $errors->has('food_cost') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('food_cost'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('food_cost') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="border-bottom border-primary mb-2">အခြားစရိတ်</label>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="others[][]">အမျိုးအမည်</label>
                                <input type="text" name="others[][]" id="others[][]" value="{{old('others[][]')}}"  class="form-control {{ $errors->has('others[][]') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('others[][]'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('others[][]') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="others[][]">ကုန်ကျစရိတ်</label>
                                <input type="number" name="others[][]" id="others[][]" value="{{old('others[][]')}}"  class="form-control {{ $errors->has('others[][]') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('others[][]'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('others[][]') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-2 col-sm-2 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-primary other-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 other-append"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="total">စုစုပေါင်း</label>
                                <input type="number" name="total" id="total" value="{{old('total')}}"  class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('total'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="remark">မှတ်ချက်</label>
                                <textarea type="text" name="remark" id="remark" value="{{old('remark')}}"  class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}">
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
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.role.index') }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn btn-success btn-sm float-right">{{ trans('global.save') }}</button>
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
@include('admin.tracks.scripts.from-to-plus')
@include('admin.tracks.scripts.liter-price-plus')
@include('admin.tracks.scripts.other-plus')
@include('admin.tracks.scripts.date')
@endsection
