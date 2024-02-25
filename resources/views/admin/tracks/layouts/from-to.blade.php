<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
        <div class="form-group">
            <label class="required mb-2" for="fromcities">{{ trans('global.from') }}</label>
            <select name="fromcities[]" class="form-control select2 {{ $errors->has('fromcities') ? 'is-invalid' : '' }}" multiple>
                <option value="" disabled>{{ trans('global.please_select') }}</option>
                @foreach ($cities as $id => $name)
                    <option value="{{ $id }}"{{ ($track ? $track->fromcities->contains($id) : in_array($id, old('fromcities', []))) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @if($errors->has('fromcities'))
                <div class="invalid-feedback">
                    {{ $errors->first('fromcities') }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
        <div class="form-group">
            <label class="required mb-2" for="tocities">{{ trans('global.to') }}</label>
            <select name="tocities[]" class="form-control select2 {{ $errors->has('tocities') ? 'is-invalid' : '' }}" multiple>
                <option value="" disabled>{{ trans('global.please_select') }}</option>
                @foreach ($cities as $id => $name)
                    <option value="{{ $id }}"{{ ($track ? $track->tocities->contains($id) : in_array($id, old('tocities', []))) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @if($errors->has('tocities'))
                <div class="invalid-feedback">
                    {{ $errors->first('tocities') }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="line-break"></div>