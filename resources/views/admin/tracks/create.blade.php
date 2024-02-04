@php $route = route('admin.track.store'); @endphp
@include('admin.tracks._form',
    [   
        'track' => "",
        'type'=>"create",
        'method' =>"POST",
        'route' => $route,
        'btn'=>"Submit"
    ]
)