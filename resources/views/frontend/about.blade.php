@extends('layouts.frontend_app')

@section('title', 'About')

@push('css')

@endpush

@section('content')
<!-- ======= End Page Header ======= -->
<div class="page-header d-flex align-items-center">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center pt-5 about_header">
          <h2>About {{ $about->name ?? '' }}</h2>
          <a class="cta-btn" href="{{ route('contact') }}">Contact Me</a>
        </div>
      </div>
    </div>
  </div><!-- End Page Header -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about py-4">
    <div class="container">

      <div class="row gy-4 justify-content-center">
        <div class="col-lg-4">
            <div class="about_img_box">
                <img src="{{ asset('storage/'.$about->image) }}" class="img-fluid" alt="About Image">
            </div>

        </div>
        <div class="col-lg-5 content">
          <h2>{{ $about->title ?? '' }}</h2>
          <p class="fst-italic py-2">
            {{ $about->short_description ?? '' }}
          </p>
          <div class="row">
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>{{ $about->birthday ?? '' }}</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span>{{ $about->degree ?? '' }}</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span>{{ $about->phone ?? '' }}</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>{{ $about->city ?? '' }}</span></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>{{ $about->age ?? '' }}</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>{{ $about->email ?? '' }}</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span>{{ $about->freelance ?? '' }}</span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span>{{ $about->website ?? '' }}</span></li>
              </ul>
            </div>
          </div>
          <p class="py-2">
            {{ $about->long_description ?? '' }}
          </p>
        </div>
      </div>

    </div>
  </section><!-- End About Section -->
@endsection

@push('script')

@endpush
