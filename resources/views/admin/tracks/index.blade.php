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
      <h1>{{ trans('cruds.track.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="route-table">
        <div class="card p-2">

            <form action="{{ route('admin.track.index') }}" method="GET">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select name="from" id="from" class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.from') }}</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}"{{ old('from') || request('from') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <select name="to" id="to" class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}">
                                <option value="" disabled selected>{{ trans('global.to') }}</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}"{{ old('to') || request('to') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" value="{{ request('from_date') }}" />
                            <input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date" value="{{ request('to_date') }}" />
                            <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex" style="float:right">
                            @can('Excel Export')
                            <button class="btn btn-success me-2" type="submit" value="Export" name="btn">
                                {{ trans('global.excel') }} {{ trans('global.export') }}
                            </button>
                            @endcan
                        
                            <a class="btn btn-primary text-white" href="{{ route('admin.track.create') }}">
                                <i class="fa-solid fa-plus"></i>{{ trans('global.new') }}{{ trans('global.add') }} 
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('global.from') }}</th>
                    <th>{{ trans('global.to') }}</th>
                    <th>{{ trans('global.total') }}</th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($tracks as $index => $track)
                            <tr id="row{{ $track->id }}">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $track->fromCity->name }}</td>
                                <td>{{ $track->toCity->name }}</td>
                                <td>{{ number_format($track->amount) }}</td>
                                <td>{{ $track->created_at->format('d-m-Y | h:i:s') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.track.show', $track) }}" class="pe-3" title="route Details">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        @if($track->action_mode == 'on')
                                        <a href="{{ route('admin.track.edit', $track) }}" class="pe-3" title="Edit route Details">
                                            <i class="fa-regular fa-pen-to-square text-success"></i>
                                        </a>
                                        @endif
                                        <form action="{{ route('admin.track.destroy', $track) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a class="pe-3 delete text-danger" title="Delete Track">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
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
                        {{ $tracks->appends(request()->input())->links() }}
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
flatpickr('#from_date', {
    enableTime: false, // If you want to enable time as well
    dateFormat: "Y-m-d", // Specify your desired date format
    placeholder: "From Date"
});

flatpickr('#to_date', {
    enableTime: false, // If you want to enable time as well
    dateFormat: "Y-m-d", // Specify your desired date format
    placeholder: "To Date"
});
</script>
@endsection
