@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}"><h1>{{ trans('cruds.user.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.info') }}{{ trans('global.update') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="user-table">
        <div class="card p-2">
            {{-- <div class="card-header">
                <h5>{{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}</h5>
            </div> --}}
            <div class="card-body p-2">
                <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('global.name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="email">{{ trans('global.email') }}</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label for="password">{{ trans('global.password') }}</label>
                                <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="roles">{{ trans('cruds.user.fields.role') }}</label>
                                <select name="roles[]" id="role" class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}" multiple>
                                    <option value="" disabled>{{ trans('global.please_select') }}</option>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{ $value }}"{{ in_array($value, old('roles', [])) || $user->roles->contains($value) ? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('roles'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('roles') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.user.index') }}">{{ trans('global.cancel') }}</a>
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
