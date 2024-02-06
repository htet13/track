@extends('layouts.app')

@section('styles')
{{-- sweet alert --}}
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<style>
.delete{
    cursor: pointer;
}
</style>
@endsection
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.user.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="user-table">
        <div class="card p-2">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="{{ route('admin.user.index') }}" method="GET">
                            <div class="input-group">
                               <input type="text" id="name" name="name" class="form-control" placeholder="@lang('global.search')" value="{{ request('name') }}" />
                                <button class="btn btn-outline-main" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex" style="float:right">
                            @can('Excel Export')
                            <form action="{{ route('admin.user.export') }}" method="GET">
                                <input type="hidden" name="export_key" value="{{ $key ?? '' }}"/>
                                <button class="btn btn-success me-2" type="submit">
                                    {{ trans('global.excel') }} {{ trans('global.export') }}
                                </button>
                            </form>
                            @endcan
                            <a class="btn bg-main text-main" href="{{ route('admin.user.create') }}">
                                <i class="fa-solid fa-plus"></i> {{ trans('global.new') }}{{ trans('global.add') }} 
                            </a>
                        </div>
                    </div>
                </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('global.name') }}</th>
                    <th>{{ trans('global.email') }}</th>
                    <th>{{ trans('cruds.user.fields.role') }}</th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr id="row{{ $user->id }}">
                                <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-success rounded-pill">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->created_at->format('d-m-Y | h:i:s') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.user.show', $user) }}" class="pe-3" title="User Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.user.edit', $user) }}" class="pe-3" title="Edit User Details">
                                        <i class="fa-regular fa-pen-to-square text-success"></i>
                                    </a>
                                    <form action="{{ route('admin.user.destroy', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a class="pe-3 delete text-danger" title="Delete User">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </form>
                                </div>
                            </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                {{ trans('global.no_data_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div style="float:right">
                        {{ $users->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('scripts')
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
$('.delete').on('click', function(){
    Swal.fire({
        title: 'Warning!',
        text: 'Do you really want to delete?',
        icon: 'warning',
        confirmButtonText: 'Yes',
        showCancelButton: true,
    }).then((result) => {
        if(result.isConfirmed){
            $(this).parent().submit()
        }
    })
})
</script>
@endsection
