@extends('layouts.frontend_app')

@section('title', 'Welcome to Photography')

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
            padding-bottom: 12px;
        }
        .left_sidebar ul li a{
            color: #2d2d2d;
            font-size: 18px;
        }
        img{
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
<div class="page-header d-flex align-items-center">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center contact_header">

        </div>
      </div>
    </div>
  </div><!-- End Page Header -->

  <!-- ======= Contact Section ======= -->
  <section id="" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-12 m-auto">
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
                                <li><a href="{{ route('user.profile') }}" style="font-size: 17px"><i class="bi bi-person-square me-2" ></i>My Profile</a> </li>
                                <li><a href="{{ route('user.order') }}" style="font-size: 17px"><i class="bi bi-newspaper me-2"></i> My Order</a> </li>
                                <li><a href="{{ route('user.logout') }}" style="font-size: 17px"><i class="bi bi-box-arrow-right me-2"></i> Logout</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="right_sidebar">
                            <div class="card py-3" style="min-height: 620px">
                                <div class="card-header">
                                    <h5 class="text-dark">My Order</h5>
                                </div>
                                <div class="card-body">
                                    @if($orders->count() > 0)
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">SI</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">category</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">date</th>
                                            <th scope="col">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>{{$key + 1  }}</td>
                                                    <td>{{ $order->user->name ?? '' }}</td>
                                                    <td>
                                                        <img src="{{(''.$order->portfolio->image) }}" alt="Order Image" width="60" height="40" class="rounded">
                                                    </td>
                                                    <td>{{ $order->portfolio->title ?? '' }}</td>
                                                    <td>{{ $order->portfolio->category->name ?? '' }}</td>
                                                    <td>{{ $order->portfolio->price ?? '' }}</td>
                                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('user.order.destroy', $order->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                      </table>
                                      @else
                                      <p class="w-100 bg-info py-2 text-center rounded">You have no order yet!!</p>

                                      @endif

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
