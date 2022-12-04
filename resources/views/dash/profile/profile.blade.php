@extends('dash.include.master')
@section('dash_page_title')
    پروفایل مدیریت
@endsection
@section('dash_main_content')
    <div class="container">


        <div class="row admin-profile-section">
            <div class="col-lg-5  admin-profile-info">

                <form action="{{--{{ route('admin.updateProfile') }}--}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{--{{ $admin->id }}--}}">

                    <div
                        class="image-wrapper d-flex flex-column justify-content-center align-content-center align-items-center">

                        <div class="image-content">
                            <img class="rounded-circle" id="image_admin"
                                 src="{{--{{ $admin->image_path ?  asset('storage/admin_images/'.$admin->image_path)  : asset('assets/dash/images/no-user.png') }}--}}"
                                 alt="">
                        </div>

                        <div class="d-flex my-2 userAvatarFile">
                            <label for="image_select">
                                آپلود عکس
                                <input type="file" class="btn btn-info" name="image_path" id="image_select">
                            </label>
                        </div>
                        @error('image_path')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="form-group my-5">
                        <label for="user" class="form-label">نام کاربری:</label>
                        <input type="text" name="name" class="form-control" value="{{--{{ $admin->name }}--}}" id="user">
                        @error('name')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group my-5">
                        <label for="firstName" class="form-label">نام:</label>
                        <input type="text" name="first_name" class="form-control" value="{{--{{ $admin->first_name }}--}}" id="firstName">
                        @error('first_name')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group my-5">
                        <label for="lastName" class="form-label">نام خانوادگی:</label>
                        <input type="text" name="last_name" class="form-control" value="{{--{{ $admin->last_name }}--}}" id="lastName">
                        @error('last_name')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group my-5">
                        <label for="email" class="form-label">ایمیل:</label>
                        <input type="email" name="email" class="form-control" value="{{--{{ $admin->email}}--}}" id="email">
                        @error('email')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group my-5 d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">ویرایش اطلاعات</button>
                        <a href="{{--{{  route('admin.editMobile') }}--}}" class="btn btn-success">تغییر شماره موبایل</a>
                        <a href="{{--{{ route('admin.dashboardAdmin') }}--}}" class="btn btn-secondary">بازگشت</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
@push('custom_scripts')
    <script>
        $(document).ready(function () {
            $('#image_select').change(function (e) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#image_admin').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        @if(session()->has('success'))
        Toastify({
            text: '{{ session('success') }}',
            duration: 3000,
            gravity: "top",
            position: "center",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
        }).showToast();
        @endif
    </script>
@endpush
