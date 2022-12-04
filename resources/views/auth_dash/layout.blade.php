<!DOCTYPE html>
<html direction="rtl" dir="rtl" lang="fa" style="direction: rtl" >
<head>
    <title>@yield('dash_auth_title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="#" />
    @include('auth_dash.header')
</head>
<body>
@yield('dash_auth_content')
@include('auth_dash.footer')
@stack('custom_scripts')
</body>
</html>
