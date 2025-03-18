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
        <!-- Modal Header -->

        <!-- Modal body -->
        <div class="modal-body">
          <div class="get-in-tough">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                       <div class="get-touch-content">
                        <touch>Get in Touch <br> with Us</touch>
                        <p>We’re here to assist you! Reach out for any inquiries, requirements, or bulk order, and we’ll get back to you as soon as possible.</p>
                       </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="get-touch-contact-m from-pad-2">
                            
                            <div class="but-sty-pro-1">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            
                            {{ Form::open(['url' => route('inquery'), 'method'=>'POST', 'files' => true,  'class'=>'']) }}
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
                             
                              <input id="seller_phone1" class="sty-in" name="mobile" placeholder="Your Mobile number"  required=""></input>
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
                              <div class="g-recaptcha" data-sitekey="6Lfg_ugqAAAAAL3f55MwuMjAsnqeke4H16urHdV-" data-callback="recaptchaCallback"></div>
                             
                              {{-- 6Lfg_ugqAAAAAHz9_CgjaWdA8Fr6y7uuVwFAwgeS   --}}
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





  <div class="modal" id="myModal-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->

        <!-- Modal body -->
        <div class="modal-body">
          <div class="get-in-tough">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                       <div class="get-touch-content">
                        <touch>Get in Touch <br> with Us</touch>
                        <p>We’re here to assist you! Reach out for any inquiries, requirements, or bulk order, and we’ll get back to you as soon as possible.</p>
                       </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="get-touch-contact-m from-pad-2">
                            
                            <div class="but-sty-pro-1">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            
                            {{ Form::open(['url' => route('inquery'), 'method'=>'POST', 'files' => true,  'class'=>'']) }}
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
                             
                              <input id="seller_phone1" class="sty-in" name="mobile" placeholder="Your Mobile number"  required=""></input>
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
                              <div class="g-recaptcha" data-sitekey="6Lfg_ugqAAAAAL3f55MwuMjAsnqeke4H16urHdV-" data-callback="recaptchaCallback"></div>
                             
                              {{-- 6Lfg_ugqAAAAAHz9_CgjaWdA8Fr6y7uuVwFAwgeS   --}}
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

