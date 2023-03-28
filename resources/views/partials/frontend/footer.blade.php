<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
              <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <nav id="navbar" class="navbar">
                      <ul class="d-flex gap-4">
                          <li class="dropdown"><a href="javascript: void(0)"><span>PORTFOLIO</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                              <ul class="first_dropdown">
                                @foreach ($portfolio_types as $portfolio_type)
                                    <li><a href="{{ route('portfolio.type', $portfolio_type->slug) }}" class="active">{{ $portfolio_type->name ?? '' }}</a></li>
                                @endforeach
                              </ul>
                            </li>
                            <li class="dropdown second_menu"><a href="javascript: void(0)"><span>FOR PHOTOGRAPHERS</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                              <ul class="second_dropdown">
                                <li><a href="{{ route('service') }}" class="active">1 On 1 Mentoring</a></li>
                                <li><a href="https://www.youtube.com/playlist?list=PLa-m46gtkZKcnHQ6B5klbj7UkYwwojbAg" target="blank">A Day In My Life Series</a></li>
                                {{-- <li><a href="gallery.html">Fstopper's Articles</a></li>
                                <li><a href="gallery.html">Tutorial</a></li> --}}
                              </ul>
                            </li>
                      </ul>
                    </nav><!-- .navbar -->
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <nav id="navbar" class="navbar">
                      <ul class="d-flex gap-4">
                        <li><a href="{{ route('contact') }}">INQUIRIES</a></li><br>
                        <li class="second_menu"><a href="{{ route('gallery') }}">PORTRAIT SESSION</a></li>
                      </ul>
                    </nav><!-- .navbar -->
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <nav id="navbar" class="navbar">
                      <ul class="d-flex gap-5">
                        <li><a href="{{ route('about') }}">ABOUT</a></li>
                        <li class="last_second_menu"><a href="{{ route('sale') }}">FOR SALE</a></li>
                      </ul>
                    </nav><!-- .navbar -->
                  </div>
              </div>


            </div>
            <div class="col-12 col-sm-12 col-md-6">

            </div>
        </div>
        <hr>
      <div class="copyright mt-5">
        <div class="row justify-content-between">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="float-start">
                    &copy; Copyright <strong>Ayaantec Limited</strong>. All Rights Reserved
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="header-social-links float-end d-flex gap-4">
                    <a href="{{ $site_setting->fb ?? '' }}" target="blank" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="{{ $site_setting->tw ?? '' }}" class="twitter" target="blank"><i class="bi bi-twitter"></i></a>
                    <a href="{{ $site_setting->ln ?? '' }}" class="instagram" target="blank"><i class="bi bi-instagram"></i></a>
                    <a href="{{ $site_setting->yt ?? '' }}" class="youtube" target="blank"><i class="bi bi-youtube"></i></i></a>
                  </div>
            </div>
        </div>

      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/Tanvir Ahmed-bootstrap-photography-website-template/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
      </div>
    </div>
  </footer>
