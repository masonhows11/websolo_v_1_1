@extends('front.profile.master_dash')
@section('page_title')
    ویرایش پروفایل کاربری
@endsection
@section('info_dash_left_side')
    <div class="container">
        <div class="col-xl-12 col-lg-12 col-md-10  dash-index">

            <div class="row my-3">
                <form action="{{ route('edit.email') }}" method="post">
                    @csrf
                    <div class="dash-index-info-title mt-3 mb-5 py-2 px-3">
                        ایمیل کاربر
                    </div>

                    <input type="hidden" value="{{ $user->id }}" name="user">
                    <div class="col-xl-8 col-lg-8 my-3">
                        <label for="user-name" class="form-label">آدرس ایمیل :</label>
                        <input type="text"
                               dir="ltr"
                               class="form-control @error('email') is-invalid @enderror"
                               id="user-name"
                               name="email"
                               value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
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
@push('front_custom_scripts')
    <script>
        @if(session('success'))
        Swal.fire({
            title: 'success',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'بستن'
        })
        @endif
    </script>
@endpush
