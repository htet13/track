<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
<div class="btn-outline-gold p-2 d-flex flex-column justify-content-center align-items-center">
    <strong class="text-center">HR System</strong>
    <span style="font-size: 12px;">( Partial Version )</span>
</div>
    <ul class="sidebar-nav" id="sidebar-nav">
        @can('Employee Access')
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('hr/new/employee') || !request()->is('hr/resign/employee') ? 'collapsed' : '' }}" data-bs-target="#employee-nav" data-bs-toggle="collapse" href="#">
                <div class="me-1">
                    <i class='fa fa-drivers-license'></i>
                </div>
                <div class="">
                    <span>{{ trans('cruds.employee.title') }}</span>
                </div>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="employee-nav" class="nav-content collapse {{ request()->is('hr/new/employee') || request()->is('hr/resign/employee') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('hr/new/employee') ? 'active' : ''  }}" href="{{ route('hr.employee.index', 'new') }}">
                        <i class="bi bi-circle"></i><span>လက်ရှိ</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('hr/resign/employee') ? 'active' : ''  }}" href="{{ route('hr.employee.index', 'resign') }}">
                        <i class="bi bi-circle"></i><span>လူဟောင်း</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
        
        <li class="nav-item">
            <a class="nav-link {{ !request()->is('hr/fee/driver') || !request()->is('hr/fee/spare') ? 'collapsed' : '' }}" data-bs-target="#fee-nav" data-bs-toggle="collapse" href="#">
                <div class="me-1">
                    <i class="fa fa-flag"></i>
                </div>
                <div class="">
                    <span>{{ trans('global.drive_fee') }}</span>
                </div>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="fee-nav" class="nav-content collapse {{ request()->is('hr/fee/driver') || request()->is('hr/fee/spare') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ request()->is('hr/fee/driver') ? 'active' : ''  }}" href="{{ route('hr.fee.driver') }}">
                        <i class="bi bi-circle"></i><span>@lang('cruds.driver.title_singular')</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('hr/fee/spare') ? 'active' : ''  }}" href="{{ route('hr.fee.spare') }}">
                        <i class="bi bi-circle"></i><span>@lang('cruds.spare.title_singular')</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside><!-- End Sidebar-->