
@extends('layouts.frontend_app')

@section('title', 'My Profile')

@push('css')
    <style>
        label{
            font-weight: 600;
            font-size: 16px;
            color: #000;
        }
        .error{
            color: crimson;
        }
        ul{
            list-style-type: none;
        }
        .left_sidebar ul li {
            padding-bottom: 15px;
        }
        .left_sidebar ul li a{
            color: #2d2d2d;
            font-size: 18px;
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
