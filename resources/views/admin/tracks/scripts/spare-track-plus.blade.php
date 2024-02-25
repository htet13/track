<script>
    var spareTrackText = `<div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-4 col-sm-4 mb-2">
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
                        <div class="col-xl-4 col-lg-4 col-md-4 col-3 col-sm-3 mb-2">
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
                        <div class="col-xl-3 col-lg-3 col-md-3 col-3 col-sm-3 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="is_paid"></label>
                                <select name="spare[is_paid][]" class="form-control select2append {{ $errors->has('spare.is_paid') ? 'is-invalid' : '' }}">
                                    <option value="" selected>{{ trans('global.please_select') }}</option>
                                    <option value="paid" {{ ($track ? $track->is_paid : old('drive_fee')) == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                                    <option value="unpaid" {{ ($track ? $track->is_paid : old('drive_fee')) == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
                                </select>
                                @if($errors->has('spare.is_paid'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('spare.is_paid') }}
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
