{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('website/frontend/css/main.css') }}">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" integrity="sha512-LW9+kKj/cBGHqnI4ok24dUWNR/e8sUD8RLzak1mNw5Ja2JYCmTXJTF5VpgFSw+VoBfpMvPScCo2DnKTIUjrzYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }

h1 {
	font-weight: bold;
	margin: 0;
    color: initial;
}

h2 {
	text-align: center;
}

p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

span {
	font-size: 12px;
}

a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

button {
	border-radius: 20px;
	border: 1px solid #27a776;
	background-color: #27a776;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}

button:active {
	transform: scale(0.95);
}

button:focus {
	outline: none;
}

button.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #FFFFFF;
	display: flex;
	align-items: center;
	/* justify-content: center; */
	flex-direction: column;
	padding: 100px 50px;
	height: 100%;
	text-align: center;
}

input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

.container {
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25),
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 530px;
}

.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
}

.container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	opacity: 0;
	z-index: 1;
}

.container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	opacity: 1;
	z-index: 5;
	animation: show 0.6s;
}

@keyframes show {
	0%, 49.99% {
		opacity: 0;
		z-index: 1;
	}

	50%, 100% {
		opacity: 1;
		z-index: 5;
	}
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;
}
.website_left{
    position: absolute;
    right: 15px;
    top: 10px;
}
.left_website_btn{
    width: 120px;
    height: 32px;
    display: inline-block;
    background-color: #f6f5f7;
    border: 1px solid #f6f5f7;
    border-radius: 4px;
    font-size: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
    font-weight: 500;
    padding: 0 5px;
}
.left_website_btn:hover{
    opacity: 0.9;
    color: initial;
}

.container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background: #27a776;
	background: -webkit-linear-gradient(to right, #27a776, #27a776);
	background: linear-gradient(to right, #27a776, #27a776);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
  	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  	transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 40%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.container.right-panel-active .overlay-right {
	transform: translateX(20%);
}

.social-container {
	margin: 20px 0;
}

.social-container a {
	border: 1px solid #DDDDDD;
	border-radius: 50%;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	margin: 0 5px;
	height: 40px;
	width: 40px;
}
.error{
    color: red !important;
    text-align: left !important;
    font-weight: 300;
    font-size: 12px;
}
.error_msg{
    background-color: crimson;
    color: #fff;
    text-align: center;
    padding: 5px 5px;

}


    </style>
</head>
<body>


    <div class="container" id="container">

        <div class="form-container sign-up-container">

            <form action="{{ route('register') }}" method="post" style="padding: 50px 50px">
                @csrf
                <h2 style="color: black">Create Account</h2>


                {{-- <input type="text" placeholder="Name" /> --}}
                <input type="text" name="name" class="@error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" autocomplete="name" autofocus />
                @error('name')
                    <span class="invalid-feedback " role="alert">
                        <strong class="error">{{ $message }}</strong>
                    </span>
                @enderror
                {{-- <input type="email" placeholder="Email" /> --}}
                <input type="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="email" autofocus />
                @error('email')
                    <span class="invalid-feedback " role="alert">
                        <strong class="error">{{ $message }}</strong>
                    </span>
                @enderror
                <input type="tel" name="mobile" class="@error('mobile') is-invalid @enderror" placeholder="Mobile" value="{{ old('mobile') }}" autocomplete="mobile" autofocus />
                @error('mobile')
                    <span class="invalid-feedback " role="alert">
                        <strong class="error">{{ $message }}</strong>
                    </span>
                @enderror
                {{-- <input type="password" placeholder="Password" /> --}}
                <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Password" autofocus />
                @error('password')
                    <span class="invalid-feedback " role="alert">
                        <strong class="error">{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" name="password_confirmation" class="@error('password') is-invalid @enderror" placeholder="Confirm Password" autofocus />
                @error('password_confirmation')
                    <span class="invalid-feedback " role="alert">
                        <strong class="error">{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">

            <form method="POST" action="{{ route('login') }}">
                @if (session()->has('login_error'))
                    <h6 class="error_msg">{{ session()->get('login_error') ?? '' }}</h6>
                @endif
                @csrf
                <h1>Sign in</h1>

                <input type="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="email" autofocus />
                @error('email')
                    <span class="invalid-feedback " role="alert">
                        <strong class="error">{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" class="@error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password" />
                @error('password')
                    <span class="invalid-feedback " role="alert">
                        <strong class="error">{{ $message }}</strong>
                    </span>
                @enderror

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif

                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">

            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <div class="website_left">
                        <a href="{{ route('front') }}" class="left_website_btn">Go to Website</a>
                    </div>
                    <h1>Welcome</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <div class="website_left">
                        <a href="{{ route('front') }}" class="left_website_btn">Go to Website</a>
                    </div>
                    <h1></h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>


<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>

</body>
</html>
