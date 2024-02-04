@php $route = route('admin.track.update',$track); @endphp
@include('admin.tracks._form',
    [   
        'track' => $track,
        'type'=>"update",
        'method' =>"PATCH",
        'route' => $route,
        'btn'=>"Update"
    ]
)