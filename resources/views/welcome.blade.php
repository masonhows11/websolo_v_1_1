@extends('front.include.master_front')
@section('page_title')
    خانه
@endsection
@section('main_content')
    <!-- articles -->
    <div class="article-wrapper">
        <div class="container articles">
            <div class="section-title">
                <h5 class="section-title-content text-center">مقالات</h5>
            </div>
               <livewire:front.home-articles/>
            </div>
    </div>
    <!-- sample-project  -->
    <div class="sample-wrapper">
        <div class="container sample-project">
            <div class="section-title">
                <h5 class="section-title-content text-center">
                    نمونه کارها
                </h5>
            </div>
               <livewire:front.home-samples/>
        </div>
    </div>


    <!--  Training  -->
    <div class="training-wrapper">
        <div class="container">
            <div class="section-title">
                <h5 class="section-title-content text-center">
                    آموزش ها
                </h5>
            </div>
           <livewire:front.home-training/>
        </div>
    </div>
@endsection
