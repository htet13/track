@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}"><h1>{{ trans('cruds.user.title') }}</h1></a></li>
          <li class="breadcrumb-item active">{{ trans('global.show') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="user-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                   <tr>
                        <th>
                            {{ trans('global.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                   </tr>
                   <tr>
                        <th>
                            {{ trans('global.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                   </tr>
                   <tr>
                        <th>
                            {{ trans('cruds.user.fields.role') }}
                        </th>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-success rounded-pill p-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                   </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div style="float: right">
                        <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.user.index') }}">{{ trans('global.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
