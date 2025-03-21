@section('title', $about->seo_title)
@section('keyword', $about->seo_keywords)
@section('description', $about->seo_description)

@extends('frontend.layout.master')


@push('styles')
<style>
  body,
  html {
    overflow-x: hidden;
    max-width: 100%;
  }
</style>
@endpush

@section('content')
<div class="about-breadcrumb-bg">
  <div class="container">
    <div class="row about-sty">
      <div class="col-sm-6">
        <about> About Us </about>
      </div>

      <div class="col-sm-6 float-st"> <a href="{{ route('home') }}"><i class="fas fa-home"></i> </a>
        <ab> <i class="fa fa-angle-double-right"></i> About Us <ab>
      </div>

    </div>
  </div>
</div>
</div>



<div>

  <!--Our Mission strat-->


  <div class="our-mission-row">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <img src="{{ asset('images/img/our-mission.png') }}" alt="about img">
        </div>
        <div class="col-lg-6">
          <div class="our">Our Mission
            <h2>Powerful Sand Blasting Solutions</h2>
          </div>

          <div class="row">
            <div class="main-b-r">
              <div class="row-b-1"></div>
              <div class="row-b-2"></div>
            </div>
          </div>
          <p>Our mission is to provide cutting-edge sand blasting machines that deliver unmatched precision, efficiency,
            and reliability. We are dedicated to enhancing surface treatment processes across industries by offering
            innovative solutions that improve cleaning, finishing, and preparation. By combining advanced technology
            with sustainable practices, we aim to empower businesses to achieve exceptional results while maintaining
            the highest standards of quality and performance.</p>
        </div>
      </div>

      <div class="row pd-100">

        <div class="col-lg-6">
          <div class="our">Our Mission</div>
          <h2>Powerful Sand Blasting Solutions</h2>
          <div class="row">
            <div class="main-b-r">
              <div class="row-b-1"></div>
              <div class="row-b-2"></div>
            </div>
          </div>
          <p>Our mission is to provide cutting-edge sand blasting machines that deliver unmatched precision, efficiency,
            and reliability. We are dedicated to enhancing surface treatment processes across industries by offering
            innovative solutions that improve cleaning, finishing, and preparation. By combining advanced technology
            with sustainable practices, we aim to empower businesses to achieve exceptional results while maintaining
            the highest standards of quality and performance.</p>
        </div>

        <div class="col-lg-6">
          <img src="{{ asset('images/img/our-mission.png') }}" alt="about img" />
        </div>
      </div>
      <div class="row">
        {!! $about->description !!}
      </div>
    </div>
  </div>
  <!-- Our Missin End-->

  <div class="what-we-do">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/sand-blasting-icon.png') }}" alt="job image" title="job image" />
            <h3>Best Sand Blasting Solutions</h3>
            <p>We design and manufacture advanced sand blasting machines tailored to meet the unique needs of various
              industries.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/surface-prepration.png') }}" alt="job image" title="job image" />
            <h3>Surface Preparation Expertise</h3>
            <p>We specialize in providing high-quality surface cleaning, finishing, and preparation for materials such
              as metal, & concrete.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/customisation.png') }}" alt="job image" title="job image" />
            <h3>Customized Blasting Systems</h3>
            <p>Offering customized sandblasting equipment and systems to ensure optimal performance for specific
              applications.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/industrial-application.png') }}" alt="job image" title="job image" />
            <h3>Industry-Specific Applications</h3>
            <p>We serve a wide range of industries, including manufacturing, construction, automotive, aerospace, and
              more.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/maintenance-support.png') }}" alt="job image" title="job image" />
            <h3>Maintenance and Support</h3>
            <p>We provide ongoing maintenance services, training, and technical support to ensure your sandblasting
              equipment.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/global.png') }}" alt="job image" title="job image" />
            <h3>Global Distribution Network</h3>
            <p>We provide global access to top-quality sandblasting solutions for businesses everywhere.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!---what we do ---->

  <div class="global-row">
    <div class="container">
      <div class="row">
        <p>We Have a Global Presence</p>
        <h3>Providing Innovative Sand Blasting Solutions to Industries Worldwide with Precision and Reliability</h3>
      </div>
      <div class="row">
        <div class="main-b-r">
          <div class="row-b-1"></div>
          <div class="row-b-2"></div>
        </div>
      </div>
      <div class="row">
        <img src="{{ asset('images/img/global-offices.png') }}" alt="job image" />
      </div>

    </div>

  </div>

  <!-- what we do end---->

  <div class="explore-our-range-row mbt">
    <div class="container">
      <div class="row">
        <div class="explore-our-range">
          <p>Trusted by Industry Leaders</p>
          <h3> Our Clients Rely on our Sandblasting Solutions for Precision, Efficiency, and Unmatched Quality</h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="main-b-r">
        <div class="row-b-1"></div>
        <div class="row-b-2"></div>
      </div>
    </div>

    <div class="explore-slider">

      <div class="container">
        <div class="row">

          <div class="swiper mySwiper">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-wrapper">
              <div class="swiper-slide">

                <div class="card-sty">
                  <aside class="card-ab team1">
                    <img src="{{ asset('images/img/our-clients.png') }}" alt="about slider">
                    <div class="caption">
                      <h2 class="name">Indian Railways</h2>

                      <p class="datesty"><i class="fas fa-link"></i> URL: wwwindianrailways.in</p>
                    </div>
                  </aside>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-sty">
                  <aside class="card-ab team1">
                    <img src="{{ asset('images/img/our-clients.png') }}" alt="about slider">
                    <div class="caption">
                      <h2 class="name">Indian Railways</h2>

                      <p class="datesty"><i class="fas fa-link"></i> URL: wwwindianrailways.in</p>
                    </div>
                  </aside>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-sty">
                  <aside class="card-ab team1">
                    <img src="{{ asset('images/img/our-clients.png') }}" alt="about slider">
                    <div class="caption">
                      <h2 class="name">Indian Railways</h2>

                      <p class="datesty"><i class="fas fa-link"></i> URL: wwwindianrailways.in</p>
                    </div>
                  </aside>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-sty">
                  <aside class="card-ab team1">
                    <img src="{{ asset('images/img/our-clients.png') }}" alt="about slider">
                    <div class="caption">
                      <h2 class="name">Indian Railways</h2>

                      <p class="datesty"><i class="fas fa-link"></i> URL: wwwindianrailways.in</p>
                    </div>
                  </aside>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-sty">
                  <aside class="card-ab team1">
                    <img src="{{ asset('images/img/our-clients.png') }}" alt="about slider">
                    <div class="caption">
                      <h2 class="name">Indian Railways</h2>

                      <p class="datesty"><i class="fas fa-link"></i> URL: wwwindianrailways.in</p>
                    </div>
                  </aside>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-sty">
                  <aside class="card-ab team1">
                    <img src="{{ asset('images/img/our-clients.png') }}" alt="about slider">
                    <div class="caption">
                      <h2 class="name">Indian Railways</h2>

                      <p class="datesty"><i class="fas fa-link"></i> URL: wwwindianrailways.in</p>
                    </div>
                  </aside>
                </div>
              </div>

            </div>


          </div>

        </div>
      </div>
    </div>
  </div>



  <!------ get in tough strat ----->
  <div class="get-in-tough">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="get-touch-content">
              <touch>Get in Touch <br> with Us</touch>
              <p>We’re here to assist you! Reach out for any inquiries, requirements, or bulk order, and we’ll get back
                to you as soon as possible.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="get-touch-contact">
              <form id="singleProductForm" method="POST">
                {{-- {{ Form::open(['url' => route('inquery'), 'method'=>'POST', 'files' => true, 'class'=>'']) }} --}}
                {{ csrf_field() }}
                <div class="cont-row">
                  <div class="row-lable"><i class="fa fa-user"></i> </div>
                  <div class="row-text">
                    <input type="text" id="name" name="name" placeholder="Name" required="">
                  </div>
                </div>
                <div class="cont-row">
                  <div class="row-lable"><i class="fa fa-envelope"></i> </div>
                  <div class="row-text">
                    <input type="text" id="email" name="email" placeholder="Email" required="">
                  </div>
                </div>
                {{-- <div class="cont-row">
                  <div class="row-lable"><i class="fa fa-mobile-alt"></i> </div>
                  <div class="row-text">
                    <input type="text" id="mobile" name="mobile" placeholder="Mobile" required="">
                  </div>
                </div> --}}
                <div class="cont-row">
                  <div class="row-lable"><i class="fa fa-mobile-alt"></i> </div>
                  <div class="row-text mobile">
                    {{-- <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" required=""> --}}

                    <select class="custom_select">
                      <option disabled selected value="default">+91</option>
                      <option value="US">US</option>
                      <option value="UK">UK</option>
                      <option value="IN">IN</option>
                    </select>

                    <input id="seller_phone1" class="sty-in" name="mobile" placeholder="Your Mobile number"
                      required=""></input>
                  </div>
                </div>
                <div class="cont-row">
                  <div class="row-lable"><i class="fa fa-file-alt"></i> </div>
                  <div class="row-text">
                    <input type="text" id="message" name="message" placeholder="Requirement" required="">
                  </div>
                </div>
                <div class="cont-row">
                  <div class="row-captcha">
                    <div class="g-recaptcha" data-sitekey="6Lfg_ugqAAAAAL3f55MwuMjAsnqeke4H16urHdV-"
                      data-callback="recaptchaCallback"></div>

                    {{-- 6Lfg_ugqAAAAAHz9_CgjaWdA8Fr6y7uuVwFAwgeS --}}
                  </div>
                  <div class="submit-sty cont-page">
                    <button class="custom-btn btn-3 get-but submit" type="submit" value="Submit">
                      <span> <i class="fa fa-send"></i> &nbsp;Submit</span></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!------ get in tough strat ----->


  <!--- FAQ section start----->
  <div class="faq-row">
    <div class="container">
      <div class="row">
        <p>Frequently Asked Questions (FAQs)</p>
        <h3>Get Answers to Your Most Common Questions About Sand Blasting & Shot Blasting</h3>
      </div>
      <div class="row">
        <div class="main-b-r">
          <div class="row-b-1"></div>
          <div class="row-b-2"></div>
        </div>
      </div>
    </div>


    @if(!empty($faqs))
    <div class="container">
      <div class="row">

        <div class="acc-sty">
          @foreach($faqs as $faq)
          <div class="acc-faq-sty">
            <button class="accordion">
              <p>{{$faq->title}}</p>
            </button>
            <div class="panel">
              <p>{{$faq->description}}</p>

            </div>

          </div>
          @endforeach
        </div>

      </div>
    </div>
    @endif
  </div>
</div>

@endsection