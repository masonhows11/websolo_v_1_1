<div>
    @section('dash_page_title')
        پروفایل کاربری
    @endsection
    <div class="container">
        <div class="row admin-mobile-section">
            <div class="col-xl-5 col-lg-5 col-md-5">
                <form  wire:submit.prevent="editMobile">
                    <div class="mb-3 mt-3">
                        <label for="mobile"  class="form-label">{{ $name }}</label>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="mobile" class="form-label">شماره موبایل:</label>
                        <input type="text" class="form-control" wire:model.lazy="mobile" id="mobile" name="mobile">
                        @error('mobile')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group my-4">
                        <input type="submit" class="btn btn-success" value="تایید">
                        <a href="{{ route('admin.profile') }}" class="btn btn-secondary">بازگشت</a>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>
