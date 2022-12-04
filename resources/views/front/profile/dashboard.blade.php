@extends('front.profile.master_dash')
@section('page_title')
    پروفایل کاربر
@endsection
@section('info_dash_left_side')
    <div class="container">
        <div class="col-xl-12 col-lg-12 col-md-10 d-flex flex-column dash-index">

            <div class="col-xl-10 my-4 dash-index-header py-2">
                <h6>داشبورد</h6>
            </div>

            <div class="dash-index-info-title mt-5 py-2 px-3">
                اطلاعات کاربر
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 my-4 dash-index-info">
                <div class="row mx-auto my-3">
                    <div class="col-lg-6 info-value"> نام کاربری : {{ $user->name == null ? 'ثبت نشده' : $user->name }}</div>
                    <div class="col-lg-6 info-value"> آدرس ایمیل : {{ $user->email  == null ? 'ثبت نشده' : $user->email }}</div>
                </div>
                <div class="row mx-auto my-3">
                    <div class="col-lg-6 info-value"> نام خانوادگی : {{ $user->last_name == null ? 'ثبت نشده' : $user->last_name }}</div>
                    <div class="col-lg-6 info-value"> نام : {{ $user->first_name  == null ? 'ثبت نشده' : $user->first_name }}</div>
                </div>
                <div class="row mx-auto my-3">
                    <div class="col-lg-6 info-value"> موبایل : {{ $user->mobile  == null ? 'ثبت نشده' : $user->mobile }} </div>
                </div>
            </div>
        </div>
    </div>
@endsection
