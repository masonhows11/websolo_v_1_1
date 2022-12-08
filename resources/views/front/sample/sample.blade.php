@extends('front.include.master')
@section('page_title')
@endsection
@section('main_content')
    <div class="container">
        @if (isset($sample))
            @if ($sample->count() != null)
                <div class="row my-3 wk-sample-section w3-flat-midnight-blue rounded-3">
                    <div class="col-xxl-12 col-xl-10 col-lg-10 col-md-10 my-2">

                        <div
                            class="row row-cols-xxl-2 row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 wk-sample-card mb-3 mt-3">

                            <div class="col my-5 wk-sample-main-image">
                                <img src="{{ asset('storage/samples/' . $sample->main_image) }}"
                                     loading="lazy"
                                     class="img-thumbnail h-100"
                                     alt="sample-main-image">
                            </div>

                            <div
                                class="col d-flex flex-column wk-sample-info  align-content-center justify-content-around">
                                <div class="wk-sample-title">
                                    <h3>{{ $sample->title_persian }}</h3>
                                    <h5>{{ $sample->title_english }}</h5>
                                </div>
                                <div class="wk-sample-lang py-3">
                                    <h5>بک اند (back-end)</h5>
                                    @foreach ($sample->backEnds as $lng)
                                        <ul class="list-group  list-group-flush list-group-horizontal my-2 py-2">
                                            <li class="">{{ $lng->title_persian }}</li>
                                        </ul>
                                    @endforeach
                                    <h5>فرانت اند (front-end)</h5>
                                    @foreach ($sample->frontEnds as $lng)
                                        <ul class="list-group list-group-flush list-group-horizontal my-2 py-2">
                                            <li class="">{{ $lng->title_persian }}</li>
                                        </ul>
                                    @endforeach
                                </div>

                                <div class="wk-sample-short-desc">
                                    <div class="row">
                                        <h5>خلاصه :</h5>
                                        <div class="sample-short-text">
                                            {!! $sample->short_description !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="wk-sample-single-date">ایجاد شده در تاریخ
                                                : {{ JDate($sample->created_at)->format('Y/m/d')}}</p>
                                        </div>

                                        <div class="col wk-sample-like-section">
                                            <span class="wk-post-view-count">{{ $sample->views }}</span>
                                            <i class="fa-regular fa-eye"></i>
                                            <span class="wk-post-heart-count" id="like-count">{{ $sample->likes()->count() }}</span>

                                            @auth
                                                @if(\Illuminate\Support\Facades\Auth::user()->likes()->where(['sample_id'=>$sample->id,'like'=>1])->first())
                                                    <i class="fas fa-heart fa-border-style" style="color:tomato"
                                                       id="add-like"
                                                       data-sample="{{ $sample->id }}"></i>
                                                @else
                                                    <i class="far fa-heart" style="color:tomato" id="add-like"
                                                       data-sample="{{ $sample->id }}"></i>
                                                @endif
                                            @else
                                                <i class="far fa-heart fa-border-style" style="color:tomato"
                                                   id="add-like-an-auth" data-sample="{{ $sample->id }}"></i>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="mt-3"> توضیحات</h5>
                <div class="row  wk-sample-description w3-flat-midnight-blue rounded-3">
                    <div class="col mx-3 py-5">
                        {!! $sample->description !!}
                    </div>
                </div>

                <h5 class="mt-3">تصاویر پروژه</h5>
                <div class="row  row-cols-xxl-4 row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-1 d-flex justify-content-evenly sample-gallery mt-3 mb-4 w3-flat-midnight-blue rounded-3">
                    <div class="col my-5 sample-main-image">
                        <img src="{{ asset('storage/samples/' . $sample->image1) }}" class="img-thumbnail h-100"
                             loading="lazy" alt="sample-gallery-image">
                    </div>
                    <div class="col my-5 sample-main-image">
                        <img src="{{ asset('storage/samples/' . $sample->image2) }}" class="img-thumbnail h-100"
                             loading="lazy" alt="sample-gallery-image">
                    </div>
                    <div class="col my-5 sample-main-image">
                        <img src="{{ asset('storage/samples/' . $sample->image3) }}" class="img-thumbnail h-100"
                             loading="lazy" alt="sample-gallery-image">
                    </div>
                    <div class="col my-5 sample-main-image">
                        <img src="{{ asset('storage/samples/' . $sample->image4) }}" class="img-thumbnail h-100"
                             loading="lazy" alt="sample-gallery-image" data-bs-toggle="modal" data-bs-target="#myModal">
                    </div>
                </div>

                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Modal body..
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            @endif
        @endif

        <div class="row d-flex justify-content-center write-comments-section my-4">
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-4 col-10">
                <form id="add-comment">
                    @auth
                        <input type="hidden" id="sample-id" value="{{ $sample->id }}">
                        <div class="mb-3">
                            <label for="body-comment" class="form-label">دیدگاه</label>
                            <textarea class="form-control"
                                      placeholder="متن دیدگاه خود را وارد کنید."
                                      id="body-comment"
                                      rows="6">
                            </textarea>
                        </div>
                        <div class="mb-3 mt-3">
                            <button type="sumbit" class="btn btn-success">ثبت دیدگاه</button>
                        </div>
                    @else
                        <div class="mb-3">
                            <a href="{{ route('register.form') }}" class="btn btn-outline-primary">برای ارسال دیگاه
                                ابتدا
                                برای ارسال
                                دیگاه ابتدا
                                وارد سایت
                                شوید یا اگر عضو نیستید ثبت نام کنید.</a>
                        </div>
                    @endauth
                </form>
            </div>
        </div>

        <div class="row my-5 list-comments-section d-flex justify-content-center align-items-center">
            @if ($sample->comments->where('sample_id', '=', $sample->id)->where('approved','=',1))
                @foreach ($sample->comments->where('approved',1) as $comment)
                    <div class="col-md-11 col-lg-9 col-xl-7">

                        <div class="d-flex flex-start mb-4">

                            <img class="rounded-circle shadow-1-strong me-3"
                                 src="{{ $comment->user->image_path
                                    ? asset('storage/users/' . $comment->user->image_path)
                                    : asset('assets/images/users/no-user.png') }}"
                                 alt="avatar"/>

                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <div class="">
                                        <h5>{{ $comment->user->name }}</h5>
                                        <p class="small comment-date">{{ jDate($comment->created_at)->ago() }}</p>
                                        <p> {{ $comment->body }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection
@push('front_custom_scripts')
    <script>

        $(document).ready(function () {

            // add comment
            document.getElementById('add-comment').addEventListener('submit', addComment)

            function addComment(e) {
                e.preventDefault();
                let article_id = document.getElementById('sample-id').value;
                let body = document.getElementById('body-comment').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: '{{ route('sample.addComment') }}',
                    data: {id: article_id, body: body}
                }).done(function (data) {
                    if (data['status'] === 422) {
                        Swal.fire({
                            icon: 'info',
                            text: data['msg']['body'],
                        });
                    }
                    if (data['status'] === 404) {
                        document.getElementById('body-comment').value = '';
                        Swal.fire({
                            icon: 'warning',
                            text: data['msg'],
                        });
                    } else if (data['status'] === 200) {
                        document.getElementById('body-comment').value = '';
                        Swal.fire({
                            icon: 'success',
                            text: data['msg'],
                        });
                    }
                }).fail(function (data) {
                    if (data['status'] === 500) {
                        Swal.fire({
                            icon: 'danger',
                            text: 'خطایی رخ داده.',
                        });
                    }
                })
            }
            // add like
            $(document).on('click', '#add-like-an-auth', function () {
                Swal.fire({
                    icon: 'info',
                    text: 'برای ثبت like Or dislike ابتدا وارد سایت شوید.',
                });
            })
            $(document).on('click', '#add-like', function (e) {
                let like_btn = document.getElementById('add-like');
                let sample_id = e.target.getAttribute('data-sample');
                let is_liked;
                if (like_btn.classList.contains('far')) {
                    like_btn.classList.remove("far");
                    like_btn.classList.add("fas")
                    like_btn.style.color = 'tomato';
                    is_liked = true;
                } else {
                    like_btn.classList.remove('fas');
                    like_btn.classList.add('far')
                    is_liked = false;
                }
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                $.ajax({
                    method: 'POST',
                    url: '{{ route('sample.add.like') }}',
                    data: {id: sample_id, is_liked: is_liked}
                }).done(function (data) {
                    if (data['status'] === 200) {
                        if (data['liked'] === 'disliked') {
                            document.getElementById('like-count').innerText = data['count'];
                        } else if (data['liked'] === 'liked') {
                            document.getElementById('like-count').innerText = data['count'];
                        }
                    }
                }).fail(function (data) {
                    if (data['status'] === 500) {
                        Swal.fire({
                            icon: 'danger',
                            text: 'خطایی رخ داده.',
                        });
                    }
                })

            });
        });
    </script>
@endpush
