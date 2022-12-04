@extends('dash.include.master')
@section('dash_page_title')
    مقالات
@endsection
@section('dash_main_content')
<div>
    <livewire:admin.admin-articles/>
</div>
@endsection
@push('dash_custom_scripts')
    <script>
        $(document).ready(function () {
            @if(session()->has('success'))
            Toastify({
                text: '{{ session('success') }}',
                duration: 3000,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
            }).showToast();
            @elseif(session()->has('error'))
            Toastify({
                text: '{{ session('error') }}',
                duration: 3000,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
            }).showToast();
            @endif
        })
    </script>
@endpush
