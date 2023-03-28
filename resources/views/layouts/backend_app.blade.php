<!DOCTYPE html>
<html>

<head data-baseurl="{{URL::to('/')}}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="content-type" content="text/html;charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- no-cache -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base-url" content="{{URL::to('/')}}" />
  <script>
  window.laravel = {
    csrfToken: '{{ csrf_token() }}',
    baseurl: '{{URL::to("/")}}'
  }
  </script>

  <!-- Title -->

  <title>Dashboard | Hyper - Admin &amp; Dashboard Template</title>

  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">
    <!-- Theme Config Js -->
  <script src="{{ asset('admin/js/hyper-config.js') }}"></script>

  <!-- App css -->
  <link href="{{ asset('admin/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

  <!-- Icons css -->
  <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin/vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
<!-- Pre-loader -->
<div id="preloader">
    <div id="status">
        <div class="bouncing-loader"><div ></div><div ></div><div ></div></div>
    </div>
</div>
<!-- End Preloader-->

  <div id="app">
   <app></app>
  </div>

  <!-- App js -->
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- vendors js -->
  <script src="{{ asset('admin/js/vendor.min.js') }}"></script>
  <script src="{{ asset('admin/js/app.min.js') }}"></script>

</body>

</html>
