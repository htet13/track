<header id="header" class="header fixed-top d-flex align-items-center bg-main">

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.home') }}" class="logo d-flex align-items-center text-decoration-none">
      <img src="{{ asset('images/logo.png') }}" alt="" class="rotate" class="mr-2">
      <span class="d-none d-lg-block">{{ trans('global.web_title') }}</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">

      <a class="nav-link nav-profile d-flex align-items-center pe-0 text-main" href="#" data-bs-toggle="dropdown">
        {{-- <img src="{{ asset('img/profile-img.jpg') }}" alt="Profile" class="rounded-circle"> --}}
        <span class="d-md-block dropdown-toggle px-2">{{ Auth::user()->name }}</span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>{{ Auth::user()->name }}</h6>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li> -->
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
            <i class="bi bi-box-arrow-right"></i>
            <span>{{ trans('global.logout') }}</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->

  </nav><!-- End Icons Navigation -->

</header>