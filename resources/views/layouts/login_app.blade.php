<!DOCTYPE html>
<html>

<head data-baseurl="{{URL::to('/')}}">
    <meta charset="utf-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel='icon' type='image/png' sizes='32x32' href="{{asset('images/favicon.png')}}">
    <!-- no-cache -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
    <title>{{ config('app.name') }}</title>
    <!-- App css -->
    <link href="{{ asset('admin/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div id="app">
        <login />
    </div>

    <!-- App js -->
    <script src="{{ asset('js/login_app.js') }}" defer></script>
</body>

</html>
