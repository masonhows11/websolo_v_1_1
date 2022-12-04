<div>
    @section('dash_page_title')
        لیست مقالات
    @endsection
    <div class="container-fluid">
        <div class="row  row-cols-xxl-4 row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-1  articles-page">
            @if (isset($articles))
                @if ($articles->count())
                    @foreach ($articles as $article)
                        <div class="col my-2">
                            <div class="wk-article-card d-flex flex-column h-100">

                                <div class="wk-article-img-card rounded-4">
                                    <img src="{{ asset('storage/articles/' . $article->image) }}"
                                         class="img-fluid rounded" alt="article-image"/>
                                </div>

                                <div class="wk-article-card-body mt-2">
                                    <div class="wk-article-card-title  my-1"><h5>{{ $article->title_persian }}</h5>
                                    </div>
                                    <div class="wk-article-card-text my-1">
                                        <div class="desc">
                                            {!! $article->short_description !!}
                                        </div>
                                    </div>
                                    <div class="wk-article-card-footer d-flex justify-content-end my-1">
                                        <a class="btn btn-list-comment" href="{{ route('admin.article.comments',['article_id'=>$article->id]) }}">لیست دیدگاه ها</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
