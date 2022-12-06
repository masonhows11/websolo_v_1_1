<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>
    <link rel="icon" type="image/x-icon" href="#">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}"/>
    @include('front.include.header_styles')
    @livewireStyles
</head>
<body>
<!-- header responsive-->
@include('front.include.side_navbar')
<!-- header  -->
@include('front.include.navbar')
<!-- main-content -->
<section class="main-content">
    @yield('main_content')
</section>
<!-- footer -->
@include('front.include.footer')
<!-- footer scripts -->
@livewireScripts

@include('front.include.footer_scripts')
<!-- custom scripts -->
@stack('front_custom_scripts')
</body>
</html>

