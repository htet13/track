@php $route = route('admin.track.update',[$type,$track]); @endphp
@include('admin.tracks._form',
    [   
        'track' => $track,
        'form_type'=>"update",
        'method' =>"PATCH",
        'route' => $route,
        'btn'=>"Update"
    ]
)