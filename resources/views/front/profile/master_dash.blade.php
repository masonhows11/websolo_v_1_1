@extends('front.include.master_auth')
@section('main_content')
    <div class="container">
        <div class="row row-cols-xxl-2 row-cols-xl-2   row-cols-1 user-dashboard-section">

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-xs-4 col dash_menu_right_side">

                <div class="col d-flex justify-content-center user-image-profile rounded-2">
                    <livewire:user-avatar/>
                </div>

                <div class="col user-profile-menu mt-2 rounded-2">
                    <ul class="mx-auto my-4">
                        <li class=""><i class="fa fa-home-user me-3"></i><a href="{{ route('dashboard') }}">اطلاعات کاربری</a></li>
                        <li class=""><i class="far fa-heart me-3"></i><a href="#">لیست علاقه مندی ها</a></li>
                        <li class=""><i class="far fa-message me-3"></i><a href="#">پیغام ها</a></li>
                        <li class=""><i class="fa fa-history me-3"></i><a href="#">بازدید های اخیر</a></li>
                        <li class=""><i class="fa fa-info-circle me-3"></i><a href="{{ route('edit.profile') }}">ویرایش اطلاعات کاربری</a></li>
                        <li class=""><i class="fa fa-envelope me-3"></i><a href="{{ route('edit.email.form') }}">ویرایش  آدرس ایمیل</a></li>
                        <li class=""><i class="fa fa-refresh"></i><a href="{{ route('change.password.form') }}">تغییر رمز عبور</a></li>
                        <li class=""><i class="fa fa-trash me-3"></i><a href="{{ route('delete.account') }}">حذف حساب کاربری</a></li>
                        <li class=""><i class="fa fa-sign-out me-3"></i><a href="{{ route('logout') }}">خروج</a></li>
                    </ul>
                </div>

            </div>

            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-xs-8 col info_dash_left_side  rounded-2 mt-1 ">
                @yield('info_dash_left_side')
            </div>
        </div>
    </div>
@endsection
