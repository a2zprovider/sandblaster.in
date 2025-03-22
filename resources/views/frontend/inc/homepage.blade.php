@extends('frontend.layout.master')
@section('title', $setting->h_seo_title)
@section('keyword', $setting->h_seo_keywords)
@section('description', $setting->h_seo_description)

@section('schema')
<script type="application/ld+json">
  {
		"@context": "https://schema.org",
		"@type": "Organization",
		"name": "Sand Blaster",
		"url": "{{ url()->current() }}",
		"logo": "{{ url('images/setting/logo',$setting->logo) }}",
		"contactPoint": {
			"@type": "ContactPoint",
			"telephone": "{{$setting->mobile}}",
			"contactType": "sales",
			"areaServed": "IN",
			"availableLanguage": "en"
		},
		"sameAs": [
			"{{ url()->current() }}"
		]
	}
</script>
@if(count($faqs))
<script type="application/ld+json">
  {
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
			@foreach($faqs as $k => $faq) {

				"@type": "Question",
				"name": "{{$faq->title}}",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "{{ $faq->description }}"
				}
			}
			@if(count($faqs) - 1 > $k),
			@endif

			@endforeach
		]
	}
</script>

<script type="application/ld+json">
  {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
          {
              "@type": "ListItem",
              "position": 1,
              "name": "Home",
              "item": "{{ url('/') }}"
          },
          {
            @foreach($product as $index => $pro)
              "@type": "ListItem",
              "position": {{ $index + 2 }},
              "name": "{{$pro->title}}",
              "item": "{{ route('page', $pro->slug) }}"
              @endforeach
          }
         
      ]
  }
</script>
@endif
@stop
@section('content')
<div class="slide-row">
  <div class="container">
    <div class="row head-text-sty">
      <div class="col-lg-6">
        <div class="slider-section">
          <h2>Sand Blasting Machine</h2>

          <div class="p-sty">
            <p>Sand Blasting Machine can be used to eliminate old paint, decrease a rough exterior surface or give
              configuration to an object. Abrasives can be used such as copper slag, steel grit, pieces of walnut,
              powder abrasive, steel shot, plastic abrasive media, aluminum oxide, and many others.
            </p>
          </div>
        </div>
        <div class="get-q-sty">

          <button type="button" class="custom-btn btn-3 get-but" data-bs-toggle="modal" data-bs-target="#myModal-1">
            <span><img src="{{ asset('images/img/quote.png') }}" alt="job image" title="job image" /> Get Quotation
            </span></button>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="slider-image-section">
          <img src="{{ asset('images/img/p7-500-airo.png') }}" alt="job image" title="job image" />
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!--feature section--->

<div class="features-sec-row">
  <div class="container">
    <div class="row">
      <div class="features-sec">
        <p>What are the</p>
        <h2>Features of Sand Blasting Machine</h2>
      </div>
    </div>
    <div class="row">
      <div class="main-b-r">
        <div class="row-b-1"></div>
        <div class="row-b-2"></div>
      </div>
    </div>
  </div>
  <div class="container pd-t-20">
    <div class="row">
      <div class="col-lg-5">
        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>
          <div class="feat-sec-cont-img">
            <img src="{{ asset('images/img/icon-1.png') }}" alt="job image" title="job image" />
          </div>
        </div>
        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>
          <div class="feat-sec-cont-img">
            <img src="{{ asset('images/img/icon-2.png') }}" alt="job image" title="job image" />
          </div>
        </div>
        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>
          <div class="feat-sec-cont-img">
            <img src="{{ asset('images/img/icon-3.png') }}" alt="job image" title="job image" />
          </div>
        </div>
        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>
          <div class="feat-sec-cont-img">
            <img src="{{ asset('images/img/icon-4.png') }}" alt="job image" title="job image" />
          </div>
        </div>

      </div>
      <div class="col-lg-2">
        <div class="feature-sec-main-img">
          <img src="{{ asset('images/img/features-sand-blasting-machine.png') }}" alt="job image" title="job image" />
        </div>
      </div>
      <div class="col-lg-5">
        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont-img-r">
            <img src="{{ asset('images/img/icon-5.png') }}" alt="job image" title="job image" />
          </div>
          <div class="feat-sec-cont-r">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>
        </div>

        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont-img-r">
            <img src="{{ asset('images/img/icon-6.png') }}" alt="job image" title="job image" />
          </div>
          <div class="feat-sec-cont-r">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>

        </div>

        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont-img-r">
            <img src="{{ asset('images/img/icon-7.png') }}" alt="job image" title="job image" />
          </div>
          <div class="feat-sec-cont-r">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>

        </div>

        <div class="feat-sec-cont-row">
          <div class="feat-sec-cont-img-r">
            <img src="{{ asset('images/img/icon-8.png') }}" alt="job image" title="job image" />
          </div>
          <div class="feat-sec-cont-r">
            <h3>Abrasive Material Hopper</h3>
            <p>Stores the abrasive material (like sand, steel
              grit, or other abrasives).</p>
          </div>

        </div>

      </div>

    </div>

  </div>
  <div class="featrures-btn-row">
    <div class="container">
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
          <div class="fet-but-sty">
            <button class="custom-btn btn-3" type="submit"><span> Check Out More Features</span></button>
          </div>
        </div>
        <div class="col-lg-4"></div>
      </div>
    </div>

  </div>
