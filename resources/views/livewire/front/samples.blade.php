<div>
    @section('page_title')
        نمونه کارها
    @endsection
    <div class="container">
        <div class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1 my-3 py-4 px-4  sample-page">
                @if ($samples->count())
                    @foreach ($samples as $sample)
                        <div class="col my-2">
                            <div class="wk-article-card d-flex flex-column h-100">
                                <div class="wk-article-img-card">
                                    <img src="{{ asset('storage/samples/'. $sample->main_image) }}"
                                         class="img-fluid rounded-4" alt="sample-image"/>
                                </div>
                                <div class="wk-article-card-body">
                                    <div class="wk-article-card-title  pt-3"><h5>{{ $sample->title_persian }}</h5></div>
                                    <div class="wk-article-card-text my-1">
                                        <div class="desc">
                                            {!! $sample->short_description !!}
                                        </div>
                                    </div>
                                    <div class="wk-article-card-footer d-flex justify-content-between my-1">
                                        <div class="py-2 px-2 wk-article-date"><i
                                                class="fa-regular fa-clock"></i>{{ jDate($sample->created_at)->ago()  }}
                                        </div>
                                        <a class="btn wk-article-continue" href="{{ route('sample', [$sample]) }}">ادامه....</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 d-flex justify-content-center">
                {{ $samples->links() }}
            </div>
        </div>
    </div>
</div>
