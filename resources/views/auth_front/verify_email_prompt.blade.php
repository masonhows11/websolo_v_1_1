@extends('front.include.master_auth')
@section('page_title')
    ارسال ایمیل تایید
@endsection
@section('main_content')
    <div class="container">
        <div class="alert-section mt-2">
            @include('front.include.alert')
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-5 col-lg-5 col-md-5 border border-2 rounded-3 my-5">

                <form action="{{ route('resend.verify.email') }}" method="post" class="d-flex flex-column py-4">
                    @csrf
                    @if(session()->has('newEmail'))
                        <input type="hidden" class="form-control" value="{{ session('newEmail') }}" id="email"
                               placeholder="Enter email" name="email">
                    @endif
                    <div class="d-flex flex-column">
                        <h5 class="text-center py-3">کاربر گرامی به سایت وب سولو خوش آمدید.</h5>
                        <p>ثبت نام شما با موفقیت انجام شد.برای فعال سازی حساب کاربری خود،ایمیل ارسالی حاوی لینک فعال
                            سازی را بررسی کنید.</p>
                        <p>در صورت دریافت نکردن ایمیل روی لینک <span class="text-dark">ارسال مجدد کلیک کنید.</span></p>
                        <p>با تشکر.</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="btn btn-outline-secondary">ارسال مجدد ایمیل فعال سازی</button>
                    </div>
                </form>

            </div>
        </div>


    </div>
@endsection
