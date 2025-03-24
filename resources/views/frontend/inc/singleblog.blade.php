@extends('frontend.layout.master')

@section('title', $post->seo_title)
@section('keyword', $post->seo_keywords)
@section('description', $post->seo_description)

@section('content')
@section('schema')
<script type="application/ld+json">
   {
		"@context": "https://schema.org",
		"@type": "BlogPosting",
		"mainEntityOfPage": {
			"@type": "WebPage",
			"@id": "{{ url()->current() }}"
		},
		"headline": "{{ $post->title }}",
		"description": "{{ $post->seo_description }}",
		"image": "{{ url('images/blog/'.$post->image) }}",
		"author": {
			"@type": "Organization",
			"name": "Sand Blaster",
			"url": "<?php echo url('/'); ?>"
		},
		"publisher": {
			"@type": "Organization",
			"name": "Sand Blaster",
			"logo": {
				"@type": "ImageObject",
				"url": "{{ url('images/setting/logo',$setting->logo) }}"
			}
		},
		"datePublished": ""
	}
</script>
@stop

<div class="about-breadcrumb-bg">
   <div class="container">
      <div class="row about-sty">
         <div class="col-lg-6 col-md-12">
            <about> {{$post->title}} </about>
         </div>
         <div class="col-lg-6 col-md-12 float-st-1"> <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
            <ab> <i class="fa fa-angle-double-right"></i></ab> <a href="{{ route('blog')}}">Blogs</a>
            <ab><i class="fa fa-angle-double-right"></i> {{$post->title}} </ab>
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
                     <li><a class="text-clip two-line-ellipsis"
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
      <div class="col-lg-9 mr-top-20-s">
         <div class="container">
            <div class="blog-card">
               <div class="">
                  <img src="{{ url('images/blog', $post->image) }}" style="width: 100%;" alt="{{$post->title}}">
               </div>
            </div>
            <div class="blog-content-sty">
               <h1 style="font-size:22px; font-weight: 600; line-height: 30px; color:#454545; letter-spacing: 1.5px;">{{$post->title}}</h1>
               <div class="cat-row">
                  <span>
                     <i class="fa fa-th"></i> Category: {{$post->blogcategory?$post->blogcategory->title:''}}
                  </span>
               </div>
               <div class="date-row">
                  <span>
                     <i class="fa-solid fa-calendar"></i> Published On: {{ $post->created_at->format('j F
                     Y');}}
                  </span>
               </div>
            </div>
            <div class="content-details">
               {!! $post->description !!}
            </div>
         </div>
      </div>
   </div>
</div>


@endsection