</div>
<div class="why-choose-us-row">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="why-choose-sty">
          <img src="{{ asset('images/img/abrasive-media-icon.png') }}" alt="job image" title="job image" />
          <h3>Abrasive media</h3>
          <p>The material used in sandblasting, such as sand, steel grit, glass beads, or aluminum oxide, is crucial for
            the effectiveness of the process.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="why-choose-sty">
          <img src="{{ asset('images/img/safety-icon.png') }}" alt="job image" title="job image" />
          <h3>Safety Considerations</h3>
          <p>Sand Blasting produces significant dust, which can be harmful to the operator’s health. Safety measures
            such as protective clothing, gloves, & goggles, are essential.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="why-choose-sty">
          <img src="{{ asset('images/img/cost-effective-icon.png') }}" alt="job image" title="job image" />
          <h3>Efficiency and Cost-Effectiveness</h3>
          <p>Sand Blasting is an efficient and quick method for cleaning and finishing. With the media reclamation
            system, abrasives can be reused, which makes it more cost-effective.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="why-choose-sty">
          <img src="{{ asset('images/img/Blast Pot Design.png') }}" alt="job image" title="job image" />
          <h3>Blast Pot Design</h3>
          <p>Check if the blast pot is designed for easy loading and unloading of materials. Some machines come with
            features like automatic media flow systems for greater efficiency.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="why-choose-sty">
          <img src="{{ asset('images/img/Noise and Dust Control.png') }}" alt="job image" title="job image" />
          <h3>Noise and Dust Control</h3>
          <p>For a safer and more comfortable working environment, look for machines that feature effective noise
            suppression and advanced dust control systems, such as vacuums.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="why-choose-sty">
          <img src="{{ asset('images/img/maintenance.png') }}" alt="job image" title="job image" />
          <h3>Ease of Use and Maintenance</h3>
          <p>Easy to operate and maintain, with features such as abrasive media refilling, & quick nozzle changes. A
            machine that’s difficult to use or maintain will lead to inefficiency.</p>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="explore-our-range-row">
  <div class="container">
    <div class="row">
      <div class="explore-our-range">
        <p>Explore Our Wide Range of</p>
        <h3>Sand Blasting Machines and Solutions to Meet Your Needs!</h3>
      </div>
    </div>
    <div class="row">
      <div class="main-b-r">
        <div class="row-b-1"></div>
        <div class="row-b-2"></div>
      </div>
    </div>
  </div>
  @if(count($product))
  <div class="container">
    <div class="row">

      <div class="swiper mySwiper">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-wrapper">
          @foreach($product as $k=>$pro)
          <div class="swiper-slide">

            <div class="card-sty">
              <aside class="card team1">
                <img
                  src="{{ $pro->thumb_image ? url('images/product/' . $pro->thumb_image) : url('images/product/' . $pro->image) }}"
                  style="border-radius: 30px;" alt="{{$pro->title}}">
                <div class="caption">
                  <h2 class="name"><a href="{{ route('page', $pro->slug) }}">{{$pro->title}}</a></h2>
                  <div class="star-sty">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-full"></i>
                  </div>
                  <p class="price">{{$pro->price_range}}</p>
                  <div class="slider-button-sec-1">

                    <button type="button" class="custom-btn btn-3 get-but" data-bs-toggle="modal"
                      data-bs-target="#myModal-1">
                      <span><img src="{{ asset('images/img/quote.png') }}" alt="job image" title="job image" /> Get
                        Quotation </span></button>

                  </div>

                </div>
              </aside>
            </div>
          </div>
          @endforeach

        </div>

        {{-- <div class="swiper-pagination"></div> --}}
      </div>

    </div>
  </div>
  @endif
</div>

