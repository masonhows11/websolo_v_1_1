@extends('front.profile.master_dash')
@section('page_title')
    ویرایش پروفایل کاربری
@endsection
@section('info_dash_left_side')
    <div class="container">
        <div class="col-xl-12 col-lg-12 col-md-10  dash-index">

            <div class="dash-index-info-title mt-3 mb-5 py-2 px-3">
                تغییر رمز عبور
            </div>

            <div class="profile-alert">
                @include('front.include.alert')
            </div>

            <div class="row my-3">
                <form action="{{ route('change.password') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="user-email" class="form-label">ایمیل</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="user-email"
                               name="email" value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="current-pass" class="form-label">رمز عبور جاری</label>
                        <input type="password" id="current-pass" name="oldPassword"
                               class="form-control @error('oldPassword') is-invalid @enderror">
                        @error('oldPassword')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new-pass" class="form-label">رمز عبور جدید</label>
                        <input type="password" id="new-pass" name="newPassword"
                               class="form-control @error('newPassword') is-invalid @enderror">
                        @error('newPassword')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pwd-confirm" class="form-label">تکرار رمز عبور جدید</label>
                        <input type="password" id="pwd-confirm"  name="newPassword_confirmation"
                               class="form-control @error('newPassword') is-invalid @enderror">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">ویرایش</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">انصراف</a>
                    </div>

                </form>
            </div>


        </div>
    </div>
@endsection
