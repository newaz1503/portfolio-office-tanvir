@extends('layouts.frontend_app')

@section('title', 'Contact')

@push('css')

@endpush

@section('content')
<!-- ======= End Page Header ======= -->
<div class="page-header d-flex align-items-center">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center pt-5 contact_header">
          <h2>Inquiries</h2>
          <p>I respond within an hour to my emails but even quicker on Whatsapp, if that's you're preferred method please let me know!</p>

        </div>
      </div>
    </div>
  </div><!-- End Page Header -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact pt-4 ">
    <div class="container">

      <div class="row gy-4 justify-content-center pb-5">

        <div class="col-lg-3">
          <div class="info-item d-flex">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h4>Location:</h4>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div>
        </div><!-- End Info Item -->

        <div class="col-lg-3">
          <div class="info-item d-flex">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h4>Email:</h4>
              <p>info@example.com</p>
            </div>
          </div>
        </div><!-- End Info Item -->

        <div class="col-lg-3">
          <div class="info-item d-flex">
            <i class="bi bi-phone flex-shrink-0"></i>
            <div>
              <h4>Call:</h4>
              <p>+1 5589 55488 55</p>
            </div>
          </div>
        </div><!-- End Info Item -->

      </div>

      <div class="row justify-content-center mt-4">

        <div class="col-lg-9">
            @if (Session::has('message'))
                <div class="bg-success text-white mb-3 p-1 px-3 rounded"><small>{{ Session::get('message') }}</small></div>
            @endif
          <form action="{{ route('contact.store') }}" method="post" role="form" >
            @csrf
            <div class="form-group mb-3">
              <label for="" class="mb-2">YOUR NAME</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
              @if($errors->has('name'))
                <div class="error text-danger">{{ $errors->first('name') }}</div>
             @endif
            </div>
            <div class="form-group mb-3">
              <label for="" class="mb-2">PREFERRED METHOD OF CONTACT *</label>
              <div class="">
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input" type="radio" name="contact_method" id="Email" value="email">
                  <label class="form-check-label" for="Email">
                    Email
                  </label>
                </div>
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input" type="radio" name="contact_method" id=" Call" value="call">
                  <label class="form-check-label" for=" Call">
                    Call
                  </label>
                </div>
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input" type="radio" name="contact_method" id="Text" value="text">
                  <label class="form-check-label" for="Text">
                    Text
                  </label>
                </div>
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input" type="radio" name="contact_method" id="Whatsapp" value="whatsapp">
                  <label class="form-check-label" for="Whatsapp">
                    Whatsapp
                  </label>
                </div>
              </div>
              @if($errors->has('contact_method'))
                <div class="error text-danger">{{ $errors->first('contact_method') }}</div>
                @endif
            </div>
              <div class="form-group mb-3">
                <label for="" class="mb-2">CONTACT INFO *</label>
                <input type="text" name="contact_info" class="form-control " id="name" placeholder="Contact Info">
                @if($errors->has('contact_info'))
                 <div class="error text-danger">{{ $errors->first('contact_info') }}</div>
                @endif
              </div>

            <div class="form-group mt-3 mb-3">
              <label for="" class="mb-2">WHAT TYPE OF PHOTOSHOOT ARE YOU LOOKING FOR?</label>
              <div class="">
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input" type="radio" name="photoshoot_type" id="Fashion" value="fashion">
                  <label class="form-check-label" for="Fashion">
                    Fashion
                  </label>
                </div>
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input " type="radio" name="photoshoot_type" id="Commercial" value="commercial">
                  <label class="form-check-label" for="Commercial">
                    Commercial
                  </label>
                </div>
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input" type="radio" name="photoshoot_type" id="Portrait" value="portrait">
                  <label class="form-check-label" for="Portrait">
                    Portrait / Portfolio
                  </label>
                </div>
                <div class="form-check d-flex gap-2 align-items-center">
                  <input class="form-check-input radio_input" type="radio" name="photoshoot_type" id="Other" value="other">
                  <label class="form-check-label" for="Other">
                    Other
                  </label>
                </div>
              </div>
              @if($errors->has('photoshoot_type'))
                 <div class="error text-danger">{{ $errors->first('photoshoot_type') }}</div>
                @endif
            </div>

              <div class="form-group mb-3">
                <label for="" class="mb-2">YOUR LOCATION *</label>
                <input type="text" class="form-control" name="location" id="email" placeholder="Your Location">
                @if($errors->has('location'))
                    <div class="error text-danger">{{ $errors->first('location') }}</div>
                 @endif
              </div>

            <div class="form-group mt-3">
              <label for="" class="mb-2">PLEASE DESCRIBE IN DETAIL WHAT YOU ARE LOOKING FOR *</label>
              <textarea class="form-control" name="details" rows="5" placeholder="Message"></textarea>
              @if($errors->has('details'))
               <div class="error text-danger">{{ $errors->first('details') }}</div>
             @endif
            </div>
            <div class="my-3">
              {{-- <div class="loading">Loading</div> --}}
              {{-- <div class="error-message"></div> --}}
              {{-- <div class="sent-message">Your message has been sent. Thank you!</div> --}}
            </div>
            <div class="text-left"><button type="submit" class="px-4 py-2 rounded">Send Message</button></div>
          </form>
        </div><!-- End Contact Form -->

      </div>

    </div>
  </section><!-- End About Section -->
@endsection

@push('script')

@endpush
