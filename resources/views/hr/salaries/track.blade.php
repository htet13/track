<section class="track-table">
    <div class="card p-2">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="border: 1px solid #959598; margin-bottom: 50px;">
                    <thead class="text-center align-middle">
                        <tr>
                            <th rowspan="2">{{ trans('global.no') }}</th>
                            <th rowspan="2" class="w-90">{{ trans('global.date') }}</th>
                            <th rowspan="2" class="w-90">{{ trans('cruds.car_no.title_singular') }}</th>
                            <th colspan="2">{{ trans('cruds.track.title_singular') }}</th>
                            <th rowspan="2">{{ trans('cruds.track.action') }}</th>
                        </tr>
                        <tr>
                            <th>{{ trans('global.from') }}</th>
                            <th>{{ trans('global.to') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse($drive_tracks as $index => $drive_track)
                        @php 
                            $track = $drive_track->track;
                        @endphp
                        <tr id="row{{ $track->id }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="w-90">{{ $track->date->format('d-m-Y') }}</td>
                            <td class="w-90">{{ $track->carNo->name }}</td>
                            <td>
                                @foreach ($track->fromcities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($track->tocities as $city)
                                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                                @endforeach
                            </td>
                            <td class="border-none">
                                <div class="d-flex justify-content-center gap-1" style="min-width: 250px;">
                                    <a class="btn btn-success" style="text-decoration: none;" href="{{ route('admin.track.index',[$track->type,'arrival','id' => $track->id]) }}" title="Driver Fee Details">
                                        ခရီးစဉ်ကြည့်ရန်
                                    </a>
                                    <a class="btn btn-main" data-bs-toggle="modal" data-bs-target="#exampleModal" class="pe-3" title="View Remarks">
                                        မှတ်ချက်ကြည့်ရန်
                                    </a>
                                </div>
                            </td>
                        </tr>
                        
                        @include('common.modal', ['remark' => $track->remark])
                        @empty
                        <tr>
                            <td colspan="22" class="text-center">
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
                        {{ $drive_tracks->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
