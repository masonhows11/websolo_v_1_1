@foreach ($category as $child)
    <li class="py-1 pe-2"><a href="{{--{{ route('articleCategory',[$child]) }}--}}">{{ $child->title_persian }}</a></li>
    <ul class="ps-2">
        @if (count($child->children))
            @include('front.include.child_category', ['category' => $child->children])
        @endif
    </ul>
@endforeach
