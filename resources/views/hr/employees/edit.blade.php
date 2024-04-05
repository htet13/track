@extends('layouts.hr.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('hr.employee.index',$status) }}"><h1>{{ trans('cruds.employee.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }}{{ trans('global.update') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="employee-table">
        <div class="card p-2">
            <div class="card-body p-2">
                <form action="{{ route('hr.employee.update', [$status,$employee]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="joined_date">@lang('global.joined_date')</label>
                                <input type="text" name="joined_date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ old('joined_date', $employee->joined_date) }}"  class="form-control {{ $errors->has('joined_date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('joined_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('joined_date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="name">{{ trans('global.name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="position">@lang('global.position')</label>
                                <select name="position" class="form-control select2 {{ $errors->has('position') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position }}"{{ $employee->position == $position ? 'selected' : '' }}>@lang("cruds.$position.title_singular")</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="salary_type">@lang('global.salary_type')</label>
                                <select name="salary_type" class="form-control select2 {{ $errors->has('salary_type') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($salary_types as $salary_type)
                                        <option value="{{ $salary_type }}"{{ $employee->salary_type == $salary_type ? 'selected' : '' }}>@lang("global.$salary_type")</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('hr.employee.index', $status) }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn bg-main text-main btn-sm float-right">{{ trans('global.update') }}</button>
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