@php
$productf = App\Models\Page::latest()->get()->take(4);
$blogf = App\Models\Post::latest()->get()->take(4);
$setting = App\Models\Setting::first();
@endphp
<!--- footer section---->
<div class="footer-row">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="footer-col-sty-1">
          <img src="{{asset('images/img/white-logo.png')}}" alt="white logo">
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer-col-sty">
          <p>Our Products</p>
          <ul>
            @foreach($productf as $prof)
            <li class="cool-link"><a href="{{ route('page', $prof->slug)}}">{{$prof->title}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer-col-sty">
          <p>Our blogs</p>
          <ul>
            @foreach($blogf as $blf)
            <li class="cool-link"><a href="{{ route('blog.detail', $blf->slug) }}">{{$blf->title}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer-col-sty">
          <ul>
            <div class="f-contact-d">
              <i class="fa fa-mobile"></i>
              <li><a class="cool-link" href="tel:{{$setting->mobile}}">{{$setting->mobile}}</a> </li>
            </div>
            <div class="f-contact-d">
              <i class="fa fa-envelope"></i>
              <li><a class="cool-link" href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
            </div>
            <div class="f-contact-d">
              <i class="fa fa-map-marker"></i>
              <li>{{$setting->address}}</li>
            </div>
            <div class="f-contact-d-s">
              <i class="fa fa-facebook"></i>
              <i class="fa fa-instagram"></i>
              <i class="fa fa-twitter"></i>
              <i class="fa fa-youtube"></i>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<!------ footer section end---->
<div class="f-row-b">
  <div class="container">
    <div class="row">
      <p> © Airo Shot Blast Equipments 2025 All right reserved. </p>
    </div>
  </div>
</div>


<!-- The Modal main-->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="get-in-tough">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="get-touch-content">
                  <touch>Get in Touch <br> with Us</touch>
                  <p>We’re here to assist you! Reach out for any inquiries, requirements, or bulk order, and we’ll get
                    back to you as soon as possible.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="get-touch-contact-m from-pad-2">
                  <div class="but-sty-pro-1">
                    <button type="button" class="close btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  {{ Form::open(['url' => route('inquery'), 'method'=>'POST', 'files' => true, 'class'=>'']) }}
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
    </div>
  </div>
</div>

<!---- upgrade machine modal start---->

<!-- The Modal -->
<div class="modal" id="myModal-um">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body" style="background: #fff; padding: 0; border-radius: 30px;">
        <div class="get-in-tough">
          <div class="" style="display: flex;">
            <div class="" style="width:50%;">
              <div class="get-touch-content"
                style="display: flex; padding:30px; height: 100%; flex-direction: column; justify-content: center;">
                <touch> Create Your Custom <br> Machine</touch>
                <p>Customize every components for a solution that works just for you.</p>
              </div>
              <div class="umModal-products-list" style="display: none; border-radius: 30px;">
                <div class="swiper mySwiperModalProduct" style="padding-bottom:10px;">
                  <div class="swiper-wrapper">
                  </div>
                </div>
              </div>
            </div>
            <div class="" style="width:50%;">
              <div class="get-touch-contact-pro from-pad" style="height: 100%;">
                <div class="but-sty-pro">
                  <button type="button" class="close btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="psty-pro">
                  <p>Get Your Machine Customised As Per Your Requirement</p>
                </div>
                <form action="">
                  <div class="add-umModal-form-data"></div>
                  <div class="submit-sty-1">
                    <div>
                      <button type="button" class="custmizeProduct nowbtn custom-btn btn-3 get-but" data-url="">
                        <span> <i class="fa fa-send"></i> &nbsp; Custmized Now</span>
                      </button>
                      <div>
                        <button type="reset" class="clearbtn">Clear All</button>
                      </div>
                    </div>
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

<!---  thank You Popup ---->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="myModal-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="get-in-tough">

          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="get-touch-content">
                  <touch>Get in Touch <br> with Us</touch>
                  <p>We’re here to assist you! Reach out for any inquiries, requirements, or bulk order, and we’ll get
                    back to you as soon as possible.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="get-touch-contact-m from-pad-2">
                  <div class="but-sty-pro-1">
                    <button type="button" class="close btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form id="inquiryModalForm" method="POST">
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
    </div>
  </div>
</div>

{{-- Status Modal --}}
<div class="modal submit-modal-e" id="statusShowModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close btn-close"
          style="background: none; border:0; padding: 0;margin:0;color:#000;font-size:40px;"
          data-dismiss="modal">&times;</button>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="model-cont-sty">
                <p class="icon">
                  <i class="fa-solid fa-face-sad-tear"></i>
                </p>
                <p class="title">Thank you for your inquiry!</p>
                <p class="message">You will receive our catalog with latest price soon.</p>
              </div>
              <div class="su-st-bu">
                <button type="button" class="close custom-btn btn-3 get-but" data-bs-dismiss="modal">
                  <span> Continue</span></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<!----cumtize now modal--->
<script>
  var swiper = new Swiper(".mySwiperModalProduct", {
    loop: false,
    spaceBetween: 10,
    slidesPerView: 1,
    freeMode: true,
    navigation:true,
    });
</script>
<script>
  $(document).ready(function() {
    $('#statusShowModal .close').on('click', function() {
        $('#statusShowModal').fadeOut();
        $('body').css("overflow","auto");
    });
  });
</script>

<script>
  $(document).ready(function() {
      $('#singleProductForm').on('submit', function(e) {
          e.preventDefault(); // Prevent the default form submission
  
          var formData = $(this).serialize(); // Serialize the form data
  
          $.ajax({
              url: '{{ route('inquerysp') }}', // Laravel route for form submission
              type: 'POST',
              data: formData,
              success: function(response) {
                $('#statusShowModal .modal-body').css("background", "#56AE57");
                $('#statusShowModal .icon').html('<i class="fa-solid fa-face-smile"></i>');
                $('#statusShowModal .title').html('Thank you for your inquiry!');
                $('#statusShowModal .message').html(response.message);
                $('#statusShowModal').fadeIn();
                $('body').css("overflow","hidden");
                $('#singleProductForm')[0].reset();
                if (typeof grecaptcha !== "undefined") {
                    grecaptcha.reset();
                }
              },
              error: function(xhr) {                
                $('#statusShowModal .modal-body').css("background", "#D19191"); // Red background for error
                $('#statusShowModal .icon').html('<i class="fa-solid fa-face-frown"></i>');
                $('#statusShowModal .title').html('Oops! Something went wrong.');
                $('#statusShowModal .message').html(xhr.responseJSON.message);
                $('#statusShowModal').fadeIn();
                $('body').css("overflow","hidden");
              }
          });
      });
      $('#inquiryModalForm').on('submit', function(e) {
          e.preventDefault(); // Prevent the default form submission
  
          var formData = $(this).serialize(); // Serialize the form data
  
          $.ajax({
              url: '{{ route('inquerysp') }}', // Laravel route for form submission
              type: 'POST',
              data: formData,
              success: function(response) {
                $('#statusShowModal .modal-body').css("background", "#56AE57");
                $('#statusShowModal .icon').html('<i class="fa-solid fa-face-smile"></i>');
                $('#statusShowModal .title').html('Thank you for your inquiry!');
                $('#statusShowModal .message').html(response.message);
                $('#statusShowModal').fadeIn();
                $('body').css("overflow","hidden");
                $('#inquiryModalForm')[0].reset();
                if (typeof grecaptcha !== "undefined") {
                    grecaptcha.reset();
                }
              },
              error: function(xhr) {                
                $('#statusShowModal .modal-body').css("background", "#D19191"); // Red background for error
                $('#statusShowModal .icon').html('<i class="fa-solid fa-face-frown"></i>');
                $('#statusShowModal .title').html('Oops! Something went wrong.');
                $('#statusShowModal .message').html(xhr.responseJSON.message);
                $('#statusShowModal').fadeIn();
                $('body').css("overflow","hidden");
              }
          });
      });

      $('#myModal-um .close').on('click', function() {
          $('#myModal-um').fadeOut();
          $('body').css("overflow","auto");
      });

      $('.openCustomProduct').on('click',function(e){
        let dataUrl = $(this).data('url'); // Get the data-slug attribute
        $.ajax({
              url: dataUrl, // Laravel route for form submission
              type: 'GET',
              success: function(response) {
                let form_html = '';
                response.filters.forEach(element => {
                  form_html = form_html+`<div class="cont-row-p"><div class="row-lable-p" for="${element.slug}">${element.title}</div><div class="row-text-p"><select id="${element.slug}" name="${element.slug}"><option value="">-Select-</option>`;
                  element.filters.forEach(el => {
                    form_html = form_html+`<option value="${el.slug}">${el.title}</option>`;
                  });
                  form_html = form_html+`</select></div></div>`;
                });
                $('#myModal-um .add-umModal-form-data').html(form_html);
                $('#myModal-um .custmizeProduct').attr('data-url',dataUrl);
                $('#myModal-um').fadeIn();
                $('body').css("overflow","hidden");
              },
              error: function(xhr) {           
                console.log(xhr);
              }
          });
      });

      $('.custmizeProduct').on('click',function(e){
        let dataUrl = $(this).data('url'); // Get the data-slug attribute
        var formData = $('#myModal-um form').serialize();
        $.ajax({
              url: dataUrl+`?`+formData, // Laravel route for form submission
              type: 'GET',
              success: function(response) {
                let form_html = '';
                if (response.products && response.products.length) {
                  response.products.forEach(element => {
                    form_html = form_html+ `<div class="swiper-slide" style="border-radius: 30px;">
                        <div class="cust-now-pro-de">
                          <div>
                            <img src="{{ asset('images/product/${element.image}') }}" alt="${element.title}">
                          </div>
                          <div class="slider-button-sec-1">
                            <button type="button" class="btn button-sty" data-bs-toggle="modal" data-bs-target="#myModal-1">
                              <img src="{{ asset('images/img/quote.png') }}" alt="job image" title="job image" /> Get
                              Quotation</button>
                          </div>
                          <div class="caption-1">
                            <h3 class="name" style="margin-top:10px;">${element.title}</h3>
                            <div class="star-sty">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star-half-full"></i>
                            </div>
                            <p class="price">₹${element.price_range}</p>`;
                    let fields =  JSON.parse(element.field1);
                    fields.name.forEach((f,i) => {
                      form_html = form_html+`<div class="table-d"><span>${f}</span><p>${fields.value[i]}</p></div>`;
                    });
                    form_html = form_html+`</div></div></div>`;
                  });
                  $('#myModal-um .umModal-products-list .swiper-wrapper').html(form_html);
                  $('#myModal-um .get-touch-content').css("display","none");
                  $('#myModal-um .umModal-products-list').css("display","block");
                } else {
                  $('#myModal-um .umModal-products-list .swiper-wrapper').html(form_html);
                  $('#myModal-um .get-touch-content').css("display","flex");
                  $('#myModal-um .umModal-products-list').css("display","none");
                }
                $('body').css("overflow","hidden");
              },
              error: function(xhr) {           
                console.log(xhr);
              }
          });
      });
      
      $('#myModal-um .clearbtn').on('click', function() {
          $('#myModal-um .umModal-products-list .swiper-wrapper').html('');
          $('#myModal-um .get-touch-content').css("display","flex");
          $('#myModal-um .umModal-products-list').css("display","none");
          $('#myModal-um form')[0].reset();
      });
  });
</script>

<script>
  var acc = document.getElementsByClassName("accordion");
  var i;
  
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      } 
    });
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    freeMode: true,
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
  
      mousewheel: true,
      keyboard: true,

      breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 20
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 1,
      spaceBetween: 30
    },
    // when window width is >= 640px
    768: {
      slidesPerView: 3,
      spaceBetween: 40
    }
  }
    
  });

</script>

<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  document.addEventListener("DOMContentLoaded", function() {
    closeNav();
});
  
</script>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script src="https://www.google.com/recaptcha/api.js?render=6Lfg_ugqAAAAAL3f55MwuMjAsnqeke4H16urHdV-"></script>
<script>
  grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('6Lfg_ugqAAAAAL3f55MwuMjAsnqeke4H16urHdV-', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>