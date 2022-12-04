@extends('dash.include.master')
@section('dash_page_title')
   تغییر شماره موبایل
@endsection
@section('dash_main_content')
    <div class="container">
        <div class="row admin-mobile-section admin-main-content">

            <div class="col-xl-7 col-lg-7 col-md-7">
                <form action="{{ route('admin.updateMobile') }}" method="post">
                    @csrf
                    <div>
                        <input type="hidden" name="id" value="{{ $admin->id }}">
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="form-label">شماره موبایل:</label>
                        <input type="text" class="form-control" id="mobile" value="{{ $admin->mobile }}" name="mobile">
                        @error('mobile')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group my-4">
                        <input type="submit" class="btn btn-success" value="تایید">
                        <a href="{{ route('admin.adminProfile') }}" class="btn btn-secondary">بازگشت</a>
                    </div>

                </form>
            </div>


        </div>
    </div>
@endsection

