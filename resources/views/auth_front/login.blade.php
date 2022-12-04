@extends('front.include.master_auth')
@section('page_title')
    ورود
@endsection
@section('main_content')
    <div class="container login-section">

        <div class="alert-section mt-2">
            @include('front.include.alert')
        </div>

        <div class="row d-flex  justify-content-center mb-5 mt-2">

            <div class="col-xl-5 col-lg-5 col-md-5 px-4">
                <div class="row d-flex flex-column">

                    <div class="col-xl-10 col-lg-10 my-3 col-md-10  border border-2 login-form-title rounded-3 py-4">
                        <h3 class="text-center">ورود به وب سولو</h3>
                    </div>

                    <div class="col-xl-10 col-lg-10 col-md-10 border border-2  rounded-3 py-4 px-4 login-form">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input type="email" class="@error('email') is-invalid @enderror form-control" id="email"
                                       name="email">
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="pwd" class="form-label">رمز عبور</label>
                                <input type="password" class="@error('password') is-invalid @enderror form-control"
                                       id="pwd" name="password">
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-check mb-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember"> منو فراموش نکن !
                                </label>
                            </div>
                            <button type="submit" class="btn btn-login w3-flat-alizarin rounded-3">ورود</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>


    </div>
@endsection

