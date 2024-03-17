<header id="header" class="header fixed-top d-flex align-items-center bg-main">
    <div class="d-flex align-items-center w-100">
        <div class="d-flex align-items-center justify-content-between" style="width: 33% !important;">
            <a href="{{ route('admin.home') }}" class="logo d-flex align-items-center text-decoration-none">
                <img src="{{ asset('images/logo.png') }}" alt="" class="rotate" class="mr-2">
                <span class="d-none d-lg-block">{{ trans('global.web_title') }}</span>
            </a>
        </div><!-- End Logo -->
        <div class="text-main fw-bold" style="width: 33%; text-align:center">WAREHOUSE</div>
        <div class="text-main mx-3" style="width: 33%; text-align:end">
            <a href="{{ route('admin.logout') }}" class="text-decoration-none text-main fs-5">
                <i class="fa-solid fa-power-off"></i>
            </a>
        </div>
    </div>
</header>