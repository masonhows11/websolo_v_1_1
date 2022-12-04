@foreach ($categories as $category)
    <div class="py-1 root-category"><a href="{{--{{ route('articleCategory',[$category]) }}--}}">{{ $category->title_persian }}</a>
    </div>
    <ul class="mt-1">
        @include('front.include.child_category', ['category' => $category->children])
    </ul>
@endforeach
