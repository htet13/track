<header id="header" class="header fixed-top d-flex align-items-center bg-main">
    <div class="d-flex flex-row justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.home') }}" class="logo d-flex align-items-center text-decoration-none">
                <img src="{{ asset('images/logo.png') }}" alt="" class="rotate" class="mr-2">
                <span class="d-none d-lg-block">{{ trans('global.web_title') }}</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <div class="text-main mx-3">
            <a href="{{ route('admin.logout') }}" class="text-decoration-none text-main fs-5">
                <i class="fa-solid fa-power-off"></i>
            </a>
        </div>
    </div>
</header>