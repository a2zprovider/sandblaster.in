@extends('frontend.layout.master')
@section('title', $setting->p_seo_title)
@section('keyword', $setting->p_seo_keywords)
@section('description', $setting->p_seo_description)



@section('content')

<div class="about-breadcrumb-bg">
    <div class="container">
       <div class="row about-sty">
             <div class="col-sm-6"> <about> Products </about></div>
            
             <div class="col-sm-6 float-st"> <a href="{{route('home')}}"><i class="fas fa-home"></i> </a><ab> <i class="fa fa-angle-double-right"></i> Products <ab> </div>
       </div>
    </div>
   </div>
</div>

<div>

   <div class="container">
      <div class="row pb-t-50">

         <div class="col-lg-3 col-md-4">
            <div class="sticky">
            <div class="chksection">
               <div class="chk-row-sty">
                     <div class="chkimg"><img src="{{ asset('images/img/category.png')}}" alt="job image" title="job image"></div>
                     <div class="chkheading"><p>Categories</p></div>
               </div>
            <form action="">
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Sand Blasting Machine </label>
               </div> 
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Grit Blasting Machine</label> 
               </div>  
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Shot Blasting Machine</label> 
               </div>
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Abrasive Media</label> 
               </div>
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Thermal Spray Gun</label> 
               </div>
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Safety Equipments</label> 
               </div>

               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Metalizing Gun</label> 
               </div>
             </form>
         
           </div> 

           <div class="chksection m-t-20">
            <div class="chk-row-sty">
               <div class="chkimg"><img src="{{ asset('images/img/power.png')}}" alt="job image" title="job image"></div>
               <div class="chkheading"><p>Power</p></div>
            </div>
            <form action="">
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">2 HP</label>
               </div> 
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">3 HP</label> 
               </div>  
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">5 HP</label> 
               </div>
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">7 HP</label> 
               </div>
             </form>
           </div>
           
           <div class="chksection m-t-20">
            <div class="chk-row-sty">
               <div class="chkimg"> <img src="{{ asset('images/img/capacity.png')}}" alt="job image" title="job image"></div>
               <div class="chkheading"><p>Capacity</p></div>
            </div>
            <form action="">
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">100 Kg</label>
               </div> 
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">300 Kg</label> 
               </div>  
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">500 Kg</label> 
               </div>
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">1000 Kg</label> 
               </div>
             </form>
           </div> 

           <div class="chksection m-t-20">
            <div class="chk-row-sty">
               <div class="chkimg"> <img src="{{ asset('images/img/automation-grade.png')}}" alt="job image" title="job image"></div>
               <div class="chkheading"><p>Automation Grade</p></div>
            </div>

            <form action="">
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Manual</label>
               </div> 
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Semi Automatic</label> 
               </div>  
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Fully Automatic </label> 
               </div>
             </form>
           </div> 

           <div class="chksection m-t-20">
            <div class="chk-row-sty">
               <div class="chkimg"> <img src="{{ asset('images/img/applications.png')}}" alt="job image" title="job image"></div>
               <div class="chkheading"><p>Applications</p></div>
            </div>
            <form action="">
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Rust Removal</label>
               </div> 
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Paint Removal</label> 
               </div>  
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Surface Cleaning</label> 
               </div>
               <div class="chk-row-sty">
                  <input type="checkbox" id="myCheck" onclick="myFunction()">
                  <label for="myCheck">Surface Finishing</label> 
               </div>
             </form>
           </div> 
         </div>
         </div>

         <div class="col-lg-9 col-md-8">
            <div class="container">
               <div class="row">
                  <div class="btn-row pro-btn">
                     <button class="btn-1"> Clear All</button>
                     <button class="btn-2" id="text" style="display:none">Sand Blasting Machine &nbsp; <i class="fa-solid fa-x"></i></button>
                     <button class="btn-2" id="text" style="display:none">Grit Blasting Machine <i class="fa-solid fa-x"></i></button>
                  </div>
               </div> 
            </div> 
            
            <div class="container">
            
               @if(!$lists->isEmpty())
               @foreach ($lists as $list)
               <div class="row p-card">
                
              <div class="col-lg-5">
                  <div class="pro-img-sty">
                     <img src="{{ $list->thumb_image ? url('images/product/' . $list->thumb_image) : url('images/product/' . $list->image) }}" alt="{{ $list->title }}"> 
                  </div> 
                  <div class="slider-button-sec-1 cp-st mts-20">
                     
                     {{-- <button type="button" class="btn button-sty" data-bs-toggle="modal" data-bs-target="#myModal">
                        <img src="{{ asset('images/img/quote.png') }}"  alt="job image" title="job image"/> Get Quotation</button>  --}}
                        <button type="button" class="custom-btn btn-3 get-but" data-bs-toggle="modal" data-bs-target="#myModal-1">
                           <span><img src="{{ asset('images/img/quote.png') }}"  alt="job image" title="job image" style="width: 30px"/> Get Quotation </span></button>          
                  </div>
                
               </div>
               <div class="col-lg-7">
                  <div class="caption-1">
                     <h3 class="name">{{$list->title}}</h3>
                     <div class="star-sty">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star-half-full"></i>
                     </div>
                     <p class="price">{{ $list->price_range }}</p>
                     
                  </div> 
                     @foreach(json_decode($list->field)->name as $key => $field)
                     @if($key<6)
                     <div class="table-d">
                           <span>{{ $field }}</span>
                           <p>{{ json_decode($list->field)->value[$key] }}</p>       
                     </div>    
                     
                     @endif
                     @endforeach
                     
                  <div class="table-r">
                     <div class="read-more"> <a class="text-clip-1" href="{{ route('page', $list->slug)}}"> Read More... </a></div>   
                  </div>
               
               </div> 
               
            </div>
               @endforeach
               @else
               <div class="row"> No Record Found</div>
               @endif
            </div>
         </div>
         </div>
      

      <div class="row text-center pt-80">

         <div class="col-lg-12 no-padding">
            <div class="blog-pagination">
               @if(method_exists($lists, 'links'))
               @include('frontend.templete.pagination', ['paginator' => $lists], ['query'])
               @endif
            </div>
         </div>
      </div>
   </div>
@endsection

<script>
   function myFunction() {
      const currentUrl = window.location.href; 
     var checkBox = document.getElementById("myCheck");
     var text = document.getElementById("text");
   }
   </script>