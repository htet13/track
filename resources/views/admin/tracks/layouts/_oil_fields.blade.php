<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
        <div class="form-group">
            <label class="required mb-2" for="liter">@if($loop->first) @lang('global.liter') @endif</label>
            <input id="allow-decimal" value="{{ $fieldValue }}" name="{{ $fieldName }}" placeholder="@lang('global.number_placeholder')" class="form-control {{ $errors->has($errorName) ? 'is-invalid' : '' }}" />
            @if($errors->has($errorName))
                <div class="invalid-feedback">
                    {{ $errors->first($errorName) }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
        <div class="form-group">
            <label class="required mb-2" for="price">@if($loop->first) @lang('global.price') @endif</label>
            <input type="number" value="{{ $fieldPriceValue }}" name="{{ $fieldPriceName }}" placeholder="@lang('global.number_placeholder')" class="form-control {{ $errors->has($errorPriceName) ? 'is-invalid' : '' }}" />
            @if($errors->has($errorPriceName))
                <div class="invalid-feedback">
                    {{ $errors->first($errorPriceName) }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-xl-1 col-lg-1 col-md-1 col-{{ $loop->first ? '2' : '1' }} col-sm-{{ $loop->first ? '2' : '1' }} pt-2 mt-4">
        <button type="button" class="btn btn-sm {{ $loop->first ? 'bg-main text-main liter-price-plus' : 'btn-danger liter-price-minus' }}">
            <i class="fas {{ $loop->first ? 'fa-plus' : 'fa-minus' }}"></i>
        </button>
    </div>
</div>
