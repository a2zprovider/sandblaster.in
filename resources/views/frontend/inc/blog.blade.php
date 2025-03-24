@extends('frontend.layout.master')
@section('title', $setting->b_seo_title)
@section('keyword', $setting->b_seo_keywords)
@section('description', $setting->b_seo_description)
@section('content')
@section('style')

@endsection


@php

//dd($blogs);
//$tag=explode(',', $blogs->tags);

@endphp

<div class="about-breadcrumb-bg">
   <div class="container">
      <div class="row about-sty">
         <div class="col-sm-6 col-md-6">
            <about> Blogs </about>
         </div>

         <div class="col-sm-6 float-st"> <a href="{{ route('home') }}"><i class="fas fa-home"></i> </a>
            <ab> <i class="fa fa-angle-double-right"></i> Blogs <ab>
         </div>
      </div>
   </div>
</div>
</div>

<div class="container">
   <div class="row pb-t-50">
      <div class="col-lg-3">
         <div class="sticky">
            <div class="chksection">
               <div class="chk-row-sty">
                  <div class="chkimg"><img src="{{ asset('images/img/category.png')}}" alt="job image"
                        title="job image"></div>
                  <div class="chkheading">
                     <p>Categories</p>
                  </div>
                  <ul>
                     @foreach($blogcategory as $blogcat)
                     <li>
                        <a class="text-clip" href="{{ route('blog.category', $blogcat->slug) }}">{{$blogcat->title}}</a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
            <div class="chksection m-t-20">
               <div class="chk-row-sty">
                  <div class="chkimg"><i class="far fa-newspaper"></i></div>
                  <div class="chkheading">
                     <p>Recent Blogs</p>
                  </div>
                  <ul>
                     @foreach($blogsidebar as $blogsb)
                     <li>
                        <a class="text-clip two-line-ellipsis"
                           href="{{ route('blog.detail', $blogsb->slug) }}">{{$blogsb->title}}</a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
            <div class="chksection m-t-20">
               <div class="chk-row-sty">
                  <div class="chkimg"><i class="fa-solid fa-tags"></i></div>
                  <div class="chkheading">
                     <p>Latest Tags</p>
                  </div>
               </div>
               <div class="chk-row-sty">
                  <ul>
                     @foreach($tagb as $tag)
                     <li><a class="text-clip" href="{{ route('blog.tag', $tag->slug) }}">{{$tag->title}}</a></li>
                     @endforeach
                  </ul>
               </div>
            </div>
            <div class="chksection m-t-20">
               <div class="chk-row-sty">
                  <div class="chkimg"><i class="fa-solid fa-calendar"></i></div>
                  <div class="chkheading">
                     <p>Published Year</p>
                  </div>
                  <ul>
                     @foreach($blogs->unique(fn($blog) => $blog->created_at->format('Y')) as $blog)
                     <li>
                        <a class="text-clip" href="{{ route('blog.year', $blog->created_at->format('Y')) }}">
                           {{ $blog->created_at->format('Y') }}
                        </a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-9">
         <div class="container">
            @if(!$blogs->isEmpty())
            @foreach($blogs as $blog)
            <div class="blog-card mr-top-20">
               <div class="row">
                  <div class="col-lg-5">
                     <div class="bc-img">
                        <a href="blogdetails"><img
                              src="{{ $blog->thumb_image ? url('images/blog/' . $blog->thumb_image) : url('images/blog/' . $blog->image) }}"
                              alt="{{ $blog->title }}"></a>
                     </div>
                  </div>
                  <div class="col-lg-7">
                     <div class="cat-date-row">
                        <a href="{{ route('blog.detail', $blog->slug) }}">
                           <h2>{{ $blog->title }}</h2>
                        </a>
                        <div class="cat-row">

                           <span> <i class="fa fa-th"></i> Category:
                              {{$blog->blogcategory?$blog->blogcategory->title:''}} </span>
                        </div>
                        <div class="date-row">

                           <span> <i class="fa fa-calendar"></i> Published On: {{ date_format($blog->created_at, 'F d,
                              Y') }}</span>
                        </div>

                        <p>{{ Str::limit(strip_tags($blog->short_description), 150) }}</p>



                     </div>
                  </div>
               </div>
            </div>

            @endforeach
            @else
            <div class="row">No Record Found !</div>
            @endif


         </div>
      </div>
   </div>
   {{-- <div class="row text-center pt-80">

      <div class="col-lg-12 no-padding">
         <div class="blog-pagination">
            @if(method_exists($blogs, 'links'))
            @include('frontend.templete.pagination', ['paginator' => $blogs], ['query'])
            @endif
         </div>
      </div>
   </div> --}}
</div>


@endsection