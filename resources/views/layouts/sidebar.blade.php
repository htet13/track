<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/home*') ? 'collapsed' : '' }}" href="{{ route('admin.home', ['interval' => 'weekly']) }}">
                <div class="me-2">
                    <i class="bi bi-grid"></i>
                </div>
                <div class="">
                    <span>{{ trans('global.dashboard') }}</span>
                </div>
            </a>
        </li><!-- End Dashboard Nav -->

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

        @can('Track Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/track*') ? 'collapsed' : '' }}" href="{{ route('admin.track.index') }}">
                <div class="me-2">
                    <i class="fa-solid fa-truck"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.track.title') }}</span>
                </div>
            </a>
        </li>
        @endcan

        @can('Report Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/report*') ? 'collapsed' : '' }} " href="{{ route('admin.report') }}">
                <div class="me-2">
                    <i class="fa fa-flag"></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.report.title') }}</span>
                </div>
            </a>
        </li>
        @endcan

        @can('User Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('admin/user*') ? 'collapsed' : '' }} " data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
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
                    <a href="{{ route('admin.user.index') }}">
                        <i class="bi bi-circle"></i><span>{{ trans('cruds.user.title') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.role.index') }}">
                        <i class="bi bi-circle"></i><span>{{ trans('cruds.role.title') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
    </ul>

</aside><!-- End Sidebar-->