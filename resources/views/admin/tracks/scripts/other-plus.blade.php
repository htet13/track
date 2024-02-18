<script>
    var otherText = `<div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="mb-2" for="other[][]"></label>
                                <input type="text" name="other[category][]" placeholder="အမျိုးအမည် ထည့်သွင်းပါ။" id="category" class="form-control {{ $errors->has('other.category') ? 'is-invalid' : '' }}" />
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="mb-2" for="other[][]"></label>
                                <input type="number" name="other[cost][]" placeholder="@lang('global.number_placeholder')" id="cost" class="form-control {{ $errors->has('other.cost') ? 'is-invalid' : '' }}" />
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-1 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-danger other-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>`;
    $('.other-plus').click(function() {
        $('.other-append').append(otherText);
    });
    $(document).on('click', '.other-minus', function() {
        $(this).closest('.row').remove();
    })
</script>