<script>
    var otherText = `<div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="others[][]"></label>
                                <input type="text" name="others[][]" id="others[][]" value="{{old('others[][]')}}"  class="form-control {{ $errors->has('others[][]') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('others[][]'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('others[][]') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="others[][]"></label>
                                <input type="number" name="others[][]" id="others[][]" value="{{old('others[][]')}}"  class="form-control {{ $errors->has('others[][]') ? 'is-invalid' : '' }}"/>
                                @if($errors->has('others[][]'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('others[][]') }}
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
    $('.other-plus').click(function() {
        $('.other-append').append(otherText);
    });
    $(document).on('click', '.other-minus', function() {
        $(this).closest('.row').remove();
    })
</script>