<!---CUSTMIZE NOW--->
  <!-- The Modal -->
  <div class="modal" id="myModal-um">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->

        <!-- Modal body -->
        <div class="modal-body">
          <div class="get-in-tough">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                       <div class="get-touch-content">
                        <touch> Create Your Custom <br> Machine</touch>
                        <p>Customize every components for a solution that works just for you.</p>
                       </div>
                    </div>
                    <div class="col-lg-6">
                        
                        <div class="get-touch-contact-pro from-pad">
                            
                            <div class="but-sty-pro"><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                        
                            <div class="psty-pro"><p>Get Your Machine Customised As Per Your Requirement</p> </div>
                         <form action="">
                            <div class="cont-row-p">
                                <div class="row-lable-p">Size of Air Compressor </div>
                                <div class="row-text-p">
                                    <select id="" name="" form="">
                                        <option value="">-Select-</option>
                                        <option value="">5 Hp</option>
                                        <option value="">7 Hp</option>
                                        <option value="">10 Hp</option>
                                        <option value="">15 Hp</option>
                                      </select>                        
                                 </div> 
                            </div>
                            <div class="cont-row-p">
                                <div class="row-lable-p">Types of Machine</div>
                                <div class="row-text-p">
                                    <select id="" name="" form="">
                                        <option value="">-Select-</option>
                                        <option value="">Portable Type</option>
                                        <option value="">Cabinet Type</option>
                                        
                                      </select>                        
                                 </div> 
                            </div>
                            <div class="cont-row-p">
                                <div class="row-lable-p">Abrasive used for Machine</div>
                                <div class="row-text-p">
                                    <select id="" name="" form="">
                                        <option value="">-Select-</option>
                                        <option value="">Steel Shot and Steel Grit</option>
                                        <option value="">Others</option>
                                        
                                      </select>                        
                                 </div> 
                            </div>
                            
                            
        
  <div class="submit-sty-1"> 
                                    
              <div>
         {{-- <button type="button" class="nowbtn btn" data-bs-toggle="modal" data-bs-target="#myModal-cn"> Custmized Now </button> --}}

         <button type="button" class="nowbtn custom-btn btn-3 get-but" data-bs-toggle="modal" data-bs-target="#myModal-cn" type="submit" value="Submit">
          <span> <i class="fa fa-send"></i> &nbsp; Custmized Now</span></button> 
                                    
                            
                                        <!-- The Modal -->
        <div class="modal" id="myModal-cn" style="z-index:999;">
            <div class="modal-dialog">
            <div class="modal-content">
            
                     <!-- Modal body -->
                            <div class="modal-body">
                            <div class="get-in-tough">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="cust-now-pro-de">
                                            <div>
                                                <img src="{{ asset('images/img/test-card.png') }}" alt="card" > 
                                            </div>
                            
                                            <div class="slider-button-sec-1">
                                                {{-- <img src="{{ asset('images/img/quote.png')}}" alt="job image" title="job image">
                                                <button class="btn button-sty" type="submit"> Get Quotation</button>
                                                --}}
                                                 <button type="button" class="btn button-sty" data-bs-toggle="modal" data-bs-target="#myModal">
                                                    <img src="{{ asset('images/img/quote.png') }}"  alt="job image" title="job image"/> Get Quotation</button> 
                                                    
                            
                            
                                                <div class="caption-1">
                                                    <h3 class="name">Portable Sand Blasting Machine</h3>
                                                    <div class="star-sty">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-full"></i>
                                                    </div>
                                                    <p class="price">₹40K-10Lakhs</p>
                                                    
                                                    
                                                    <div class="table-d">
                                                            <span>Power</span>
                                                            <p>3HP</p>    
                                                    </div>
                                                    <div class="table-d">
                                                        <span>Capacity</span>
                                                        <p>200 Kg</p>    
                                                    </div>
                                                    <div class="table-d">
                                                    <span>Max. Pressure</span>
                                                    <p>10000 PSI</p>    
                                                    </div>
                                                    <div class="table-d">
                                                    <span>Material</span>
                                                    <p>Mild Steel</p>    
                                                    </div>
                                                    <div class="table-d">
                                                    <span>Automation Grade</span>
                                                    <p>Semi Automatic</p>    
                                                    </div>
                                
                                                    <div class="table-d">
                                                    <span>Application</span>
                                                    <p>Surface Finishing, Rust Removal</p>    
                                                    </div>
                                                </div> 
                            
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            
                                            <div class="get-touch-contact-pro from-pad">
                                                
                                                <div class="but-sty-pro"><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                            
                                                <div class="psty-pro"><p>Get Your Machine Customised As Per Your Requirement</p> </div>
                                                <form action="">
                                                <div class="cont-row-p">
                                                    <div class="row-lable-p">Size of Air Compressor </div>
                                                    <div class="row-text-p">
                                                        <select id="" name="" form="">
                                                            <option value="">-Select-</option>
                                                            <option value="">5 Hp</option>
                                                            <option value="">7 Hp</option>
                                                            <option value="">10 Hp</option>
                                                            <option value="">15 Hp</option>
                                                            </select>                        
                                                        </div> 
                                                </div>
                                                <div class="cont-row-p">
                                                    <div class="row-lable-p">Types of Machine</div>
                                                    <div class="row-text-p">
                                                        <select id="" name="" form="">
                                                            <option value="">-Select-</option>
                                                            <option value="">Portable Type</option>
                                                            <option value="">Cabinet Type</option>
                                                            
                                                            </select>                        
                                                        </div> 
                                                </div>
                                                <div class="cont-row-p">
                                                    <div class="row-lable-p">Abrasive used for Machine</div>
                                                    <div class="row-text-p">
                                                        <select id="" name="" form="">
                                                            <option value="">-Select-</option>
                                                            <option value="">Steel Shot and Steel Grit</option>
                                                            <option value="">Others</option>
                                                            
                                                            </select>                        
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
                    
                    
                </div>
                <div>
                <button class="clearbtn">Clear All</button>
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
  <!----cumtize now modal--->

<script>
    // Get the modal
    var modal = document.getElementById("myModal");
    
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal-um");
    
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
}
    
    </script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal-cn");
    
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
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






  








         
    


    
     