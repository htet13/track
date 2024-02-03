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
                                <label class="required mb-2" for="date">@lang('global.date')</label>
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
                                <label class="required mb-2" for="car_no_id">@lang('cruds.car_no.title_singular')</label>
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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="fromcities">{{ trans('global.from') }}</label>
                                <select name="fromcities[]" id="fromcities" class="form-control {{ $errors->has('fromcities') ? 'is-invalid' : '' }}" multiple>
                                    <option value="" disabled>{{ trans('global.please_select') }}</option>
                                    @foreach ($cities as $id => $name)
                                        <option value="{{ $id }}"{{ in_array($id, old('fromcities', [])) ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('fromcities'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fromcities') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="tocities">{{ trans('global.to') }}</label>
                                <select name="tocities[]" id="tocities" class="form-control {{ $errors->has('tocities') ? 'is-invalid' : '' }}" multiple>
                                    <option value="" disabled>{{ trans('global.please_select') }}</option>
                                    @foreach ($cities as $id => $name)
                                        <option value="{{ $id }}"{{ in_array($id, old('tocities', [])) ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tocities'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tocities') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="expense">@lang('global.expense')</label>
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
                                <label class="required mb-2" for="issuer_id">@lang('cruds.issuer.title_singular')</label>
                                <select name="issuer_id" id="issuer_id" class="form-control {{ $errors->has('issuer_id') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($issuers as $id => $name)
                                        <option value="{{ $id }}"{{ old('issuer_id') ? 'selected' : '' }}>{{ $name }}</option>
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
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="diver_id">@lang('cruds.driver.title_singular')</label>
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
                                <label class="required mb-2" for="spare_id">@lang('cruds.spare.title_singular')</label>
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
                                @if(old("oil.liter"))
                                    @for( $i =0; $i < count(old("oil.liter")); $i++) 
                                        <label class="required mb-2" for="liter">@if($i == 0) @lang('global.liter') @endif</label>                           
                                        <input type="number" value="{{ old("oil.liter.$i")}}"  name="oil[liter][]" class="form-control" />                                       
                                    @endfor
                                @else
                                    <label class="required mb-2" for="liter">@lang('global.liter')</label>
                                    <input type="number" name="oil[liter][]" id="liter" class="form-control {{ $errors->has('oil.liter') ? 'is-invalid' : '' }}" />
                                @endif
                                @if($errors->has('oil.liter'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('oil.liter') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                @if(old("oil.price"))
                                    @for( $i =0; $i < count(old("oil.price")); $i++) 
                                        <label class="required mb-2" for="price">@if($i == 0) @lang('global.price') @endif</label>                           
                                        <input type="number" value="{{ old("oil.price.$i")}}"  name="oil[price][]" class="form-control" />                                       
                                    @endfor
                                @else
                                    <label class="required mb-2" for="price">@lang('global.price')</label>
                                    <input type="number" name="oil[price][]" id="price" class="form-control {{ $errors->has('oil.price') ? 'is-invalid' : '' }}" />
                                @endif
                                @if($errors->has('oil.price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('oil.price') }}
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
                                <label class="required mb-2" for="check_cost">@lang('global.check')</label>
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
                                <label class="required mb-2" for="gate_cost">@lang('global.gate')</label>
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
                                <label class="required mb-2" for="food_cost">@lang('global.food_cost')</label>
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
                    <label class="border-bottom border-primary mb-2">@lang('global.other_cost')</label>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                @if(old("others.category"))
                                    @for( $i =0; $i < count(old("others.category")); $i++) 
                                        <label class="required mb-2" for="category">@if($i == 0) @lang('global.category') @endif</label>                           
                                        <input type="text" value="{{ old("others.category.$i")}}"  name="others[category][]" class="form-control" />
                                    @endfor
                                @else
                                    <label class="required mb-2" for="category">@lang('global.category')</label>
                                    <input type="text" name="others[category][]" id="category" class="form-control {{ $errors->has('others.category') ? 'is-invalid' : '' }}" />
                                @endif
                                @if($errors->has('others.category'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('others.category') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                @if(old("others.cost"))
                                @for( $i =0; $i < count(old("others.cost")); $i++)   
                                    <label class="required mb-2" for="cost">@if($i == 0) @lang('global.cost') @endif</label>
                                    <input type="number" value="{{ old("others.cost.$i")}}"  name="others[cost][]" class="form-control" />                                       
                                @endfor
                                @else
                                    <label class="required mb-2" for="cost">@lang('global.cost')</label>
                                    <input type="number" name="others[cost][]" id="cost" class="form-control {{ $errors->has('others.cost') ? 'is-invalid' : '' }}" />
                                @endif
                                @if($errors->has('others.cost'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('others.cost') }}
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
                                <label class="required mb-2" for="total">@lang('global.total')</label>
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
                                <label class="mb-2" for="remark">@lang('global.remarks')</label>
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
@include('admin.tracks.scripts.liter-price-plus')
@include('admin.tracks.scripts.other-plus')
@include('admin.tracks.scripts.date')
@endsection
