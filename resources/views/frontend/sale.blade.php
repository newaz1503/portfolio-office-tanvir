@extends('layouts.frontend_app')

@section('title', 'Welcome to Photography')

@push('css')
    <style>
        .error{
            color: crimson;
        }
    </style>
@endpush

@section('content')
       @include('partials.frontend.search')

      <!-- ======= Sale category Section ======= -->
      <section id="sale_category" class="sale_category">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="sale_category_wrap">
                <div class="owl-carousel owl-theme">
                    @foreach ( $categories as $key=>$category)
                        <div class="item">
                            <div class="sale_category_box">
                                @if ($category)
                                    <a href="{{ route('portfolio.category', $category->slug) }}">{{ $category->name }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ======= Sale category Section end ======= -->

      <!-- ======= Gallery Section ======= -->
      <section id="gallery" class="gallery">
        <div class="container-fluid">

            <div class="row gy-4 justify-content-center">
                @foreach ( $portfolios as $key=>$portfolio)
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <a href="{{ route('gallery.details',$portfolio->id) }}">
                            <div class="gallery-item" style="height: 380px;border-radius: 1px">
                                <img src="{{ asset(''.$portfolio->image) }}"  alt="{{$portfolio->title ?? '' }}" width="100%" height="100%" style="object-fit: cover; border-radius: none">
                            </div>
                        </a>
                         <!-- Modal -->
                    </div><!-- End Gallery Item -->

                @endforeach
            </div>
        </form>
        <!-- Button trigger modal -->
        </div>
      </section><!-- End Gallery Section -->
@endsection

@push('script')


<script type="text/javascript">


        /*------------------------------------------
        --------------------------------------------
        Submit Event
        --------------------------------------------
        --------------------------------------------*/
        $(document).on("submit", "#handleAjax", function(e) {
            e.preventDefault();
            var e = this;
            // $(this).find("[type='submit']").html("Login...");
            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: "POST",
                dataType: 'json',
                success: function (data) {
                  if (data.status == 200) {
                    $("#paymentModal").modal('show');
                    //   window.location.href = data.redirect;
                  }else{
                      $(".alert").remove();
                      $.each(data.errors, function (key, val) {
                          $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                      });
                  }

                }
            });

            return false;
        });
  </script>

@endpush





