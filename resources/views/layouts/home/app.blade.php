<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ACT Logistics Group</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon.png') }}">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css'
        integrity='sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=='
        crossorigin='anonymous' />
    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/adminFS.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    @yield('styles')
    <style>
        h1, h2, h3, p, span, div,body,title {
            font-family: 'Pyidaungsu' !important;
        }
    </style>
</head>

<body style="overflow-x: hidden;" class="position-relative">
    <!-- ======= Header ======= -->
    @include('layouts.home.header')

    @include('sweetalert::alert')

    @yield('content')

    <!-- ======= Footer ======= -->
    @include('layouts.home.footer')

    <div id="preloader">
        <div id="loader"></div>
    </div>


    <!-- End Footer -->
</body>


<!-- Template Main JS File -->
<script src="{{ asset('js/main.js') }}"></script>

{{-- jquery cdn --}}
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
@yield('scripts')
<script type="text/javascript">
    $(window).on('load', function() {
        $('#preloader').hide();
    });
</script>

</html>
