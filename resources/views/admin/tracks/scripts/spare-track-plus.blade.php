<script>
    var spareTrackText = `<div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="diver_id"></label>
                                <select name="spare[spare_id][]" class="form-control select2append {{ $errors->has('spare.spare_id') ? 'is-invalid' : '' }}">
                                    <option value="" selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($spares as $id => $name)
                                        <option value="{{ $id }}"{{ ($track ? $track->spare_id : old('spare_id')) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('spare.spare_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('spare.spare_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="fee"></label>
                                <input type="number" name="spare[fee][]" placeholder="@lang('global.number_placeholder')" class="form-control {{ $errors->has('spare.fee') ? 'is-invalid' : '' }}" />
                                @if($errors->has('spare.fee'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('spare.fee') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-xl-1 col-lg-1 col-md-1 col-1 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-danger spare-track-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>`;
    $('.spare-track-plus').click(function() {
        $('.spare-track-append').append(spareTrackText);
        $('.select2append').select2({
            width: '100%',
            placeholder: "‌ရွေးချယ်ပါ"
        });
    });
    $(document).on('click', '.spare-track-minus', function() {
        $(this).closest('.row').remove();
    })
</script>
