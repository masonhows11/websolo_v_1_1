<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl" lang="fa">
<head>
    <title>@yield('dash_page_title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="#"/>
    @include('dash.include.header_styles')
    @livewireStyles
</head>
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        {{-- start sidebar   --}}
        @include('dash.include.sidebar')
        {{-- end sidebar   --}}
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            {{--  start header --}}
            @include('dash.include.header')
            {{--  end header --}}
            {{--   begin main container      --}}
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                {{-- start header sub   --}}
                @include('dash.include.header_sub')
                {{-- end header sub   --}}
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        @yield('dash_main_content')
                    </div>
                </div>
            </div>
            {{--  end main container      --}}
            {{--  begin footer --}}
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">2022©</span>
                        <a href="#" target="_blank" class="text-gray-800 text-hover-primary">وب سولو</a>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link px-2">درباره ی ما</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link px-2">پشتیبانی</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dash.include.footer_scripts')
@stack('dash_custom_scripts')
</body>
</html>

