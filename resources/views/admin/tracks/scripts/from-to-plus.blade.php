<script>
    var fromText = `<div class="row">
                        <div class="col-xl-10 col-lg-10 col-md-10 col-8 col-sm-8 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="fromcities"></label>
                                <select name="fromcities[]" id="fromcities" class="form-control {{ $errors->has('fromcities') ? 'is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($cities as $id => $name)
                                        <option value="{{ $id }}"{{ in_array($id, old('fromcities', [])) ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('fromcities'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fromcities') }}
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
                    <div class="col-xl-10 col-lg-10 col-md-10 col-8 col-sm-8 mb-2">
                        <div class="form-group">
                            <label class="required mb-2" for="tocities"></label>
                            <select name="tocities[]" id="tocities" class="form-control {{ $errors->has('tocities') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.please_select') }}</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}"{{ in_array($id, old('tocities', [])) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tocities'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tocities') }}
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