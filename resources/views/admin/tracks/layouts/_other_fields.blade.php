<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
        <div class="form-group">
            <label class="mb-2" for="category">@if($loop->first) @lang('global.category') @endif</label>
            <input type="text" value="{{ $fieldValue }}" name="{{ $fieldName }}" class="form-control {{ $errors->has($errorName) ? 'is-invalid' : '' }}" />
            @if($errors->has($errorName))
                <div class="invalid-feedback">
                    {{ $errors->first($errorName) }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
        <div class="form-group">
            <label class="mb-2" for="cost">@if($loop->first) @lang('global.cost') @endif</label>
            <input type="number" value="{{ $fieldCostValue }}" name="{{ $fieldCostName }}" placeholder="@lang('global.number_placeholder')" class="form-control {{ $errors->has($errorCostName) ? 'is-invalid' : '' }}" />
            @if($errors->has($errorCostName))
                <div class="invalid-feedback">
                    {{ $errors->first($errorCostName) }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-xl-1 col-lg-1 col-md-1 col-{{ $loop->first ? '2' : '1' }} col-sm-{{ $loop->first ? '2' : '1' }} pt-2 mt-4">
        <button type="button" class="btn btn-sm {{ $loop->first ? 'bg-main text-main other-plus' : 'btn-danger other-minus' }}">
            <i class="fas {{ $loop->first ? 'fa-plus' : 'fa-minus' }}"></i>
        </button>
    </div>
</div>
