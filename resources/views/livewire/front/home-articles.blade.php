<div>
    <div class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1 py-4 px-4 article-content">
    @if($articles->count())
        @foreach($articles as $article)
                <div class="col my-2">
                    <div class="wk-article-card d-flex flex-column h-100">
                        <div class="wk-article-img-card">
                            <img src="{{ asset('storage/articles/' . $article->image) }}"
                                 class="img-fluid rounded" alt="article-image"/>
                        </div>
                        <div class="wk-article-card-body">
                            <div class="wk-article-card-title pt-3"><h5>{{ $article->title_persian }}</h5></div>
                            <div class="wk-article-card-text my-1">
                                <div class="desc">
                                    {!! $article->short_description !!}
                                </div>
                            </div>
                            <div class="wk-article-card-footer d-flex justify-content-between my-1">
                                <div class="py-2 px-2 wk-article-date"><i
                                        class="fa-regular fa-clock"></i>{{ jDate($article->created_at)->ago()  }}</div>
                                <div><a class="btn wk-article-continue"
                                        href="{{ route('article',[$article]) }}">ادامه....</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    @endif
    </div>
</div>
