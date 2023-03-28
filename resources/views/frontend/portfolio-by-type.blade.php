@extends('layouts.frontend_app')

@section('title', 'Portfolio')

@push('css')

@endpush

@section('content')

  @include('partials.frontend.search')
  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery">
    <div class="container-fluid">
        <h5 class="text-left" style="font-size: 22px">{{$portfolio_type->name ?? '' }} image</h5>
      <div class="row gy-4 justify-content-center py-4">
        @forelse ($portfolios as $portfolio)
            <div class="col-xl-2 col-lg-4 col-md-6">
                <a href="{{ route('gallery.details',$portfolio->id) }}">
                    <div class="gallery-item" style="height: 320px; border-radius: 0px">
                            <img src="{{ asset(''.$portfolio->image) }}"  alt="{{$portfolio->title ?? '' }}" width="100%" height="100%" style="object-fit: cover">
                    </div>
                </a>
                <!-- Modal -->
            </div><!-- End Gallery Item -->
            {{-- single portfolio modal --}}

            @empty
             <div class="col col-lg-6 col-md-6 ">
                <div class="gallery-item m-auto w-50">
                    <div class="text-dark text-center bg-white pt-4 fs-3 pb-1"><b>OOPS!</b></div>
                    <div class="text-dark text-center bg-white pb-4 text-muted"><small>Image Not Found</small></div>
                </div>
             </div>
        @endforelse
      </div>

    </div>
  </section>
@endsection

@push('script')

@endpush
