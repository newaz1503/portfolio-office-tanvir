 <!-- ======= Gallery Single Section ======= -->
 <section id="gallery-single" class="gallery-single">
    <div class="position-relative h-100">
      <div class="portfolio-details-slider">
        <div class="align-items-center">
          <div class="sale_header_box">

            <img src="{{ asset(''.$site_setting->header_image ?? '' ) }}" alt="{{ $site_setting['header_title'] }}">
            <div class="bg_overlay"></div>
            <div class="slider_overlay text-center sale_title_box">
              <h4 class="sale_title">{{ $site_setting['header_title'] }}</h4>
              <div class="form_box mt-4">
                <form method="GET" action="{{ route('search') }}">
                  <div class="form-group d-flex">
                    <input type="text" name="search" value="{{ Request::get('search') ?? '' }}" class="form-control rounded-0 rounded-start sale_input fs-6"
                      placeholder="Search Photo..." / required>
                    <button type="submit" class="btn btn-primary rounded-0 rounded-end sale_btn"><i
                        class="bi bi-search sale_search_icon"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Gallery Single Section -->
