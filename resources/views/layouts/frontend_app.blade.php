<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title') - {{ $site_setting->title ?? '' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{URL::to('/')}}" />
    {{-- <link rel='icon' type='image/png' sizes='32x32' href="{{asset('images/favicon.png')}}"> --}}

   <!-- Favicons -->
  <link href="{{ asset('website/frontend/') }}/img/favicon.png" rel="icon">
  <link href="{{ asset('website/frontend/') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" integrity="sha512-LW9+kKj/cBGHqnI4ok24dUWNR/e8sUD8RLzak1mNw5Ja2JYCmTXJTF5VpgFSw+VoBfpMvPScCo2DnKTIUjrzYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Vendor CSS Files -->
  <link href="{{ asset('website/frontend/') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('website/frontend/') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('website/frontend/') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="{{ asset('website/frontend/') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('website/frontend/') }}/vendor/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('website/frontend/') }}/css/owl.carousel.min.css">
  <link rel="stylesheet" href="{{ asset('website/frontend/') }}/css/owl.theme.default.min.css">
  <!-- Template Main CSS File -->
  <link href="{{ asset('website/frontend/') }}/css/main.css" rel="stylesheet">
<style>
    .modal-dialog-centered{
        justify-content: center !important;
    }
    .fs-7{
        font-size: 17px !important;
        color: #222222;
    }
    .nav-link{
        font-size: 18px;
    }
    .logout_option{
        justify-content: center !important;
    }
</style>
  <script>
    window.laravel = {
        csrfToken: '{{ csrf_token() }}',
        baseurl: '{{URL::to("/")}}'
    }
</script>
@stack('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
      <!-- ======= Header ======= -->
    @include('partials.frontend.header')
  <!-- End Header -->

  <main id="main" data-aos="fade" data-aos-delay="1500">
    @yield('content')
  </main>
  <!-- End #main -->

  <hr class="container">
  <!-- ======= Footer ======= -->
  @include('partials.frontend.footer')
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>
  @include('partials.frontend.sidebar')



    <!-- App js -->
    {{-- <script src="{{ asset('js/frontend_app.js') }}"></script> --}}
    <!-- Vendor JS Files -->
  <script src="{{ asset('website/frontend/') }}/js/jquery.min.js"></script>

  <script src="{{ asset('website/frontend/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  {{-- <script src="{{ asset('website/frontend/') }}/js/jquery.validate.min.js"></script> --}}

  <script src="{{ asset('website/frontend/') }}/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('website/frontend/') }}/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('website/frontend/') }}/vendor/aos/aos.js"></script>
  <script src="{{ asset('website/frontend/') }}/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('website/frontend/') }}/js/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('website/frontend/') }}/js/main.js"></script>
  @stack('script')
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
  </script>

  {{-- <script>
    $(document).on('click', '.destroyCart', function(e){
        e.preventDefault();
        var cartId = $(this).closest('.cart_wrap').find('.cart_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'GET',
            url: 'delete-cart',
            data: {
                'cart_id': cartId
            },
            success: function(response){
                $('.cart_box').load(location.href + " .cart_box");
                $('.sidecart').load(location.href + " .sidecart");
                $('.cart_items_count').load(location.href + " .cart_items_count");
                // window.location.href : '.cart_sidebar'
            }
        })
    })
</script> --}}
{{-- <script>
    //add to cart
function addToCart(productId){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: 'add-to-cart',
        data: {
            'portfolio_id': productId
        },
        success: function(response){
            $('.cart_box').load(location.href + " .cart_box");
            $('.sidecart').load(location.href + " .sidecart");
            $('.cart_items_count').load(location.href + " .cart_items_count");
            $('.portfolio_wrap').modal('hide');
        },

    })
},

  </script> --}}

  <script>
    $(document).on('click','.remove-from-cart', function(e){
    //  $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  </script>


</body>

</html>
