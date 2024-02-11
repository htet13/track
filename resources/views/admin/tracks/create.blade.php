@php $route = route('admin.track.store',$type); @endphp
@include('admin.tracks._form',
    [   
        'track' => "",
        'form_type'=>"create",
        'method' =>"POST",
        'route' => $route,
        'btn'=>"Submit"
    ]
)