<div>
    @section('page_title')
        تماس با ما
    @endsection
    <div class="container">
        <div class="row my-5 py-5 d-flex  justify-content-center contact-us-wrapper w3-flat-midnight-blue rounded-3">

            <div class="col-xl-10 py-5 d-flex flex-column justify-content-center align-content-center contact-us-section-one">
                <h2 class="text-center mb-4 contact-us-title pb-2">ارتباط با ما</h2>
                <div class="row  row-cols-lg-2 row-cols-md-2 row-cols-1">

                    <div class="col d-flex flex-column  align-content-center align-items-center">
                        <h5 class="text-center my-2">پل های ارتباطی</h5>
                        <div class="d-flex flex-row  mt-5 normal-contact">
                            <div class="normal-contact-item"><a href="#"><i class="fa fa-envelope fa-2x mx-auto"></i></a></div>
                            <div class="normal-contact-item"><a href="#"><i class="fa-brands fa-telegram mx-auto"></i></a></div>
                        </div>
                    </div>

                    <div class="col d-flex flex-column  align-content-center align-items-center">
                        <h5 class="text-center mt-3">شبکه های اجتماعی</h5>
                        <div class="d-flex flex-row  m-5 social-link">
                            <div class="social-link-item"><a href="#" ><i class="fa-brands fa-telegram mx-auto"></i></a></div>
                            <div class="social-link-item"><a href="#"><i class="fa-brands fa-youtube fa-2x mx-auto"></i></a></div>
                            <div class="social-link-item"><a href="#"><i class="fa-brands fa-facebook fa-2x mx-auto"></i></a></div>
                            <div class="social-link-item"><a href="#"><i class="fa-brands fa-instagram fa-2x mx-auto"></i></a></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-10 h-50 contact-us-section-two">
                <div class="row contact-us-call-number my-4 rounded-3">
                    <div class="col-xl-12 py-5 ">
                        <div>
                            <h5>شماره تماس</h5>
                            <p dir="rtl" class="number-one">0917 289 0423</p>
                            <p dir="rtl" class="number-two">0991 723 0927</p>
                        </div>
                        <div>
                            <h5>آدرس</h5>
                            <p>به زودی...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-10 h-50">
                <div class="row d-flex  justify-content-center align-content-center">
                    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 my-3 contact-us-title">
                        <p class="text-center">
                            در قسمت فرم تماس با ما ، خوشحال میشیم نظرات ، ایده ها ، انتقادات و حتی اگه نقطه ضعفی مشاهده کردید به ما اطلاع دهید.
                        </p>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 contact-us-form py-5 px-5 rounded-3">
                        <form wire:submit.prevent="submit">
                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-component d-flex justify-content-between">
                                        {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            @csrf
                            <div class="mb-3 px-3">
                                <label for="name" class="form-label">نام</label>
                                <input type="text"
                                       class="form-control"
                                       dir="rtl"
                                       wire:model.defer="name" id="name" placeholder="نام خود را وارد کنید.">
                                @error('name')
                                <div class="alert alert-custom my-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 px-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input type="email"
                                       class="form-control"
                                       wire:model.defer="email"
                                       dir="rtl" id="email" placeholder="ایمیل خود را وارد کنید.">
                                @error('email')
                                <div class="alert alert-custom  my-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 px-3">
                                <label for="body-message" class="form-label">متن پیام</label>
                                <textarea class="form-control"
                                          id="body-message"
                                         wire:model.defer="message"
                                          placeholder="متن پیام ارسالی خود را وارد کنید."  rows="6"></textarea>
                                @error('message')
                                <div class="alert  alert-custom my-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 px-3">
                                <input type="submit" class="btn btn-primary" value="ارسال پیام">
                            </div>

                        </form>

                    </div>
                </div>
            </div>



        </div>
    </div>

</div>
