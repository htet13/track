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
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 col-sm-12 mb-2">
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
                        <div class="col-xl-1 col-lg-1 col-md-1" style="margin-top: 2rem;">
                            <button type="button" class="btn btn-sm btn-primary from-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 col-sm-12 mb-2">
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
                        <div class="col-xl-1 col-lg-1 col-md-1" style="margin-top: 2rem;">
                            <button type="button" class="btn btn-sm btn-primary to-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 from-append"></div>
                        <div class="col-6 to-append"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">{{ trans('global.total') }}</label>
                                <input type="number" name="amount" id="amount" value="{{old('amount')}}"  class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('amount') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="others">{{ trans('global.others') }}</label>
                                <select name="others[]" id="others" class="form-control {{ $errors->has('others') ? 'is-invalid' : '' }}" multiple>
                                    <option value="" disabled>{{ trans('global.please_select') }}</option>
                                    @foreach ($cities as $id => $name)
                                        <option value="{{ $id }}"{{ in_array($id, old('others', [])) ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('others'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('others') }}
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
<script>
    $(document).ready(function() {
        $('#others').select2({
            width: '100%'
        });
    });
    var fromText = `<div class="row">
                        <div class="col-xl-10 col-lg-10 col-md-10 col-10 col-sm-10 mb-2">
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
                        <div class="col-xl-2 col-lg-2 col-md-2" style="margin-top: 2rem;">
                            <button type="button" class="btn btn-sm btn-danger from-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>`;

    var toText = `<div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-10 col-sm-10 mb-2">
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
                        <div class="col-xl-2 col-lg-2 col-md-2" style="margin-top: 2rem;">
                            <button type="button" class="btn btn-sm btn-danger to-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>`;
    $('.from-plus').click(function() {
        $('.from-append').append(fromText);
    });
    $('.to-plus').click(function() {
        $('.to-append').append(toText);
    });
    $(document).on('click', '.from-minus', function() {
        $(this).closest('.row').remove();
    })
    $(document).on('click', '.to-minus', function() {
        $(this).closest('.row').remove();
    });
</script>
@endsection
