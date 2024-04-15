@extends('layouts.hr.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('hr.salary.index') }}"><h1>{{ trans('global.monthly') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }} {{ trans('global.update') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="salary-table">
        <div class="card p-2 m-0">
            <div class="card-body p-2">
                <form action="{{ route('hr.salary.update',$salary) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="payment_date">@lang('global.payment_date')</label>
                                <input type="text" name="payment_date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ $salary->payment_date }}"  class="form-control {{ $errors->has('payment_date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('payment_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payment_date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="is_paid">@lang('global.paid')/ @lang('global.unpaid')</label>
                                <select name="is_paid" class="form-control select2">
                                    <option value="paid" {{ $salary->is_paid == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                                    <option value="unpaid" {{ $salary->is_paid == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
                                </select>
                                @if($errors->has('is_paid'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_paid') }}
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
                                <textarea name="remark" id="remark">{{ $salary->remark }}</textarea>
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
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('hr.salary.index') }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn bg-main text-main btn-sm float-right">{{ trans('global.save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <a class="btn btn-success text-main my-3 track-btn">
        <span class="required"></span>{{ $salary->employee->name}}<span class="required"></span> သွားခဲ့သောခရီးစဉ်များကြည့်ရန်
    </a>
    @include('hr.salaries.track')
  </main><!-- End #main -->

@endsection
@section('scripts')
@include('admin.tracks.scripts.common')
<script>
$('.track-table').hide();

$('.track-btn').click(function(){
    $('.track-table').show();
})
</script>
@stop
