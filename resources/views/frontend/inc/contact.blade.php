@php
$setting = App\Models\Setting::first();
// dd($inquery);
@endphp
@extends('frontend.layout.master')
@section('title', $setting->c_seo_title)
@section('keyword', $setting->c_seo_keywords)
@section('description', $setting->c_seo_description)

@section('content')


<div class="about-breadcrumb-bg">
<div class="container">
    <div class="row about-sty">
    <div class="col-sm-6"> <about> Contact Us </about></div>
    
    <div class="col-sm-6 float-st"> <a href="{{route('home')}}"><i class="fas fa-home"></i> </a> <ab> <i class="fa fa-angle-double-right"></i> Contact Us <ab> </div>
    </div>
</div>
</div>
</div>
<!--get touch with us ---->
<div class="con-get-touch"> 
<div class="container">
    <div class="row">
      
        <div class="col-lg-6">
            <div class="get-touch-content-f">
              <div id="form-messages"></div>
               {{-- <form action=""> --}}
              {{ Form::open(['url' => route('inquery'), 'method'=>'POST', 'files' => true, 'id'=>'myForm', 'class'=>'']) }}
					    {{ csrf_field() }}
               
                @if($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                  {{$message}}
                </div> 
                
                @endif
                @if($message = Session::get('success'))
                
                
              
                @endif
                @if(count($errors->all()))
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                  {{$error}}
                </div>
                @endforeach
                @endif 

              <fieldset>
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
                  {{-- <button class="custom-btn btn-3 get-but submit btn-default" type="submit" data-bs-toggle="modal"  data-bs-target="#myModalpop" value="Submit"> --}}
                    <button class="custom-btn btn-3 get-but submit btn-default"  id="submitBtn" type="submit" data-bs-toggle="modal" data-bs-target="#myModalpop">
                  
                    <span> <i class="fa fa-send"></i> &nbsp;Submit</span></button>  
                  </div>
                </div>
              </fieldset>
              </form>


              
            </div>
        </div>
        <div class="col-lg-6">
            <div class="get-touch-content-c">
             <touch>Get in Touch <br> with Us</touch>
             <p class="cont-cet-st">We’re here to assist you! Reach out for any inquiries, requirements, or bulk order, and we’ll get back to you as soon as possible.</p>
            
             <div class="footer-col-sty">
                <ul>
                    <div class="f-contact-d">
                      <i class="fa fa-mobile"></i>
                        <li><a href="tel:{{$setting->mobile}}">{{$setting->mobile}}</li>
                    </div>
                    <div class="f-contact-d">
                      <i class="fa fa-envelope"></i>
                        <li><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                    </div>
                    <div class="f-contact-d"> 
                      <i class="fa fa-map-marker"></i>
                        <li> {{$setting->address}}</li>
                    </div>
                           
                 </ul>
            </div>
            </div>

         </div>
    </div>
    </div>
</div>

<!--get touch with us end---->
<!--- unmatched-contact--> 

<div id="cont-sty">
<div class="types-of-machine mb-50">
    <div class="container">
       <div class="row">
          <div class="">
             <p class="psty-1">Unmatched Performance: The Industry’s Leading Sandblasting Machine</p>
             <p class="psty-2">Engineered for Efficiency, Durability, and Precision – Setting the Standard in Sandblasting Technology</p>
          </div>
          
       </div>
       <div class="row">
           <div class="main-b-r">
             <div class="row-b-1"></div>
             <div class="row-b-2"></div>
            </div> 
       </div>
 
       <div class="row types-content pb-t-50">
         <div class="col-lg-6">
             <div class="types-content-sty pb-t-50">
                <h4>Leading Sand Blasting <span>Machine Manufacturer</span></h4>
                <p>Our sand blasting machine stands at the forefront of innovation, combining advanced engineering with powerful performance to offer the best solution for all your surface preparation needs. Designed with both precision and durability in mind, it sets the industry standard for quality and efficiency. From cleaning to finishing, this machine is engineered to handle any task, no matter how tough, and ensures that you consistently achieve top-notch results. The heart of its superiority lies in its high-efficiency abrasive delivery system, which ensures optimal performance with minimal waste. Unlike many machines on the market, our system is designed to provide fast, consistent results while keeping operational costs low. <p>
                <p>Whether you're working on large-scale industrial projects or small, intricate tasks, our sandblasting machine delivers the perfect balance of power and control, allowing you to complete your work faster and with greater precision.    </p>         

                </div>
         </div>
         <div class="col-lg-6">
             <img src="{{asset('images/img/contact-image.png')}}" class="types-content-1" alt="suction blasting cabinet">
         </div>
       </div>
 
       <div class="row types-content pb-t-50">
         <div class="col-lg-6">
             <img src="{{asset('images/img/contact-image-2.png')}}" class="types-content-1" alt="suction blasting cabinet">
         </div>
         <div class="col-lg-6">
             <div class="types-content-sty pb-t-50">
                <h4>Key Features <span>and Benefits</span></h4>
                <p>Our sandblasting machine offers unmatched performance, exceptional reliability, and superior results. Whether you're cleaning, prepping, or finishing, this industry-leading machine ensures that you get the job done efficiently, safely, and with the highest level of precision.</p>
                <ul>
                    <li><i class="fa fa-paper-plane"></i> Built with high-quality materials and precision engineering, our sandblasting machine is designed to withstand even the harshest working conditions.</li>
                    <li><i class="fa fa-paper-plane"></i> machine features a powerful abrasive delivery system, enabling faster cleaning and surface preparation, reducing operational time.</li>
                    <li><i class="fa fa-paper-plane"></i> With adjustable pressure settings and customizable blast patterns, our sandblasting machine provides consistent results across various surfaces.</li>
                    <li><i class="fa fa-paper-plane"></i> Easy-to-use interface with intuitive controls allows operators of all skill levels to achieve optimal results with minimal training.</li>
                </ul>
            </div>
         </div>
 
       </div>
 
       <div class="row types-content pb-t-50">
         <div class="col-lg-6">
             <div class="types-content-sty pb-t-50">
                <h4> Best Sand Blasting Machine <span>in Industry</span></h4>
                <p>Our sandblasting machine is more than just a tool—it's an investment in long-term efficiency, precision, and quality. Whether you're looking to increase productivity or achieve the highest standards of surface preparation, we are committed to providing the most advanced solutions for your sandblasting needs. </p> 
                <p>Safety is a top priority with our sand blasting machine. It is equipped with advanced safety features like automatic shut-off valves, reinforced components, and a comprehensive dust collection system to keep your work environment clean and safe. These built-in safety measures not only protect your team but also ensure compliance with industry regulations, making it a smart investment for long-term operations.</p>
            
            </div>
         </div>
         <div class="col-lg-6">
             <img src="{{asset('images/img/contact-image-1.png')}}" class="types-content-1" alt="suction blasting cabinet">
         </div>
       </div>
    </div>
 </div>
</div>
<!--- unmatched-contact--> 


<div class="modal submit-modal" id="myModalpop-1" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div> --}}
      <div class="modal-body">
        <i class="fa-solid fa-face-smile"></i>
        <p>Thank you for your inquiry!</p>
        <p>You will receive our catalog with latest price soon.</p>
        

        {{-- <button type="button" class="custom-btn btn-3 btn btn-default" data-bs-dismiss="modal">Continue</button> --}}
       <div class="su-st-bu">
        <button type="button" class="custom-btn btn-3 get-but" data-bs-dismiss="modal">
          <span> Continue</span></button> 
        </div>
        </div>
     
      </div>
      
    </div>
  </div>

  <div class="modal submit-modal-e" id="myModalpop" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div> --}}
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="model-cont-sty">
                    <i class="fa-solid fa-face-sad-tear"></i>
                    <p>Thank you for your inquiry!</p>
                    <p>You will receive our catalog with latest price soon.</p>
                    
                </div> 
                    {{-- <button type="button" class="custom-btn btn-3 btn btn-default" data-bs-dismiss="modal">Continue</button> --}}
                  <div class="su-st-bu">
                    <button type="button" class="custom-btn btn-3 get-but" data-bs-dismiss="modal">
                      <span> Continue</span></button> 
                    </div>
              </div>
            </div>
          </div>
       
        </div>
        
      </div>
    </div>
  </div>



@endsection
