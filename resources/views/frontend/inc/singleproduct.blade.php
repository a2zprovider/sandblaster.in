@extends('frontend.layout.master')
@section('title', $page->seo_title)
@section('keyword', $page->seo_keywords)
@section('description', $page->seo_description)
@section('content')
@section('schema')
<script type="application/ld+json">
  {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{ $page->title }}",
      "image": "{{ url('images/product/' . $page->image) }}",
      "description": "{{ $page->seo_description }}",
      "brand": {
      "@type": "Brand",
      "name": "Sand Blaster"
      }
    }
</script>
@stop

@php
$images = explode(',', $page->images);
@endphp

<div class="about-breadcrumb-bg">
  <div class="container">
    <div class="row about-sty">
      <div class="col-lg-6">
        <about> {{ $page->title }} </about>
      </div>
      <div class="col-lg-6 float-st-1"><a href="{{route('home')}}"><i class="fas fa-home"></i></a>
        <ab><i class="fa fa-angle-double-right"></i></ab><a href="{{route('page.list')}}">Products</a>
        <ab><i class="fa fa-angle-double-right"></i> {{ $page->title }} </ab>
      </div>
    </div>
  </div>
</div>

<div class="pro-detail-row">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="product-slider">
          <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="{{ url('images/product/' . $page->image) }}" alt="{{ $page->title }}" />
              </div>
              @foreach($images as $imgs)
              <div class="swiper-slide">
                <img src="{{ url('images/product/imgs/' . $imgs) }}" alt="{{ $page->title }}" />
              </div>
              @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
          <div thumbsSlider="" class="swiper mySwiper-1" style="padding-top: 0px;">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="{{ url('images/product/' . $page->image) }}" alt="{{ $page->title }}" />
              </div>
              @foreach($images as $imgs)
              <div class="swiper-slide">
                <img src="{{ url('images/product/imgs/' . $imgs) }}" alt="{{ $page->title }}" />
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="caption-1 pd-10">
          <h1 class="name" style="font-size: 22px;font-weight:500;">{{ $page->title }}</h1>
          <div class="star-sty">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-full"></i>
          </div>
          <p class="price">₹{{ $page->price_range }}</p>
        </div>
        <div class="slider-button-sec-1 btn-st-span">
          <button type="button" class="custom-btn openCustomProduct btn-3 get-but"
            data-url="{{url('/ajax/product/'.$page->slug)}}">
            <span>
              <img src="{{ asset('images/img/quote.png') }}" alt="Upgrade" title="Upgrade" style="width: 30px" />
              Upgrade Your Machine
            </span>
          </button>
        </div>
        <div class="send-enq-sty">
          <h5>Send Enquiry for <b>{{ $page->title }}</b></h5>
          <form id="singleProductForm" method="POST">
            {{ csrf_field() }}
            <div class="cont-row-p" style="margin-top:10px;">
              <div class="row-lable"><i class="fa fa-user"></i> </div>
              <div class="row-text">
                <input type="text" id="name" name="name" placeholder="Name" required>
              </div>
            </div>
            <div class="cont-row-p">
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
              <div class="row-captcha">
                <div class="g-recaptcha" data-sitekey="6Lfg_ugqAAAAAL3f55MwuMjAsnqeke4H16urHdV-"
                  data-callback="recaptchaCallback"></div>
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

<div class="pro-detail-row pb-50">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="content-details">
          <div class="specification-details pb-4">
            <h2>Additional Information of {{ $page->title }}</h2>
            <table>
              @foreach(json_decode($page->field)->name as $key => $field)
              <tr>
                <td>{{ $field }}</td>
                <td>{{ json_decode($page->field)->value[$key] }}</td>
              </tr>
              @endforeach
              @foreach(json_decode($page->field1)->name as $key => $field1)
              <tr>
                <td>{{ $field1 }}</td>
                <td>{{ json_decode($page->field1)->value[$key] }}</td>
              </tr>
              @endforeach
            </table>
          </div>
          <h3> Application of {{ $page->title }} </h3>
          <div>
            {!! $page->applications !!}
          </div>
          <div>
            {!! $page->description !!}
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="sidebarcontents">
          <p>Contents</p>
          <ul id="tableOfContents"></ul>
        </div>
      </div>
    </div>
  </div>
</div>

@if(count($faqs))
<div class="faq-row" style="padding: 0px">
  <div class="container">
    <div class="row">
      <div class="faq-p-s">
        <p>Frequently Asked Questions (FAQs)</p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      @foreach($faqs as $faq)
      <div class="acc-sty">
        <div class="acc-faq-sty">
          <button class="accordion">
            <p>{{ $faq->title }}</p>
          </button>
          <div class="panel">
            <p>{{ $faq->description }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif
@if(count($product_single))
<div class="explore-our-range-row">
  <div class="container">
    <div class="row">
      <div class="explore-our-range">
        <div class="rel-pro-p">
          <p>Related Product</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="main-b-r">
        <div class="row-b-1"></div>
        <div class="row-b-2"></div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="swiper mySwiper">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-wrapper">
          @foreach($product_single as $pro)
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
                  <p class="price">₹{{$pro->price_range}}</p>
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
      </div>
    </div>
  </div>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".mySwiper-1", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 5,
    freeMode: true,
    watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
    loop: true,
    spaceBetween: 10,

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },


    });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const section = document.querySelector(".content-details");
    const tocContainer = document.getElementById("tableOfContents");

    if (!section || !tocContainer) return;

    function generateSlug(text) {
      return text.toLowerCase().replace(/[^\w\s-]/g, "").replace(/\s+/g, "-");
    }

    const headings = Array.from(section.querySelectorAll("h1, h2, h3, h4, h5, h6")).map(heading => {
      const id = generateSlug(heading.innerText);
      heading.id = id;  // Assign the ID to the heading
      return { text: heading.innerText, id: id, level: heading.tagName };
    });

    headings.forEach(({ text, id, level }) => {
      const listItem = document.createElement("li");
      listItem.style.marginLeft = level === "H3" ? "0px" : "0px"; // Indentation for subheadings

      const link = document.createElement("a");
      link.href = `#${id}`;
      link.innerText = text;
      link.onclick = function (event) {
      event.preventDefault();
      handleScroll(id);
      };

      listItem.appendChild(link);
      tocContainer.appendChild(listItem);
    });

    function handleScroll(id) {
      const targetElement = document.getElementById(id);
      if (targetElement) {
      window.scrollTo({ top: targetElement.offsetTop - 200, behavior: "smooth" });
      window.history.pushState(null, "", `#${id}`);

      // Highlight active TOC item
      document.querySelectorAll("#tableOfContents a").forEach(link => {
        link.classList.remove("active");
      });
      document.querySelector(`a[href="#${id}"]`).classList.add("active");
      }
    }
    });
</script>

@endsection