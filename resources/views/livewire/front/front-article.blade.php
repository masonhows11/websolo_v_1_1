<div>
    <div class="container">
        @if(isset($article))
            @if($article->count() != null)
                <div class="row my-5">
                    <div class="col-md-6  h-75">
                        <div class="wk-post-section my-3">
                            <div class="row d-flex flex-column wk-post-title">
                                <div class="col wk-post-title-persian">
                                    <h1> {{ $article->title_persian }}</h1>
                                </div>
                                <div class="col d-flex justify-content-end  wk-post-title-english">
                                    <h4> {{ $article->title_english }}</h4>
                                </div>
                            </div>
                            <div class="wk-post-img">
                                <img src="{{ asset('/storage/articles/'.$article->image) }}" class="rounded-4" alt="post-image">
                            </div>
                            <div class="d-flex  justify-content-between mt-2 border border-2 rounded-3 wk-post-author-info">
                                <div class="wk-post-author-name py-3">
                                    <span class=""><i class="fas fa-pen"></i>{{ $article->user->name }}</span>
                                </div>
                                <div class="wk-post-created-date  py-3">
                                    <span class=""> {{ jdate($article->created_at)->ago() }}</span>
                                </div>
                            </div>
                            <div class="row d-flex my-4 justify-content-center wk-post-description">
                                <div class="col">
                                    {!! $article->description !!}
                                </div>
                            </div>

                            <div class="row d-flex justify-content-between wk-post-like-section">
                                <div class="col">
                                    <span class="wk-post-view-count">{{ $article->views }}</span>
                                    <i class="fa-solid fa-eye"></i>
                                    <span class="wk-post-heart-count">{{$like_count}}</span>
                                    <i wire:click.defer="addLike({{$article->id}})"
                                       class="{{ $current_like_status ? 'fas' : 'far' }}  fa-heart"
                                       style="{{ $current_like_status ? $like_color : '' }}">
                                    </i>
                                </div>
                            </div>

                            <div class="row d-flex flex-column wk-post-tags-section">
                                <div class="col px-3 tag-title">بر چسب ها :</div>
                                <div class="col wk-post-tag">
                                    @foreach($article->tags as $tag)
                                        <span class="wk-post-tag-name">
                                            <a href="{{ route('articles.by.tag',[$tag]) }}"> 
                                                {{ $tag->title_persian }}
                                            </a>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center write-comments-section my-4">
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-9">
                                <form wire:submit.prevent="submit">
                                    <div>
                                        @if (session()->has('message'))
                                            <div
                                                class="alert alert-success alert-component d-flex justify-content-between">
                                                {{ session('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                    @auth
                                        <div class="mb-3">
                                            <label for="message-comment" class="form-label">دیدگاه</label>
                                            <textarea class="form-control"
                                                      wire:model.defer="body"
                                                      placeholder="متن دیدگاه خود را وارد کنید." id="message-comment"
                                                      rows="6">
                                    </textarea>
                                            @error('body')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <button type="sumbit" class="btn btn-success">ثبت دیدگاه</button>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <a href="{{ route('register.form') }}" class="btn btn-outline-primary">
                                                برای ارسال
                                                دیگاه ابتدا
                                                وارد سایت
                                                شوید یا اگر عضو نیستید ثبت نام کنید.</a>
                                        </div>
                                    @endauth
                                </form>
                            </div>
                        </div>

                        <div class="row my-5 list-comments-section d-flex">
                            @if ($article->comments->where('article_id', '=', $article->id)->where('approved','=',1))
                                @foreach ($article->comments->where('approved',1) as $comment)
                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col">
                                        <div class="d-flex flex-start mb-4">
                                            <img class="rounded-circle shadow-1-strong me-3"
                                                 src="{{ $comment->user->image_path  ? asset('storage/users/' . $comment->user->image_path): asset('images/users/no-user.png') }}"
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
                </div>
            @endif
        @endif
    </div>
</div>
