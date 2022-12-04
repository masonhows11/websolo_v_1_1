@extends('front.profile.master_dash')
@section('page_title')
    ویرایش پروفایل کاربری
@endsection
@section('info_dash_left_side')
    <div class="container">
        <div class="col-xl-12 col-lg-12 col-md-10  dash-index">

            <div class="row my-3">
                <form action="{{ route('update.profile') }}" method="post">
                    @csrf
                    <div class="dash-index-info-title mt-3 mb-5 py-2 px-3">
                        اطلاعات کاربر
                    </div>

                    <input type="hidden" value="{{ $user->id }}" name="user">
                    <div class="col-xl-8 col-lg-8 my-3">
                        <label for="user-name" class="form-label">نام کاربری :</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="user-name"
                               placeholder=""
                               name="name"
                               value="{{ $user->name }}">
                        @error('name')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-xl-8 col-lg-8  my-3">
                        <label for="first-name" class="form-label">نام :</label>
                        <input type="text"
                               class="form-control @error('first_name') is-invalid @enderror"
                               id="first-name"
                               placeholder=""
                               name="first_name"
                               value="{{ $user->first_name }}">
                        @error('first_name')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-xl-8 col-lg-8 my-3">
                        <label for="last-name" class="form-label">نام خانوادگی :</label>
                        <input type="text"
                               class="form-control @error('last_name') is-invalid @enderror"
                               id="last-name"
                               placeholder=""
                               name="last_name"
                               value="{{ $user->last_name }}">
                        @error('last_name')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-success">ویرایش</button>
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

