<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/logo/favic.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/logo/favic.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/logo/favic.png') }}">
    <title>@yield('title') Masters Expo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.style')


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WBWLH6RG');</script>
<!-- End Google Tag Manager -->




</head>


<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WBWLH6RG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


    <div class="main">
        @yield('content')
    </div>

    @include('layouts.footer')
    @include('layouts.scripts')

</body>

</html>
