@extends('layouts.frontend_app')

@section('title', 'Checkout')

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
        .paypal_btn{
            display: inline-flex;
            position: relative;
            background: #FFC439;
            border-radius: 5px;
            border: 1px solid #DC911D;
            box-shadow: inset 0 1px 0 0 #FFD699;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-weight: 700;
            font-size: 12px;
            padding: 0 23px;
            height: 42px;
            justify-content: center;
            align-items: center;
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
<div class="single-sale-header d-flex align-items-center">

</div><!-- End Page Header -->

<!-- ======= Gallery Single Section ======= -->
<section id="gallery-single" class="gallery-single mt-4">
  <div class="container">
    <div class="position-relative">
      <div class="portfolio-details-slider swiper">

        <div class="align-items-center">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="card" style="min-height: 450px">
                        <div class="card-header text-dark">Order Summery</div>
                        <div class="card-body">
                            <form action="{{ route('processTransaction') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $total_price  }}" name="price">

                            <div class="image_details">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Image Name</th>
                                                <th scope="col">Price</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($carts as $key => $cart)
                                                <tr>
                                                    <td>{{ $cart['id'] }}</td>
                                                    <td>
                                                        <img src="{{ asset(''.$cart['image']) }}" alt="{{ $cart['title'] ?? '' }}" height="30px" style="object-fit: cover; width: 60px; height: 50px" class="rounded">
                                                    </td>
                                                    <td>{{ $cart['title'] }}</td>
                                                    <td>{{ $total_price }}</td>
                                                  </tr>
                                                @endforeach
                                            </tbody>
                                          </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="price_qty fs-7 fw-semibold d-flex justify-content-between border-bottom pb-2 mt-1">
                                            <div class="subtotal">Subtotal</div>
                                            <div class="subtotal">${{number_format($total_price ?? 0.00) }}</div>
                                        </div>
                                        <div class="price_qty fs-7 fw-semibold d-flex justify-content-between border-bottom pb-2">
                                            <div class="vat">VAT</div>
                                            <div class="vat">$0.00</div>
                                        </div>
                                        <div class="price_qty fs-6 fw-semibold d-flex justify-content-between mt-3 py-1 text-dark" style="border-radius: 4px">
                                            <div class="subtotal"><strong>Grand Total</strong></div>
                                            <div class="subtotal" style="font-size: 22px; color: green"><strong>${{number_format($total_price ?? 0.00)  }}</strong></div>
                                        </div>
                                        <div class="pay_by_paypal py-2">
                                            <button type="submit" class="mt-5 paypal_btn">Payment With
                                                <svg aria-label="PayPal" xmlns="http://www.w3.org/2000/svg" width="90" height="33" viewBox="34.417 0 90 33" style="margin-left: 7px">
                                                    <path fill="#253B80" d="M46.211 6.749h-6.839a.95.95 0 0 0-.939.802l-2.766 17.537a.57.57 0 0 0 .564.658h3.265a.95.95 0 0 0 .939-.803l.746-4.73a.95.95 0 0 1 .938-.803h2.165c4.505 0 7.105-2.18 7.784-6.5.306-1.89.013-3.375-.872-4.415-.972-1.142-2.696-1.746-4.985-1.746zM47 13.154c-.374 2.454-2.249 2.454-4.062 2.454h-1.032l.724-4.583a.57.57 0 0 1 .563-.481h.473c1.235 0 2.4 0 3.002.704.359.42.469 1.044.332 1.906zM66.654 13.075h-3.275a.57.57 0 0 0-.563.481l-.146.916-.229-.332c-.709-1.029-2.29-1.373-3.868-1.373-3.619 0-6.71 2.741-7.312 6.586-.313 1.918.132 3.752 1.22 5.03.998 1.177 2.426 1.666 4.125 1.666 2.916 0 4.533-1.875 4.533-1.875l-.146.91a.57.57 0 0 0 .562.66h2.95a.95.95 0 0 0 .939-.804l1.77-11.208a.566.566 0 0 0-.56-.657zm-4.565 6.374c-.316 1.871-1.801 3.127-3.695 3.127-.951 0-1.711-.305-2.199-.883-.484-.574-.668-1.392-.514-2.301.295-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.499.589.697 1.411.554 2.317zM84.096 13.075h-3.291a.955.955 0 0 0-.787.417l-4.539 6.686-1.924-6.425a.953.953 0 0 0-.912-.678H69.41a.57.57 0 0 0-.541.754l3.625 10.638-3.408 4.811a.57.57 0 0 0 .465.9h3.287a.949.949 0 0 0 .781-.408l10.946-15.8a.57.57 0 0 0-.469-.895z"></path>
                                                    <path fill="#179BD7" d="M94.992 6.749h-6.84a.95.95 0 0 0-.938.802l-2.767 17.537a.57.57 0 0 0 .563.658h3.51a.665.665 0 0 0 .656-.563l.785-4.971a.95.95 0 0 1 .938-.803h2.164c4.506 0 7.105-2.18 7.785-6.5.307-1.89.012-3.375-.873-4.415-.971-1.141-2.694-1.745-4.983-1.745zm.789 6.405c-.373 2.454-2.248 2.454-4.063 2.454h-1.031l.726-4.583a.567.567 0 0 1 .562-.481h.474c1.233 0 2.399 0 3.002.704.358.42.467 1.044.33 1.906zM115.434 13.075h-3.272a.566.566 0 0 0-.562.481l-.146.916-.229-.332c-.709-1.029-2.289-1.373-3.867-1.373-3.619 0-6.709 2.741-7.312 6.586-.312 1.918.131 3.752 1.22 5.03 1 1.177 2.426 1.666 4.125 1.666 2.916 0 4.532-1.875 4.532-1.875l-.146.91a.57.57 0 0 0 .563.66h2.949a.95.95 0 0 0 .938-.804l1.771-11.208a.57.57 0 0 0-.564-.657zm-4.565 6.374c-.314 1.871-1.801 3.127-3.695 3.127-.949 0-1.711-.305-2.199-.883-.483-.574-.666-1.392-.514-2.301.297-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.501.589.699 1.411.554 2.317zM119.295 7.23l-2.807 17.858a.569.569 0 0 0 .562.658h2.822c.469 0 .866-.34.938-.803l2.769-17.536a.57.57 0 0 0-.562-.659h-3.16a.571.571 0 0 0-.562.482z"></path>
                                                 </svg>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
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
    {{-- <div class="container-fluid pt-5">
        <div class="gallery">
            <div class="row gy-4 justify-content-center">
                @foreach ( $portfolios as $key=>$portfolio)
                <div class="col-xl-2 col-lg-3 col-md-6">
                    <a href="{{ route('gallery.details',$portfolio->id) }}">
                        <div class="gallery-item">
                            <div style="height: 300px">
                                <img src="{{ asset('uploads/portfolio/watermark/'.$portfolio->image) }}"  alt="{{$portfolio->title ?? '' }}" width="100%" height="100%">
                            </div>
                        </div>
                    </a>
                    <!-- Modal -->
                </div><!-- End Gallery Item -->
                @endforeach

            </div>
        </div>
    </div> --}}
</section>
@endsection

@push('script')

@endpush
