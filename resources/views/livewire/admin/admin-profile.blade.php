<div>
    @section('dash_page_title')
        پروفایل کاربری
    @endsection
    <div class="container">

        <div class="row alert-profile">
            @if(session()->has('success'))
                <div
                    class="col-xl-7 col-lg-7 col-md-7 alert alert-success alert-dismissible alert-component text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            @if(session()->has('error'))
                <div
                    class="col-xl-7 col-lg-7 col-md-7 alert alert-danger alert-dismissible alert-component text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif
        </div>

        <div class="row admin-profile-section">
            <form wire:submit.prevent="update">
                <div class="row">
                    <div class="col">
                        <div class="image-wrapper my-5 d-flex flex-column  align-items-center">
                            <div class="image-content   border border-3 rounded-3">
                                @if($image_path)
                                    <img src="{{ $image_path->temporaryUrl() }}" alt="admin_image_path"
                                         class="rounded image_admin_preview">
                                @else
                                    <img class="rounded admin-image"
                                         src="{{ $admin->image_path ?  asset('storage/admin/'.$admin->image_path)  : asset('assets/images/users/no-user.png') }}"
                                         alt="">
                                @endif
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="image" class="form-label"> آپلود عکس</label>
                                <input type="file" class="form-control" wire:model="image_path" id="image">
                            </div>
                            @error('image_path')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group my-5">
                            <label for="user" class="form-label">نام کاربری:</label>
                            <input type="text" wire:model.lazy="name" class="form-control" id="user">
                            @error('name')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5">
                            <label for="firstName" class="form-label">نام:</label>
                            <input type="text" wire:model.lazy="first_name" class="form-control" id="firstName">
                            @error('first_name')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5">
                            <label for="lastName" class="form-label">نام خانوادگی:</label>
                            <input type="text" wire:model.lazy="last_name" class="form-control" id="lastName">
                            @error('last_name')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5">
                            <label for="email" class="form-label">ایمیل:</label>
                            <input type="email" wire:model.lazy="email" class="form-control" value="{{ $admin->email}}"
                                   id="email">
                            @error('email')
                            <div class="alert alert-danger my-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-5 d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">ویرایش اطلاعات</button>
                            <a href="{{  route('admin.change.mobile') }}" class="btn btn-success">تغییر شماره موبایل</a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">بازگشت</a>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>


