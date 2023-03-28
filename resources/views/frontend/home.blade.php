@extends('layouts.frontend_app')

@section('title', 'Welcome to Photography')

@push('css')

@endpush

@section('content')
<section id="gallery-single" class="gallery-single">
    <div class="position-relative h-100">
      <div class="slides-1 portfolio-details-slider swiper">
        <div class="swiper-wrapper align-items-center" style="height: 100vh">
          @foreach ( $sliders as $slider)
                <div class="swiper-slide">

                    <img src="{{ asset(''.$slider->slider) }}" alt="{{ $slider->title ?? '' }}">
                    <div class="bg_overlay"></div>
                    <div class="slider_overlay text-center">
                    <h1 class="slider_title">{{ $slider->title ?? '' }}</h1>
                    <p class="slider_desc">{{ $slider->description ?? '' }}</p>

                </div>

            </div>
          @endforeach



        </div>
        <div class="swiper-pagination"></div>
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

    </div>
</section>
@endsection

@push('script')

@endpush
