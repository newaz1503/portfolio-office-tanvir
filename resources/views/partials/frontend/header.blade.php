<header id="header" class="header d-flex align-items-center fixed-top" style="background-color: transparent;">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ route('front') }}" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
         {{-- <img src="{{ asset(''.$site_setting->logo ?? '') }}" alt="Logo"> --}}
        <h1>Tanvir Ahmed</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul class="ps-4">
            <li class="dropdown"><a href="javascript: void(0)"><span>PORTFOLIO</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    @foreach ($portfolio_types as $portfolio_type)
                        <li><a href="{{ route('portfolio.type', $portfolio_type->slug) }}" class="active">{{ $portfolio_type->name ?? '' }}</a></li>
                    @endforeach
                </ul>
            </li>
          <li><a href="{{ route('contact') }}">INQUIRIES</a></li>
          <li><a href="{{ route('about') }}">ABOUT</a></li>
          {{-- <li><a href="{{ route('gallery') }}">PORTRAIT SESSION</a></li> --}}
          <li class="dropdown"><a href="javascript: void(0)"><span>FOR PHOTOGRAPHERS</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="{{ route('service') }}" class="active">1 On 1 Mentoring</a></li>
              <li><a href="https://www.youtube.com/playlist?list=PLa-m46gtkZKcnHQ6B5klbj7UkYwwojbAg" target="blank">A Day In My Life Series</a></li>
              <!-- <li><a href="gallery.html">Fstopper's Articles</a></li>
              <li><a href="gallery.html">Tutorial</a></li> -->
            </ul>
          </li>
          <?php
                // $count = 0;
                // $total_qty = count(session()->get('cart'));
                // foreach (session()->get('cart') as $key => $item) {
                //     $count += $item['quantity'] * $count;
                // }

            ?>
          <li><a href="{{ route('sale') }}">FOR SALE</a></li>
          <li class="sidecart sidecart_des">
            <a href="javascript: void(0)">
             <i class="bi bi-bag sidecart_icon"></i>
             @if (session()->get('cart') > 0)
                <span class="cart_qty">{{count(session('cart')) ?? 0}}</span>
              @else
              <span class="cart_qty">0</span>
             @endif
           </a>
        </li>
        @auth
            <div>
                <li class="dropdown ms-4" ><a href="javascript: void(0)" style="font-size: 15px"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{ route('user.profile') }}" class="active logout_option"><i class="bi bi-person-square me-2"></i> My Profile</a></li>
                        <li><a href="{{ route('user.order') }}" class="active logout_option"><i class="bi bi-newspaper me-2"></i> My Ordfer</a></li>
                        <li><a href="{{ route('user.logout') }}" class="active logout_option" style="font-size: 20px"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </li>
                @else
                <ul class="ms-4 text-end float-end">
                    <li><a href="{{ route('login') }}" class="active">Login</a></li>

                </ul>
            </div>
        @endauth
        </ul>
      </nav><!-- .navbar -->

      <div class="header-social-links">
       </div>

    </div>
  </header>
