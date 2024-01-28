@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}"><h1>{{ trans('cruds.role.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.role.title_singular') }} {{ trans('global.show') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="role-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                   <tr>
                        <th>
                            {{ trans('global.name') }}
                        </th>
                        <td>
                            {{ $role->name }}
                        </td>
                   </tr>
                   <tr>
                        <th>
                            {{ trans('cruds.permission.title') }}
                        </th>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <span class="badge bg-info rounded-pill">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                   </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div style="float: right">
                        <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.role.index') }}">{{ trans('global.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
