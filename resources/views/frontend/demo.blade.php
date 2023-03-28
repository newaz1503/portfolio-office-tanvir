
@extends('layouts.frontend_app')

@section('title', 'My Profile')

@push('css')
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
border: 1px solid #FF4B2B;
background-color: #FF4B2B;
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
justify-content: center;
flex-direction: column;
padding: 0 50px;
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
background: #FF416C;
background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
background: linear-gradient(to right, #FF4B2B, #FF416C);
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


</style>
@endpush

@section('content')


<div class="page-header d-flex align-items-center">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center pt-5 contact_header">

        </div>
      </div>
    </div>
  </div><!-- End Page Header -->

  <!-- ======= Contact Section ======= -->
  <section id="" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               <div class="row">
                <div class="card col-lg-2 pt-3">
                    <div class="left_sidebar">
                        <div class="profile_info">
                            <div class="profile_img_box text-center mb-3">
                                <img src="{{ asset('website/frontend/img/user-avatar.png') }}" alt="Avatar" width="80" height="80">
                                <div class="pt-1 text-dark">
                                    <small class="text-muted" style="font-size: 14px">{{ Auth::user()->name ?? '' }}</small>
                                    <small class="text-muted" style="font-size: 14px">{{ Auth::user()->email ?? '' }}</small>
                                </div>
                            </div>
                        </div>
                        <ul>
                            <li><a href="{{ route('user.profile') }}" style="font-size: 17px"><i class="bi bi-person-square me-2"></i>My Profile</a> </li>
                            <li><a href="{{ route('user.order') }}" style="font-size: 17px"><i class="bi bi-newspaper me-2"></i> My Order</a> </li>
                            <li><a href="{{ route('user.logout') }}" style="font-size: 17px"><i class="bi bi-box-arrow-right me-2"></i> Logout</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10">
                   <div class="right_sidebar">
                        <div class="card py-3">
                            <div class="card-header">
                                <h5 class="text-dark">Change Profile</h5>
                            </div>
                            <div class="card-body">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Change Password</button>

                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                        <div class="profile_info">
                                            <form action="{{ route('user.profile.update') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-2">
                                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                                <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                    <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" readonly>
                                                    <small class="text-dark text-muted" style="user-select: none; ">You can not update email</small>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="exampleInputEmail1" class="form-label">Phone</label>
                                                    <input type="text" name="mobile" value="{{ Auth::user()->mobile ?? '' }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Change</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                        <div class="password_info">
                                            <form action="{{ route('user.password.update') }}" method="post">
                                                @csrf

                                                <div class="mb-2">
                                                <label for="exampleInputEmail1" class="form-label">Current Password</label>
                                                <input type="password" name="current_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Current password">
                                                @if($errors->has('current_password'))
                                                    <div class="error">{{ $errors->first('current_password') }}</div>
                                                @endif
                                                </div>
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter password">
                                                    @if($errors->has('password'))
                                                        <div class="error">{{ $errors->first('password') }}</div>
                                                    @endif
                                                </div>
                                                <div class="mb-4">
                                                    <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="confirm password">
                                                    @if($errors->has('password_confirmation'))
                                                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                                    @endif
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Password</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                   </div>
                </div>
               </div>
            </div>
        </div>



    </div>
  </section><!-- End About Section -->
@endsection

@push('script')

@endpush
