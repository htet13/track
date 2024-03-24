<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
<div class="btn-outline-gold p-2 d-flex flex-column justify-content-center align-items-center">
    <strong class="text-center">Logistics System</strong>
    <span style="font-size: 12px;">( Partial Version )</span>
</div>
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/logistics*') ? 'collapsed' : '' }}" href="{{ route('admin.logistics', ['interval' => 'weekly']) }}">
                <div class="me-2">
                    <i class="bi bi-grid"></i>
                </div>
                <div class="">
                    <span>{{ trans('global.dashboard') }}</span>
                </div>
            </a>
        </li><!-- End Dashboard Nav -->

        @can('Car No Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/car-no*') ? 'collapsed' : '' }}" href="{{ route('admin.car-no.index') }}">
                <div class="me-2">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.car_no.title') }}</span>
                </div>
            </a>
        </li>
        @endcan

        @can('City Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/city*') ? 'collapsed' : '' }}" href="{{ route('admin.city.index') }}">
                <div class="me-2">
                    <i class="fa-solid fa-city"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.city.title') }}</span>
                </div>
            </a>
        </li>
        @endcan

        @can('Issuer Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/issuer*') ? 'collapsed' : '' }}" href="{{ route('admin.issuer.index') }}">
                <div class="me-2">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.issuer.title') }}</span>
                </div>
            </a>
        </li>
        @endcan

        @can('Track Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/tachileik/departure/track*') || !request()->is('admin/other/departure/track*')  ? 'collapsed' : '' }} " data-bs-target="#departure-track-nav" data-bs-toggle="collapse" href="#">
                <div class="me-1">
                    <i class="fa-solid fa-truck-fast"></i>                
                </div>
                <div class="">
                    <span>{{ trans('cruds.track.title') }}(ထွက်ခွါ)</span>
                </div>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="departure-track-nav" class="nav-content collapse {{ request()->is('admin/tachileik/departure/track*') || request()->is('admin/other/departure/track*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/tachileik/departure/track*') ? 'active' : ''}}" href="{{ route('admin.track.index', ['tachileik','departure']) }}">
                        <i class="bi bi-circle"></i><span>@lang('global.tachileik')</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/other/departure/track*') ? 'active' : '' }}" href="{{ route('admin.track.index', ['other','departure']) }}">
                        <i class="bi bi-circle"></i><span>@lang('global.other')</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/tachileik/arrival/track*') || !request()->is('admin/other/arrival/track*')  ? 'collapsed' : '' }} " data-bs-target="#arrival-track-nav" data-bs-toggle="collapse" href="#">
                <div class="me-1">
                    <i class="fa-solid fa-car"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.track.title') }}(ရောက်ရှိ)</span>
                </div>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="arrival-track-nav" class="nav-content collapse {{ request()->is('admin/tachileik/arrival/track*') || request()->is('admin/other/arrival/track*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/tachileik/arrival/track*') ? 'active' : ''}}" href="{{ route('admin.track.index', ['tachileik','arrival']) }}">
                        <i class="bi bi-circle"></i><span>@lang('global.tachileik')</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/other/arrival/track*') ? 'active' : '' }}" href="{{ route('admin.track.index', ['other','arrival']) }}">
                        <i class="bi bi-circle"></i><span>@lang('global.other')</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('Report Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/other/report*') || !request()->is('admin/tachileik/report*') ? 'collapsed' : '' }}" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
                <div class="me-1">
                    <i class="fa fa-flag"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.report.title') }}</span>
                </div>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="report-nav" class="nav-content collapse {{ request()->is('admin/tachileik/report*') || request()->is('admin/other/report*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/tachileik/report*') ? 'active' : ''  }}" href="{{ route('admin.report','tachileik') }}">
                        <i class="bi bi-circle"></i><span>@lang('global.tachileik')</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/other/report*') ? 'active' : '' }}" href="{{ route('admin.report','other') }}">
                        <i class="bi bi-circle"></i><span>@lang('global.other')</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('User Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/user*') || !request()->is('admin/role*') ? 'collapsed' : '' }}" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                <div class="me-1">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.user_management.title') }}</span>
                </div>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse {{ request()->is('admin/user*') || request()->is('admin/role*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('admin/user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                        <i class="bi bi-circle"></i><span>{{ trans('cruds.user.title') }}</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('admin/role*') ? 'active' : '' }}" href="{{ route('admin.role.index') }}">
                        <i class="bi bi-circle"></i><span>{{ trans('cruds.role.title') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
    </ul>

</aside><!-- End Sidebar-->