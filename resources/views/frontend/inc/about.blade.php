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

<div>
  <div class="our-mission-row">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <img src="{{ asset('images/img/our-mission.png') }}" alt="Our Mission">
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
          <div class="content-details">
            <p class="pb-0">Our mission is to constantly upgrade with the latest technology & expand our business by
              leading the global
              market in abrasive blasting & shot blasting machine technology.</p>

            <p class="pb-0 pt-0">The Sales Team is located in Gulf Countries - Dubai. Our Quality Control Department is
              equipped with all
              the
              necessary Latest equipment. Our Company has a robust After Sales Services Facility. Our trained and
              experienced Technicians to look after the Service Calls. Our equipment is eco-friendly and provides
              optimum
              economic solutions. Our highly qualified and experienced design team using the latest software as
              Auto-Cad,
              Solid works, CATIA for designing the machine. Our Huge inventory of Spare Parts is maintained so that
              these
              are made available in Ready Stock.</p>

            <p class="pb-0 pt-0">We supply blasting machines in the aviation industry, casting and Forging industry,
              Automobile industry -
              Turbochargers, Piston, Cylinder, Gears, Clutches, Shafts. Transformer Industries – Tank, Fins, Radiators,
              Fabrication Industries – Tanks, Heat Exchangers, Poles, etc. Shipping Industries – for remove rust, paint,
              corrosion from ships using abrasives media like steel shot, grit shot, and <a
                href="/aluminum-oxide">aluminum oxide</a>. Pipe Industries –
              for cleaning & remove welding flux, remove corrosion.</p>
          </div>
        </div>
      </div>

      <div class="row pd-100">
        <div class="col-lg-6">
          <div class="our">Our Vision</div>
          <h2>Powerful Shot Blasting Machine in Australia</h2>
          <div class="row">
            <div class="main-b-r">
              <div class="row-b-1"></div>
              <div class="row-b-2"></div>
            </div>
          </div>
          <div class="content-details">
            <p class="pb-0">Micro Blaster's vision to expand its horizon by entering the export market with
              international quality
              products to achieve global recognition.</p>
            <p class="pb-0 pt-0">
              We are among the oldest in the Industry of Shot Blasting, <a href="/sand-blasting-room">Blast Room</a>
              System, Vacuum blast machine, table
              shot blast machine, tumble shot blast Manufacturers in Australia The Company has commenced production of
              Shotblasting & Blast Room many years. Since then it has delivered more than 8000 Shot Blasting & table
              blast
              equipment, tumble shot-blasting machine. Our Manufacturing Facilities consisting of the workshop is having
              18000 sq. ft. covered area.</p>
          </div>
        </div>
        <div class="col-lg-6">
          <img src="{{ asset('images/img/our-mission.png') }}" alt="Our Mission" />
        </div>
      </div>
      <div class="content-details">
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
            <img src="{{ asset('images/img/sand-blasting-icon.png') }}" alt="Best Sand Blasting Solutions"
              title="Best Sand Blasting Solutions" />
            <h3>Best Sand Blasting Solutions</h3>
            <p>We design and manufacture advanced sand blasting machines tailored to meet the unique needs of various
              industries.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/surface-prepration.png') }}" alt="Surface Preparation Expertise"
              title="Surface Preparation Expertise" />
            <h3>Surface Preparation Expertise</h3>
            <p>We specialize in providing high-quality surface cleaning, finishing, and preparation for materials such
              as metal, & concrete.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/customisation.png') }}" alt="Customized Blasting Systems"
              title="Customized Blasting Systems" />
            <h3>Customized Blasting Systems</h3>
            <p>Offering customized sandblasting equipment and systems to ensure optimal performance for specific
              applications.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/industrial-application.png') }}" alt="Industry-Specific Applications"
              title="Industry-Specific Applications" />
            <h3>Industry-Specific Applications</h3>
            <p>We serve a wide range of industries, including manufacturing, construction, automotive, aerospace, and
              more.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/maintenance-support.png') }}" alt="Maintenance and Support"
              title="Maintenance and Support" />
            <h3>Maintenance and Support</h3>
            <p>We provide ongoing maintenance services, training, and technical support to ensure your sandblasting
              equipment.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="why-choose-sty">
            <img src="{{ asset('images/img/global.png') }}" alt="Global Distribution Network"
              title="Global Distribution Network" />
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
        <img src="{{ asset('images/img/global-offices.png') }}" alt="Global Office" />
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
              @foreach ($clients as $client)
              <div class="swiper-slide">
                <div class="card-sty">
                  <aside class="card-ab team1">
                    <img src="{{ url('images/client/' . $client->image) }}" alt="{{$client->title}}">
                    <div class="caption">
                      <h2 class="name">{{$client->title}}</h2>
                      <p class="datesty"><i class="fas fa-link"></i> URL: {{$client->url}}</p>
                    </div>
                  </aside>
                </div>
              </div>
              @endforeach
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
                <div class="cont-row">
                  <div class="row-lable"><i class="fa fa-mobile-alt"></i> </div>
                  <div class="row-text mobile">
                    <select class="custom_select">
                      <option selected value="+91">+91</option>
                      @foreach($countries as $country)
                      <option value="{{$country->dial_code}}">{{$country->dial_code}}</option>
                      @endforeach
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