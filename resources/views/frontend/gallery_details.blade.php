@extends('layouts.frontend_app')

@section('title', 'Image Details Page')

@push('css')
    <style>
        .image_details_box{
            width: 100%;
            height: 580px;
            margin: 0 auto;
        }
        .image_details_box img{
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
<div class="single-sale-header d-flex align-items-center">

</div><!-- End Page Header -->

<!-- ======= Gallery Single Section ======= -->
<section id="gallery-single" class="gallery-single">
  <div class="container">
    <div class="position-relative">
      <div class="portfolio-details-slider swiper">
        <div class="align-items-center">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="swiper-slide m-auto">
                        <div class="image_details_box">
                            <img src="{{ asset(''.$portfolio->image) }}" alt="Image" class="rounded" style="object-fit: cover">
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="pt-1">
                                    <label style="font-size: 17px; color: #e3e3e3"><b>Image title - {{ $portfolio->title ?? '' }}</b></label>
                                    <p style="font-size: 17px; color: #e3e3e3 text-muted; text-align: justify"><b>Image Description</b> - {{ $portfolio->description ?? '' }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="cart_btn text-end mt-3">
                                    <a href="{{ route('add.cart', $portfolio->id) }}" class="btn btn-secondary btn-sm ms-1"><i class="fas fa-plus me-1 cart_plus_icon"></i>cart</a>
                                    <a href="{{ route('checkout', $portfolio->id) }}" class="btn btn-success btn-sm custom_download_btn"><i class="fas fa-download"></i> <span>Download Image</span></a>
                                </div>
                            </div>
                        </div>


                      </div>
                </div>
                <div class="col-md-3">
                    <div>
                        {{-- <button class="btn btn-success btn-lg custom_download_btn"><i class="fas fa-download"></i> <span>Download Image</span></button> --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
</div>
    <div class="container-fluid pt-5">
        <div class="gallery">
            <div class="row gy-4 justify-content-center">
                @foreach ( $portfolios as $key=>$portfolio)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <a href="{{ route('gallery.details',$portfolio->id) }}">
                        <div class="gallery-item" style="height: 320px">
                            <div>
                                <img src="{{ asset(''.$portfolio->image) }}"  alt="{{$portfolio->title ?? '' }}" width="100%" height="100%" style="object-fit: cover">
                            </div>
                        </div>
                    </a>
                    <!-- Modal -->
                </div><!-- End Gallery Item -->
                @endforeach

            </div>
        </div>
    </div>

</section>
@endsection

@push('script')

@endpush
