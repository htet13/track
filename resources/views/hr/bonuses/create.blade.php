@extends('layouts.hr.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('hr.bonuses.index') }}"><h1>{{ trans('cruds.bonus.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }} {{ trans('global.create') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="bonus-table">
        <div class="card p-2">
            {{-- <div class="card-header">
                <h5>{{ trans('global.create') }} {{ trans('cruds.car_no.title_singular') }}</h5>
            </div> --}}
            <div class="card-body p-2">
                <form action="{{ route('hr.bonuses.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="date">@lang('global.date')</label>
                                <input type="text" name="date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ old('date') }}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="employee_id">@lang('cruds.employee.title_singular')@lang('global.name')</label>
                                <select name="employee_id" class="form-control select2 {{ $errors->has('employee_id') ? 'is-invalid' : '' }}">
                                    <option value="" selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($employees as $id => $name)
                                        <option value="{{ $id }}"{{ old('employee_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has("employee_id"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("employee_id") }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="bonus_type">@lang('global.bonus_type')</label>
                                <select name="bonus_type" class="form-control select2 {{ $errors->has('salary_type') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($bonus_types as $bonus_type)
                                        <option value="{{ $bonus_type }}"{{ old('bonus_type') == $bonus_type ? 'selected' : '' }}>@lang("global.$bonus_type")</option>
                                    @endforeach
                                </select>
                                @if($errors->has('bonus_type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('bonus_type') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">@lang('global.amount')</label>
                                <input type="text" name="amount" id="amount" placeholder="@lang('global.number_placeholder')" value="{{ old('amount') }}"  class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('amount') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('hr.bonuses.index') }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn bg-main text-main btn-sm float-right">{{ trans('global.save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
@section('scripts')
@include('admin.tracks.scripts.common')
@stop
