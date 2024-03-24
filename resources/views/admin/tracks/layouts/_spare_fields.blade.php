<div class="row">
    <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
        <div class="form-group">
            <label class="required mb-2" for="diver_id">@lang('cruds.spare.title_singular')</label>
            <select name="{{ $fieldName }}" class="form-control select2 {{ $errors->has($errorName) ? 'is-invalid' : '' }}">
                <option value="" selected>{{ trans('global.please_select') }}</option>
                @foreach ($spares as $id => $name)
                    <option value="{{ $id }}"{{ $fieldValue == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @if($errors->has($errorName))
                <div class="invalid-feedback">
                    {{ $errors->first($errorName) }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
        <div class="form-group">
            <label class="required mb-2" for="fee">@if($customLoop->first) @lang('global.drive_fee') @endif</label>
            <input type="number" value="{{ $fieldFeeValue }}" name="{{ $fieldFeeName }}" placeholder="@lang('global.number_placeholder')" class="form-control {{ $errors->has($errorFeeName) ? 'is-invalid' : '' }}" />
            @if($errors->has($errorFeeName))
                <div class="invalid-feedback">
                    {{ $errors->first($errorFeeName) }}
                </div>
            @endif
        </div>
    </div>
    <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-3 col-sm-3 mb-2">
        <div class="form-group">
            <label class="required mb-2" for="is_paid">@if($customLoop->first) @lang('global.paid')/ @lang('global.unpaid') @endif</label>
            <select name="{{ $fieldIsPaidName }}" class="form-control select2 {{ $errors->has($errorIsPaidName) ? 'is-invalid' : '' }}">
                <option value="" selected>{{ trans('global.please_select') }}</option>
                <option value="paid" {{ $fieldIsPaidValue == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                <option value="unpaid" {{ $fieldIsPaidValue == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
            </select>
            @if($errors->has($errorIsPaidName))
                <div class="invalid-feedback">
                    {{ $errors->first($errorIsPaidName) }}
                </div>
            @endif
        </div>
    </div> -->
    <div class="col-xl-1 col-lg-1 col-md-1 col-{{ $customLoop->first ? '2' : '1' }} col-sm-{{ $customLoop->first ? '2' : '1' }} pt-2 mt-4">
        <button type="button" class="btn btn-sm {{ $customLoop->first ? 'bg-main text-main spare-track-plus' : 'btn-danger spare-track-minus' }}">
            <i class="fas {{ $customLoop->first ? 'fa-plus' : 'fa-minus' }}"></i>
        </button>
    </div>
</div>
