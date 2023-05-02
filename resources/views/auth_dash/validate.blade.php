@extends('auth_dash.layout')
@section('dash_auth_title')
    تایید شماره موبایل
@endsection
@section('dash_auth_content')
    <div class="container">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-md-10 my-2 alert-dive ">
                @include('auth_dash.alert')
            </div>
        </div>

        <div class="row">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="#" class="mb-12">
                    {{-- <img alt="Logo" src="#" class="h-40px"/>--}}
                    وب سولو
                </a>
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto admin-validate-form">
                    <form action="{{ route('admin.validate.mobile') }}" method="post" class="form w-100 mb-10"  novalidate="novalidate">
                        @csrf
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">ورود دو مرحله ای</h1>
                            <div class="text-muted fw-bold fs-5 mb-5">وارد کردن کد تایید ارسال شده به شما</div>
                        </div>
                        @if(session()->exists('admin_email'))
                            <input type="hidden"  id="email" value="{{ session()->get('admin_email') }}">
                        @endif
                        <div class="mb-10 px-md-10">
                            <label for="mobile" class="form-label fs-6 fw-bolder text-dark">شماره موبایل</label>
                            <input class="form-control form-control-lg form-control-solid"
                                   name="mobile"
                                   id="mobile"
                                   type="text"  />
                        </div>
                        @error('mobile')
                        <div class="alert fv-row alert-danger mb-10">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="mb-10 px-md-10">
                            <label class="fw-bolder text-start text-dark fs-6 mb-1 ms-1" for="code">کد فعال سازی را وارد کنید</label>
                            <input class="form-control form-control-lg form-control-solid"
                                   id="code"
                                   type="text"
                                   name="code"/>
                            @error('code')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-10 px-md-10">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" wire:model="remember" name="remember"> من را به خاطر بسپار !
                            </label>
                        </div>
                        <div class="d-flex flex-center">
                            <button type="submit"  class="btn btn-lg btn-primary fw-bolder">
                                <span class="indicator-label">ورود</span>
                            </button>
                        </div>
                    </form>
                    <div class="text-center fw-bold fs-5">
                       <div><span class="text-muted me-1">هنوز کد را دریافت نکرده اید؟</span></div>
                        <a href="#"  id="resend_token" onclick="startTimer()" class="link-primary fw-bolder fs-5 me-1">ارسال دوباره</a>
                        <a id="timer" class="timer"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_scripts')
    <script>
        let counter = 0;
        let remainingSeconds = 0;
        let timer = document.getElementById('timer');
        let resend = document.getElementById('resend_token');
        let timerInterval;
        function displayTime(s) {
            let min = Math.floor(s / 60);
            let sec = s % 60;
            return min.toString().padStart(2, "0") + ':' + sec.toString().padStart(2, "0");
        }
        // default timer div element display in none
        timer.style.display = 'none';
        // for display timer in timer div element
        timer.innerHTML = (displayTime(remainingSeconds - counter)).toString();
        function startTimer() {
            resend.style.display = 'none';
            timer.style.display = 'block';
            remainingSeconds = 60;
            timerInterval = setInterval(() => {
                counter++;
                timer.innerHTML = (displayTime(remainingSeconds - counter)).toString();
                if (counter === remainingSeconds) {
                    // for stop the timer if counter & timeLeft is equal
                    clearInterval(timerInterval);
                    counter = 0;
                    timer.style.display = 'none';
                    resend.style.display = 'block';
                }
            }, 1000);
        }


        $(document).on('click', '#resend_token', function (event) {
            event.preventDefault();
            let number = document.getElementById('number').value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '{{ route('admin.resend.code') }}',
                data: {number:number}
            }).done(function (data) {
                    console.log(data);
                if (data['status'] === 200) {
                    Toastify({
                        text:data['message'],
                        duration:3000,
                        gravity: "top",
                        position: "center",
                        stopOnFocus: true,
                        style:{
                            background:"linear-gradient(to right, #00b09b, #96c93d)",
                        }
                    }).showToast();
                }
            }).fail(function (data) {
                if (data['status'] === 500) {
                    alert(data['message'])
                }
            });
        })
    </script>
@endpush
