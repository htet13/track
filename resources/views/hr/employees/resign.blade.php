@extends('layouts.hr.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>@lang('cruds.employee.title_singular')/ နှုတ်ထွက်</h1>
    </div><!-- End Page Title -->

    <form action="{{ route('hr.employee.resign.update', [$employee,$status]) }}" method="post">
        @csrf
        @method('PUT')
        <section class="track-info">
            <div class="card">
                <div class="card-header">
                <h6>{{ trans('cruds.track.title_singular') }}{{ trans('global.infos') }}</h6>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class=" mb-2" for="is_paid">@lang('global.resign')</label>
                                <select name="type" class="form-control select2">
                                    <option value="request">ကြိုတင်</option>
                                    <option value="resign" {{ $employee->status == 'resign' ? 'selected' : '' }}>@lang('global.resign')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="resign_date">@lang('global.resign_propose_date')</label>
                                <input type="text" name="resign_date" id="date" placeholder="ရက်စွဲ ရွေးချယ်ပါ။" value="{{ $employee->resign_date }}"  class="form-control {{ $errors->has('resign_date') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('resign_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('resign_date') }}
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
                                <textarea name="remark" id="remark">{{ $employee->remark }}</textarea>
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
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('hr.employee.index',$status) }}">{{ trans('global.cancel') }}</a>
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
@include('admin.tracks.scripts.common')
@endsection
