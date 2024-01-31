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
                                <label class="required mb-2" for="amount">ရက်စွဲ</label>
                                <input type="date" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
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
                                <label class="required mb-2" for="amount">ကားနံပါတ်</label>
                                <input type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr style="border: 5px solid #0d6efd">
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
                    <hr style="border: 5px solid #0d6efd">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">စရိတ်</label>
                                <input type="text" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">ထုတ်ပေးသူ</label>
                                <input type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">ယာဉ်မောင်း</label>
                                <input type="text" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">ယာဉ်နောက်လိုက်</label>
                                <input type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">လီတာ</label>
                                <input type="text" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">ဈေးနှုန်း</label>
                                <input type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">ရဲ/စစ်</label>
                                <input type="text" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">တိုးဂိတ်</label>
                                <input type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">စားစရိတ်</label>
                                <input type="text" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <label>အခြားစရိတ်</label>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">အမျိုးအမည်</label>
                                <input type="text" name="date" id="date" value="{{old('date')}}"  class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">ကုန်ကျစရိတ်</label>
                                <input type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">စုစုပေါင်း</label>
                                <input type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="amount">မှတ်ချက်</label>
                                <textarea type="text" name="car_no" id="car_no" value="{{old('car_no')}}"  class="form-control {{ $errors->has('car_no') ? 'is-invalid' : '' }}">
                                </textarea>
                                @if($errors->has('car_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('car_no') }}
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
                        <div class="col-xl-5 col-lg-5 col-md-5 col-4 col-sm-4 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="from"></label>
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
                        <div class="col-xl-1 col-lg-1 col-md-1 col-1 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-danger from-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>`;

    var toText = `<div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-4 col-sm-4 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="to"></label>
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
