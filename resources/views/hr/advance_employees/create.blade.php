@extends('layouts.hr.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('hr.advance-employee.index') }}"><h1>{{ trans('cruds.advance_employee.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }} {{ trans('global.create') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="advance-employee-table">
        <div class="card p-2">
            {{-- <div class="card-header">
                <h5>{{ trans('global.create') }} {{ trans('cruds.car_no.title_singular') }}</h5>
            </div> --}}
            <div class="card-body p-2">
                <form action="{{ route('hr.advance-employee.store') }}" method="post">
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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2" for="reason">@lang('global.reason')</label>
                                <textarea name="reason" id="reason">{{ old('reason') }}</textarea>
                                @if($errors->has('reason'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('reason') }}
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
                                <textarea name="remark" id="remark">{{ old('remark') }}</textarea>
                                @if($errors->has('remark'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('remark') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('hr.report.advanceEmployee') }}">{{ trans('global.cancel') }}</a>
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
