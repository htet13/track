@php $colors = ["antiquewhite", "aliceblue", "#94d3d3", "#88e0c3", "beige", "#80a6de", "#2cadc4", "#aaadb0"] @endphp

<div class="row">
    @forelse ($tracks as $index => $track)        
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="background-color: {{ $index < count($colors) ? $colors[$index] : 'antiquewhite' }}">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-200 text-uppercase mb-1">
                                {{ $track->issuer->name }}
                            </div>
                            <div class="h6 mb-0 font-weight-bold mt-3">{{ number_format($track->total_expense) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-vihara fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center align-middle mt-3">
        {{ trans('global.no_data_found') }}
        </div>
    @endforelse
</div>