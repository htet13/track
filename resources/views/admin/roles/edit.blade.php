@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}"><h1>{{ trans('cruds.role.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }}{{ trans('global.update') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="role-table">
        <div class="card p-2">
            {{-- <div class="card-header">
                <h5>{{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}</h5>
            </div> --}}
            <div class="card-body p-2">
                <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('global.name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="permissions">{{ trans('cruds.permission.title') }}</label>
                                <select name="permissions[]" id="role" class="form-control {{ $errors->has('permissions') ? 'is-invalid' : '' }}" multiple>
                                    <option value="" disabled>{{ trans('global.please_select') }}</option>
                                    @foreach ($permissions as $key => $value)
                                        <option value="{{ $value }}"{{ in_array($value, old('permissions', [])) || $role->permissions->contains($value) ? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('permissions'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('permissions') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.role.index') }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn bg-main text-main btn-sm float-right">{{ trans('global.update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#role').select2({
        width: '100%'
    });
});
</script>
@endsection
