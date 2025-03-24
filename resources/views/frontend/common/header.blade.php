@php
$setting = App\Models\Setting::first();
$products = App\Models\Page::where('type','page')->get();
$blogs = App\Models\Post::where('type','post')->get();
$apps = App\Models\Application::get();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keyword')">
    <meta name="author" content="Sumer Choudhary">
    <meta name="copyright" content="{{ $setting->title }}" />
    @stack('styles')
    <meta property="og:type" content="website" />
    <meta property='og:locale' content='en_US' />
    <meta property="og:site_name" content="{{ $setting->title }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="{{ url('images/setting/logo',$setting->logo) }}" />
    <link rel="canonical" href="{{url()->current()}}" />

    <meta name="twitter:card" content="{{ $setting->title }}" />
    <meta name="twitter:site" content="{{ $setting->title }}" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta name="twitter:image" content="{{ url('images/setting/logo',$setting->logo) }}" />
    <meta name="twitter:creator" content="Sumer Choudhary">
    <meta name="msvalidate.01" content="DF3659272215666028CFB769FC81AFF8" />
    <link rel="icon" href="{{ url('images/setting',$setting->favicon) }}" sizes="32x32">
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/fontawesome.min.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    {!! $setting->analytics !!}
    {!! $setting->tag_manager !!}
    {!! $setting->console_script !!}
    @yield('schema')

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T88ZKBC" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="head-back-img">
        <div class="sticky-header">
            <div class="container">
                <div class="row py-3 align-items-center">
                    <div class="col-lg-9">
                        <nav class="navbar navbar-expand-lg navbar-dark nav-sty">
                            <a class="navbar-brand head-logo pb-0" href="{{ route('home') }}">
                                <img src="{{ url('images/setting', $setting->logo) }}" alt="{{$setting->title}}"
                                    title="{{$setting->title}}">
                            </a>
                            <button class="toggler-btn-sty">
                                <span class="toggler-button" onclick="openNav()">&#9776;</span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav" id="mydiv">
                                    <li class="nav-item">
                                        <span class="text-clip"><a
                                                class="nav-link {{request()->is('/') ? 'active' : ''}}"
                                                href="{{ route('home') }}">Home</a></span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="text-clip">
                                            <a class="nav-link {{request()->is('about') ? 'active' : ''}}"
                                                href="{{ route('about')}}">About Us</a>
                                        </span>
                                    </li>

                                    <li class="nav-item">
                                        <span class="text-clip">
                                            <a class="nav-link {{request()->is('products') ? 'active' : ''}}"
                                                href="{{route('page.list')}}">Products</a>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="text-clip">
                                            <a class="nav-link {{request()->is('blogs') ? 'active' : ''}}"
                                                href="{{ route('blog')}}">Blogs</a>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="text-clip">
                                            <a class="nav-link {{request()->is('contact') ? 'active' : ''}}"
                                                href="{{ route('contact')}}">Contact Us</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <form class="d-flex search-sty" action="{{ route('page.list') }}" method="GET">
                            <input class="form-control me-i" name="s" type="text" placeholder="Search"
                                value="{{ request('s') }}">
                            <button class="btn btn-outline-ligh button1 d-flex align-items-center justify-content-center" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!----mobile menu ----->
        <div id="mySidenav" class="sidenav">
            <button href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                <i class="fa-solid fa-x"></i>
            </button>
            <a href="{{ route('home') }}">
                <span class="{{request()->is('/') ? 'active' : ''}}">Home</span>
            </a>
            <a href="{{ route('about')}}">
                <span class="{{request()->is('about') ? 'active' : ''}}">About Us<span>
            </a>
            <a href="{{route('page.list')}}">
                <span class="{{request()->is('product') ? 'active' : ''}}">Products</span>
            </a>
            <a href="{{ route('blog')}}">
                <span class="{{request()->is('blog') ? 'active' : ''}}">Blogs</span>
            </a>
            <a href="{{ route('contact')}}">
                <span class="{{request()->is('contact') ? 'active' : ''}}">Contact Us</span>
            </a>
        </div>
        <!--- mobile mnu ---->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            $(function() {
                $(window).on("scroll", function() {
                    if($(window).scrollTop() > 50) {
                        $(".sticky-header").addClass("stickyback");
                    } else {
                        $(".sticky-header").removeClass("stickyback");
                    }
                });
            });
        </script>