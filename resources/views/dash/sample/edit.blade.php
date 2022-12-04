@extends('dash.include.master')
@section('dash_page_title')
    ویرایش نمونه کار
@endsection
@section('dash_main_content')
    <div class="container-fluid">


        <div class="sample-section-create">


            <form action="{{ route('admin.sample.update') }}" method="post">
                @csrf

                <div class="row  row-cols-xxl-2 row-cols-xl-2 row-cols-lg-2 row-cols-md-1 row-cols-1">

                    <input type="hidden" name="id" value="{{ $sample->id }}">
                    <div class="col">
                        <div class="my-5">
                            <label for="title_persian" class="form-label">عنوان نمونه کار ( فارسی )</label>
                            <input type="text" class="form-control @error('title_persian') is-invalid @enderror"
                                   id="title_persian" name="title_persian" value="{{ $sample->title_persian }}">
                            @error('title_persian')
                            <div class="alert alert-danger mt-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="my-5">
                            <label for="title_english" class="form-label">عنوان نمونه کار (انگلیسی )</label>
                            <input type="text" class="form-control @error('title_english') is-invalid @enderror"
                                   id="title_english" name="title_english" value="{{ $sample->title_english  }}">
                            @error('title_english')
                            <div class="alert alert-danger mt-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="mt-5">
                            <label for="back-end" class="form-label my-3">زبان یا فریم ورک سمت سرور (back-end)</label>
                            <select type="text" multiple class="form-control chosen-select mt-3" id="back-end"
                                    name="back_ends[]">
                                @foreach($back_ends as $lang)
                                    <option value="{{ $lang->id }}" {{ in_array($lang->id,$sample->backEnds()->pluck('back_end_id')->toArray())? 'selected' :''}}>
                                        {{ $lang->title_persian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('back_ends')
                            <div class="alert alert-danger mt-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <label for="front-end" class="form-label my-3">زبان یا فریم ورک سمت کاربر (front-end)</label>
                            <select type="text" multiple class="form-control chosen-select" id="front-end"
                                    name="front_ends[]">
                                @foreach($front_ends as $lang)
                                    <option value="{{ $lang->id }}" {{ in_array($lang->id,$sample->frontEnds()->pluck('front_end_id')->toArray())? 'selected' :''}}>
                                        {{ $lang->title_persian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('front_ends')
                            <div class="alert alert-danger mt-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class="row main-image-select">
                    <div class="col-xl-6 mt-5">
                        <label for="button-image" class="form-label">عکس اصلی :</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" id="button-image-main">انتخاب عکس
                                </button>
                            </div>
                            <input type="text" id="main_image"
                                   class="form-control @error('image') is-invalid @enderror" name="main_image"
                                   aria-label="Image" aria-describedby="button-image" value="{{ $sample->main_image }}">
                        </div>
                        @error('main_image')
                        <div class="alert alert-danger my-5">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row d-flex flex-column sample-image-multi-select">
                    <div class="col-xl-6 col-lg-6 col-md-5 col">
                        <div class="col mt-5">
                            <label for="button-image" class="form-label">عکس نمونه شماره یک:</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="button-image1">انتخاب عکس
                                    </button>
                                </div>
                                <input type="text" id="image1"
                                       class="form-control @error('image1') is-invalid @enderror"
                                       name="image1" aria-label="Image1" aria-describedby="button-image" value="{{ $sample->image1 }}">
                            </div>
                            @error('image1')
                            <div class="alert alert-danger my-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mt-5">
                            <label for="button-image" class="form-label">عکس نمونه شماره دو:</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="button-image2">انتخاب عکس
                                    </button>
                                </div>
                                <input type="text" id="image2"
                                       class="form-control @error('image2') is-invalid @enderror"
                                       name="image2" aria-label="Image2" aria-describedby="button-image" value="{{ $sample->image2 }}">
                            </div>
                            @error('image2')
                            <div class="alert alert-danger my-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mt-5">
                            <label for="button-image" class="form-label">عکس نمونه شماره سه:</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="button-image3">انتخاب عکس
                                    </button>
                                </div>
                                <input type="text" id="image3"
                                       class="form-control @error('image3') is-invalid @enderror"
                                       name="image3" aria-label="Image3" value="{{ $sample->image3 }}">
                            </div>
                            @error('image3')
                            <div class="alert alert-danger my-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col mt-5">
                            <label for="button-image" class="form-label">عکس نمونه شماره چهار:</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="button-image4">انتخاب عکس
                                    </button>
                                </div>
                                <input type="text" id="image4"
                                       class="form-control @error('image4') is-invalid @enderror"
                                       name="image4" aria-label="Image4" aria-describedby="button-image" value="{{ $sample->image4 }}">
                            </div>
                            @error('image4')
                            <div class="alert alert-danger my-5">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group my-5">
                            <label for="desc-editor-text" class="form-label">خلاصه</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror"
                                      id="desc-editor-text"
                                      name="short_description">{{ $sample->short_description }}</textarea>
                        </div>
                        @error('short_description')
                        <div class="alert alert-danger my-5">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group my-5">
                            <label for="editor-text" class="form-label">توضیحات</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="editor-text"
                                      name="description">{{ $sample->description  }}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger my-5">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-8 d-flex justify-content-start">
                        <div class="me-2">
                            <button type="submit" class="btn  btn-success">ذخیره</button>
                        </div>
                        <div>
                            <a href="{{ route('admin.sample.index') }}" class="btn  btn-secondary">بازگشت</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('dash_custom_scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        // ckeditor
        CKEDITOR.replace('editor-text', {
            language: 'fa',
            removePlugins: 'image',
        });
        CKEDITOR.replace('desc-editor-text', {
            language: 'fa',
            removePlugins: 'image',
        });
        // chosen
        $('.chosen-select').chosen({rtl: true, width: "100%"})
    </script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            document.getElementById('button-image-main').addEventListener('click', (event) => {
                event.preventDefault();
                inputId = 'main_image';
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });

            document.getElementById('button-image1').addEventListener('click', (event) => {
                event.preventDefault();
                inputId = 'image1';
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
            // second button
            document.getElementById('button-image2').addEventListener('click', (event) => {
                event.preventDefault();
                inputId = 'image2';
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
            // third button
            document.getElementById('button-image3').addEventListener('click', (event) => {
                event.preventDefault();
                inputId = 'image3';
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
            // forth button
            document.getElementById('button-image4').addEventListener('click', (event) => {
                event.preventDefault();
                inputId = 'image4';
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });
        // input
        let inputId = '';
        // set file link
        function fmSetLink($url) {
            document.getElementById(inputId).value = $url;
        }
    </script>
@endpush



