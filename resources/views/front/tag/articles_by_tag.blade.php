@extends('front.include.master')
@section('page_title')
    مقالات
@endsection
@section('main_content')
    <div class="container">
        <div class="row my-3 py-2 px-2">
            <div class="col-md-2 article-category mt-2 w3-flat-clouds rounded-3">
                @include('front.include.category')
            </div>
            <div class="col-md-10">
                <div class="row  row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-1  articles-page">
                        @if ($articles->count())
                            @foreach ($articles as $article)
                                <div class="col my-2">
                                    <div class="wk-article-card d-flex flex-column h-100">
                                        <div class="wk-article-img-card">
                                            <img src="{{ asset('storage/articles/' . $article->image) }}"
                                                 class="img-fluid rounded-4" alt="article-image"/>
                                        </div>
                                        <div class="wk-article-card-body">
                                            <div class="wk-article-card-title  my-1"><h5>{{ $article->title_persian }}</h5></div>
                                            <div class="wk-article-card-text my-1">
                                                <div class="desc">
                                                    {!! $article->short_description !!}
                                                </div>
                                            </div>
                                            <div class="wk-article-card-footer d-flex justify-content-between my-1">
                                                <div class="py-2 px-2 wk-article-date"><i class="fa-regular fa-clock"></i>{{ jDate($article->created_at)->ago()  }}</div>
                                                <div><a class="btn wk-article-continue" href="{{ route('article', [$article]) }}">ادامه....</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 d-flex justify-content-center">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
