<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col create-article-link">
                <a href="{{ route('admin.article.create') }}" class="btn btn-success">مقاله جدید</a>
            </div>
        </div>
        @if($articles->count())
            <div
                class="row mt-5 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-3 g-4 article-section-index">
                @foreach($articles as $article)
                    <div class="col">
                        <div class="card w-100 h-100">
                            <img src="{{ asset('storage/articles/'.$article->image) }}" class="card-img-top"
                                 alt="article-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title_persian }}</h5>
                                <p class="card-text my-5">{!! substr($article->short_description,0,190)  !!}</p>
                                <div class="d-flex flex-column">
                                    @php
                                        $article_categories = array();
                                        foreach ($article->categories as $cat){
                                        array_push($article_categories,$cat->title_persian) ;
                                        }
                                    @endphp
                                    <h6>دسته بندی ها:</h6>
                                    <span
                                        class="mx-2 article-category">دسته {{ implode(' - ',$article_categories)}}</span>
                                </div>
                                <div class="d-flex flex-column my-2">
                                    @php
                                        $article_tags = array();
                                        foreach ($article->tags as $tag){
                                        array_push($article_tags,$tag->title_persian) ;
                                        }
                                    @endphp
                                    <h6>تگ ها :</h6>
                                    <span class="mx-2 article-tag">{{ implode(' - ',$article_tags)}}</span>
                                </div>
                                <div class="col-xl-12 d-flex justify-content-between mt-5 article-footer-card">
                                    <div class="col-xl-2  article-date d-flex align-content-center align-items-center">
                                        <p class="mt-3">
                                            <span>{{ JDate($article->created_at)->format('Y/m/d')}}</span>
                                        </p>
                                    </div>
                                    <div class="col-xl-10  d-flex justify-content-end  article-op">
                                        <a href="javascript:void(0)"
                                           wire:click.prevent="deleteConfirmation({{ $article->id }})"
                                           class="btn btn-secondary btn-sm me-3">حذف</a>
                                        <a href="{{ route('admin.article.edit',[$article]) }}"
                                           class="btn btn-info btn-sm me-3">ویرایش</a>
                                        <a href="javascript:void(0)" wire:click.defer="active({{$article->id}})"
                                           class="btn btn-{{  $article->approved == 0 ? 'danger' : 'success' }} btn-sm">{{ $article->approved == 0 ?  __('messages.unpublished') : __('messages.published') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row d-flex justify-content-center my-5">
                <div class="col-xl-5 col-lg-5 my-5">
                    {{ $articles->links() }}
                </div>
            </div>
        @else
            <div class="row d-flex justify-content-center mt-5">
                <div class="col">
                    <div class="alert d-flex justify-content-center border border-2 border-dark alert-light no-article">
                        <p class="text-center my-auto">اطلاعاتی برای نمایش وجود ندارد</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@push('dash_custom_scripts')
    <script type="text/javascript">
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            });
        })
    </script>
    <script>
        window.addEventListener('show-delete-success', event => {
            Swal.fire({
                icon: 'success',
                text: 'رکورد مورد نظر با موفقیت حذف شد.',
            })
        })
    </script>
@endpush
