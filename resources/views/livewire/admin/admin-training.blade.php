<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col create-training-link">
                <a href="{{ route('admin.training.create') }}" class="btn btn-success">آموزش جدید</a>
            </div>
        </div>
        @if($trainings->count())
            <div
                class="row mt-5 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-3 g-4 training-section-index">
                @foreach($trainings as $training)
                    <div class="col">
                        <div class="card w-100 h-100">
                            <img src="{{ asset('storage/training/'.$training->image) }}" class="card-img-top"
                                 alt="article-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $training->title_persian }}</h5>
                                <p class="card-text my-5">{!! substr($training->short_description,0,190)  !!}</p>
                                <div class="col-xl-12 d-flex justify-content-between mt-5 article-footer-card">
                                    <div class="col-xl-2  article-date d-flex align-content-center align-items-center">
                                        <p class="mt-3">
                                            <span>{{ JDate($training->created_at)->format('Y/m/d')}}</span>
                                        </p>
                                    </div>
                                    <div class="col-xl-10  d-flex justify-content-end  article-op">
                                        <a href="javascript:void(0)"
                                           wire:click.prevent="deleteConfirmation({{ $training->id }})"
                                           class="btn btn-secondary btn-sm me-3">حذف</a>
                                        <a href="{{ route('admin.training.edit',[$training]) }}"
                                           class="btn btn-info btn-sm me-3">ویرایش</a>
                                        <a href="javascript:void(0)" wire:click.defer="active({{$training->id}})"
                                           class="btn btn-{{  $training->approved == 0 ? 'danger' : 'success' }} btn-sm">{{ $training->approved == 0 ? __('messages.unpublished') : __('messages.published') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row d-flex justify-content-center my-5">
                <div class="col-xl-5 col-lg-5 my-5">
                    {{ $trainings->links() }}
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
