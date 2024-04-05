<script>
    var driverTrackText = `<div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
                            <div class="form-group">
                                <label class="required mb-2" for="diver_id"></label>
                                <select name="driver[driver_id][]" class="form-control select2append {{ $errors->has('driver.driver_id') ? 'is-invalid' : '' }}">
                                    <option value="" selected>{{ trans('global.please_select') }}</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}"{{ ($track ? $track->driver_id : old('driver_id')) == $driver->id ? 'selected' : '' }}>{{ $driver->name }} ( @lang("global.$driver->salary_type") )</option>
                                    @endforeach
                                </select>
                                @if($errors->has('driver.driver_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('driver.driver_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-5 col-sm-5 mb-2">
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
                        
                        <div class="col-xl-1 col-lg-1 col-md-1 col-1 pt-2 mt-4">
                            <button type="button" class="btn btn-sm btn-danger driver-track-minus">
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
