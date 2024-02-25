<script>
    var driverTrackText = `<div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-4 col-sm-4 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="diver_id"></label>
                                <select name="driver[driver_id][]" class="form-control select2append {{ $errors->has('driver.driver_id') ? 'is-invalid' : '' }}">
                                    <option value="" selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($drivers as $id => $name)
                                        <option value="{{ $id }}"{{ ($track ? $track->driver_id : old('driver_id')) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('driver.driver_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('driver.driver_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-3 col-sm-3 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="fee"></label>
                                <input type="number" name="driver[fee][]" placeholder="@lang('global.number_placeholder')" class="form-control {{ $errors->has('driver.fee') ? 'is-invalid' : '' }}" />
                                @if($errors->has('driver.fee'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('driver.fee') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-3 col-sm-3 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="is_paid"></label>
                                <select name="driver[is_paid][]" class="form-control select2append {{ $errors->has('driver.is_paid') ? 'is-invalid' : '' }}">
                                    <option value="" selected>{{ trans('global.please_select') }}</option>
                                    <option value="paid" {{ ($track ? $track->is_paid : old('drive_fee')) == 'paid' ? 'selected' : '' }}>@lang('global.paid')</option>
                                    <option value="unpaid" {{ ($track ? $track->is_paid : old('drive_fee')) == 'unpaid' ? 'selected' : '' }}>@lang('global.unpaid')</option>
                                </select>
                                @if($errors->has('driver.is_paid'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('driver.is_paid') }}
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
    $('.driver-track-plus').click(function() {
        $('.driver-track-append').append(driverTrackText);
        $('.select2append').select2({
            width: '100%',
            placeholder: "‌ရွေးချယ်ပါ"
        });
    });
    $(document).on('click', '.driver-track-minus', function() {
        $(this).closest('.row').remove();
    })
</script>
