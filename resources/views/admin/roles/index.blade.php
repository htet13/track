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
      <h1>{{ trans('cruds.role.title') }}</h1>
    </div><!-- End Page Title -->

    @if (Session::has('msg'))
    <div class="alert @if(Session::get("status") == 'true') alert-success @else alert-danger @endif alert-dismissible fade show" role="alert">
        {{ Session::get("msg") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <section class="role-table">
        <div class="card p-2">
            <div class="row mb-2">
                <div class="col-md-12">
                    <a class="btn btn-primary text-white" style="float:right" href="{{ route('admin.role.create') }}">
                        <i class="fa-solid fa-plus"></i>{{ trans('global.new') }}{{ trans('global.add') }}
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('global.name') }}</th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr id="row{{ $role->id }}">
                                <td>{{ $loop->iteration + $roles->firstItem() - 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at->format('d-m-Y | h:i:s') }}</td>
                            <td>
                                <div class="d-flex">
                                        <a href="{{ route('admin.role.show', $role) }}" class="pe-3" title="Role Details">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.role.edit', $role) }}" class="pe-3" title="Edit Role Details">
                                            <i class="fa-regular fa-pen-to-square text-success"></i>
                                        </a>
                                    <form action="{{ route('admin.role.destroy', $role) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a class="pe-3 delete text-danger" title="Delete role">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </form>
                                </div>
                            </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">
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
                        {{ $roles->appends(request()->input())->links() }}
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
