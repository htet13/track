<script>
    var literPriceText = `<div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2"></label>
                                <input type="number" name="oil[liter][]" placeholder="@lang('global.number_placeholder')" id="liter" class="form-control {{ $errors->has('oil.liter') ? 'is-invalid' : '' }}" />
                                @if($errors->has('liter'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('liter') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2"></label>
                                <input type="number" name="oil[price][]" placeholder="@lang('global.number_placeholder')" id="price" class="form-control {{ $errors->has('oil.price') ? 'is-invalid' : '' }}" />
                                @if($errors->has('price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-1 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-danger liter-price-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>`;
    $('.liter-price-plus').click(function() {
        $('.liter-price-append').append(literPriceText);
    });
    $(document).on('click', '.liter-price-minus', function() {
        $(this).closest('.row').remove();
    })
</script>