<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col create-sample-link">
                <a href="{{ route('admin.sample.create') }}" class="btn btn-success">نمونه کار جدید</a>
            </div>
        </div>
        @if ($samples->count())
            <div
                class="row mt-5 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-3 g-4 sample-section-index">
                @foreach ($samples as $sample)
                    <div class="col">
                        <div class="card  h-100">
                            <img src="{{ asset('storage/samples/' . $sample->main_image) }}"
                                 class="card-img-top"
                                 alt="sample-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $sample->title_persian }}</h5>
                                <p class="card-text my-5">{!! $sample->short_description !!}</p>
                                <div class="d-flex flex-column">
                                    @php
                                        $back_end = array();
                                       foreach($sample->backEnds as $lng){
                                        array_push($back_end,$lng->title_persian);
                                       }
                                    @endphp
                                    <h6>بک اند :</h6>
                                    <span
                                        class="mx-2 article-category">{{ implode(' - ',$back_end)}}</span>
                                </div>
                                <div class="d-flex flex-column my-2">
                                    @php
                                        $front_end = array();
                                       foreach($sample->frontEnds as $lng){
                                        array_push($front_end,$lng->title_persian);
                                       }
                                    @endphp
                                    <h6>فرانت اند :</h6>
                                    <span class="mx-2 article-tag">{{ implode(' - ',$front_end)}}</span>
                                </div>
                                <div class="col-xl-12 d-flex justify-content-between mt-5 article-footer-card">
                                    <div class="col-xl-2  article-date d-flex align-content-center align-items-center">
                                        <p class="mt-3">
                                            <span>{{ jDate($sample->created_at)->format('Y/m/d') }}</span>
                                        </p>
                                    </div>
                                    <div class="col-xl-10  d-flex justify-content-end  article-op">
                                        <a href="javascript:void(0)"
                                           wire:click.prevent="deleteConfirmation({{ $sample->id }})"
                                           class="btn btn-secondary btn-sm me-3">حذف</a>
                                        <a href="{{ route('admin.sample.edit',['id'=>$sample->id]) }}"
                                           class="btn btn-info btn-sm me-3">ویرایش</a>
                                        <a href="javascript:void(0)" wire:click.defer="active({{$sample->id}})"
                                           class="btn btn-{{ $sample->approved == 0 ? 'danger' : 'success' }} btn-sm">{{ $sample->approved == 0 ?  __('messages.unpublished') : __('messages.published') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row d-flex justify-content-center my-5">
                <div class="col-xl-5 col-lg-5 my-5">
                    {{ $samples->links() }}
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
