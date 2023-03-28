@extends('layouts.frontend_app')

@section('title', 'Welcome to Photography')

@push('css')

@endpush

@section('content')
        <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center service_header pt-5">
              <h2>{{ $service['title'] ?? '' }}</h2>
              <p>{{ $service['sub_title'] ?? '' }}</p>
              <a class="cta-btn" href="{{ route('contact') }}">Contact Me</a>
            </div>
          </div>
        </div>
      </div><!-- End Page Header -->


      <!-- ======= Pricing Section ======= -->
      <section id="pricing" class="pricing pb-5">
        <div class="container">

          <div class="section-header">
            <h2>Prices</h2>
            <p>{{ $service['price_title'] ?? '' }}</p>
          </div>

          <div class="row gy-4 gx-lg-5">
            @foreach ( $service_prices as $service_price)
              <div class="col-lg-6">
                <div class="pricing-item d-flex justify-content-between">
                  <h3>{{ $service_price->price_type ?? '' }}</h3>
                  <h4>${{ number_format($service_price->price ?? 0, 2) }}</h4>
                </div>
              </div><!-- End Pricing Item -->
            @endforeach


          </div>
      </section><!-- End Pricing Section -->

      <!-- ======= Services Section ======= -->
      <section id="services" class="services py-4">
        <div class="container">
            <form action="{{ route('processTransaction') }}" method="post">
                @csrf
          <div class="row gy-4">
            @foreach ($service_details as $service_detail)
                <div class="col-xl-4 col-md-6 d-flex">

                        <div class="service-item position-relative">
                            <i class="bi bi-activity"></i>
                            <h4>{{ $service_detail->title ?? 0 }}</h4>
                            <p class="mb-2">{{ $service_detail->sub_title ?? 0 }}</p>
                            <p class="mb-2">${{number_format($service_detail->price ?? 0, 2)}}</p>
                            <div>
                                <a href="{{ route('contact') }}" class="mt-3"><small>Contact Me</small></a>
                            </div>
                        </div>

              </div>
            @endforeach
          </div>
        </form>
        </div>
      </section><!-- End Services Section -->
@endsection

@push('script')

@endpush
