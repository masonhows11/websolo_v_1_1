@extends('front.include.master_auth')
@section('page_title')
    ثبت نام
@endsection
@section('main_content')
    <div class="container register-section">

        <div class="alert-section mt-2">
            @include('front.include.alert')
        </div>

        <div class="row d-flex justify-content-center mb-5 mt-2">


            <div class="col-xl-5 col-lg-6 col-md-6 px-4">
                <div class="row d-flex flex-column">
                    <div class="col-xl-10 col-lg-10 my-3 col-md-10  border border-2 register-form-title rounded-3 py-4">
                        <h3 class="text-center">ثبت نام در وب سولو</h3>
                    </div>
                    <div class="col-xl-10 col-lg-10  col-md-10  border border-2  rounded-3 py-4 px-4 register-form">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">نام کاربری</label>
                                <input type="text" class="@error('name') is-invalid @enderror form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input type="email" class="@error('email') is_invalid @enderror form-control" id="email"  name="email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3 mt-3">
                                <label for="pwd" class="form-label">رمز عبور</label>
                                <input type="password" class="@error('password') is-invalid @enderror form-control"
                                       id="pwd"  name="password">
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3 mt-3">
                                <label for="pwd-confirm" class="form-label">تکرار رمز عبور</label>
                                <input type="password" class="@error('password') is-invalid @enderror form-control"
                                       id="pwd-confirm"
                                       name="password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-register  w3-flat-alizarin rounded-3">عضویت</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>



@endsection