<!--types of machine start -->
<div class="types-of-machine">
  <div class="container">
    <div class="row">
      <div class="">
        <p class="psty-1">Types of Sand Blasting Machines</p>
        <p class="psty-2">Exploring the Different Variations of Sand Blasting Equipment for Efficient Surface
          Cleaning</p>
      </div>
      <div class="row">
        <div class="main-b-r">
          <div class="row-b-1"></div>
          <div class="row-b-2"></div>
        </div>
      </div>
    </div>

    <div class="row types-content">
      <div class="col-lg-6">
        <div class="types-content-sty pb-t-100">
          <h4> Suction <span>Blasting Machine</span> </h4>
          <p>Suction blasting machines are ideal for small to medium-sized jobs and are often used for light cleaning
            and surface preparation. They operate by drawing abrasive media into the blast hose through a venturi
            nozzle, where air pressure forces it onto the work surface. These machines are simple, cost-effective, and
            can be used with a variety of abrasives.</p>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="{{asset('images/img/suction-blasting-cabinet.png')}}" alt="suction blasting cabinet">
      </div>
    </div>

    <div class="row types-content">
      <div class="col-lg-6">
        <img src="{{asset('images/img/pressure-blasting-cabinet.png')}}" alt="suction blasting cabinet">
      </div>
      <div class="col-lg-6">
        <div class="types-content-sty pb-t-100">
          <h4> Pressure <span> Blasting Machine</span> </h4>
          <p>Pressure blasting machines use a pressurized system to force abrasive media onto surfaces. The machine is
            pressurized, and when the nozzle is opened, the media is pushed out at a much higher speed than with suction
            machines. This results in faster and more aggressive cleaning, making it ideal for heavy-duty applications
            like rust removal or paint stripping.</p>
        </div>
      </div>

    </div>

    <div class="row types-content">
      <div class="col-lg-6">
        <div class="types-content-sty pb-t-100">
          <h4> Wet <span>Blasting Machine<span> </h4>
          <p>Wet blasting machines mix water with the abrasive media, reducing dust and providing a cleaner finish. This
            type is particularly useful for applications where controlling airborne particles is essential, such as in
            indoor environments or for delicate parts that require a gentler approach.</p>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="{{asset('images/img/wet-blasting-cabinet.png')}}" alt="suction blasting cabinet">
      </div>
    </div>
  </div>
</div>

<!--types of machine end -->

<!---power of sand blasting start---->

<div class="explore-our-range-row">
  <div class="container">
    <div class="row">

      <div class="explore-our-range">
        <p>Unleashing the Power of Sand Blasting</p>
        <h3> Discover the Efficiency, Versatility, and Benefits of Sand Blasting Machines in Various Industries</h3>
      </div>
    </div>
    <div class="row">
      <div class="main-b-r">
        <div class="row-b-1"></div>
        <div class="row-b-2"></div>
      </div>
    </div>
  </div>

  <div class="explore-slider">

    @if(count($blog_cat))
    <div class="container">
      <div class="row">

        <div class="swiper mySwiper">
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-wrapper">
            @foreach($blog_cat as $blog)
            <div class="swiper-slide">

              <div class="card-sty">
                <aside class="card-h team1">

                  <img
                    src="{{ $blog->thumb_image ? url('images/blog/' . $blog->thumb_image) : url('images/blog/' . $blog->image) }}"
                    class="blog-img" alt="{{$blog->title}}">
                  <div class="caption">
                    <h2 class="name"><a href="{{ route('blog.detail', $blog->slug) }}">{{$blog->title}}</a></h2>
                    <div class="card-cat-sty">
                      <p> <i class="fa fa-th"></i> &nbsp; Category: {{$blog->title}}
                      <p>
                    </div>
                    <p class="datesty"><i class="fa fa-calendar"></i> &nbsp; Published On: {{
                      date_format($blog->created_at, 'F d, Y') }}</p>
                  </div>
                </aside>
              </div>
            </div>
            @endforeach
          </div>
          {{-- <div class="swiper-pagination"></div> --}}
        </div>

      </div>
    </div>
    @endif
  </div>
</div>
</div>
</div>

<!-- power of sand blasting end--->
<!------ get in tough strat ----->
<div class="get-in-tough">
  <div class="overlay">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="get-touch-content">
            <touch>Get in Touch <br> with Us</touch>
            <p>We’re here to assist you! Reach out for any inquiries, requirements, or bulk order, and we’ll get back to
              you as soon as possible.</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="get-touch-contact">
            <form id="singleProductForm" method="POST">
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
                  <input type="text" id="mobile" name="mobile" placeholder="Mobile Number" required="">
                </div>
              </div> --}}

              <div class="cont-row">
                <div class="row-lable"><i class="fa fa-mobile-alt"></i> </div>
                <div class="row-text mobile">
                  {{-- <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" required=""> --}}

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
                  <button type="submit" class="custom-btn btn-3 get-but submit" value="Submit">
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

  </div>
  <div class="main-b-r">
    <div class="row-b-1"></div>
    <div class="row-b-2"></div>
  </div>
  @if(count($faqs))
  <div class="container">
    <div class="row">

      <div class="acc-sty">
        @foreach($faqs as $key=>$faq)
        <div class="acc-faq-sty">
          <button class="accordion">
            <p>{{ $faq->title }}</p>
          </button>
          <div class="panel">
            <p>{{ $faq->description }}</p>

          </div>
        </div>
        @endforeach

      </div>

    </div>
  </div>
  @endif
</div>

<!---- FAQ section end------>


@endsection