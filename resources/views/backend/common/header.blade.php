@php
$setting = App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed layout-navbar-fixed">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title> @yield('title') | {{ $setting->title ? $setting->title : 'Admin' }}</title>
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Canonical SEO -->
    <link rel="canonical" href="{{ url()->current() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="" /> <!-- Include Styles -->
    <!-- BEGIN: Theme CSS-->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('admin/vendor/fonts/boxiconse04f.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendor/fonts/fontawesomeb34a.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendor/fonts/flag-iconsc977.css') }}" /> <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('admin/vendor/css/rtl/core29d0.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendor/css/rtl/theme-defaultde12.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/css/demo6e6a.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendor/libs/perfect-scrollbar/perfect-scrollbarb440.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendor/libs/typeahead-js/typeahead3881.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <!-- Vendor Styles -->

    @yield('style')
    <style>
        .tox-notification {
            display: none !important;
        }

        .header-sticky {
            position: sticky;
            background: #fff;
            top: 78px;
            z-index: 9;
        }

        a {
            cursor: pointer;
        }

        .alert ul {
            margin-bottom: 0;
        }

        body.tox-fullscreen .layout-menu {
            z-index: 0 !important;
        }

        body.tox-fullscreen .header-sticky {
            z-index: 0 !important;
        }

        body.tox-fullscreen .layout-navbar {
            z-index: 0 !important;
        }
    </style>

    <!-- Page Styles -->
    <!-- Include Scripts for customizer, helper, analytics, config -->
    <!-- laravel style -->
    <script src="{{ url('admin/vendor/js/helpers.js') }}"></script>
    <!-- beautify ignore:start -->
  <script src="{{ url('admin/vendor/js/template-customizer.js') }}"></script>  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ url('admin/js/config.js') }}"></script>
</head>
<body>
    <!-- Layout Content -->
    <div class="layout-wrapper layout-content-navbar ">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <!-- ! Hide app brand if navbar-full -->
                <div class="app-brand demo">
                    <a href="{{ route('admin.home') }}" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bold ms-2" style="text-transform: capitalize;">admin Panel</span>
                    </a>                    
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item @if(Request::routeIs('admin.home')) active @endif">
                        <a href="{{ route('admin.home') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Main Components</span>
                    </li>    
                    <li class="menu-item @if(Request::routeIs('admin.inquiry.index')) active @endif">
                        <a href="{{ route('admin.inquiry.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Inquiry</div>
                        </a>
                    </li>  
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Product</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if(Request::routeIs('admin.product.index')) active @endif">
                                <a href="{{ route('admin.product.index') }}" class="menu-link">
                                    <div>View</div>
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.product.create')) active @endif">
                                <a href="{{ route('admin.product.create') }}" class="menu-link">
                                    <div>Add</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <div>Category</div>
                                </a>
                                <ul class="menu-sub">                                    
                                    <li class="menu-item @if(Request::routeIs('admin.category.index')) active @endif">
                                        <a href="{{ route('admin.category.index') }}" class="menu-link">
                                            <div>View</div>
                                        </a>
                                    </li>                                    
                                    <li class="menu-item @if(Request::routeIs('admin.category.create')) active @endif">
                                        <a href="{{ route('admin.category.create') }}" class="menu-link">
                                            <div>Add</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>        
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Blog</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if(Request::routeIs('admin.blog.index')) active @endif">
                                <a href="{{ route('admin.blog.index') }}" class="menu-link">
                                    <div>View</div>
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.blog.create')) active @endif">
                                <a href="{{ route('admin.blog.create') }}" class="menu-link">
                                    <div>Add</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <div>Category</div>
                                </a>
                                <ul class="menu-sub">                                    
                                    <li class="menu-item @if(Request::routeIs('admin.blogcategory.index')) active @endif">
                                        <a href="{{ route('admin.blogcategory.index') }}" class="menu-link">
                                            <div>View</div>
                                        </a>
                                    </li>                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.blogcategory.create')) active @endif">
                                        <a href="{{ route('admin.blogcategory.create') }}" class="menu-link">
                                            <div>Add</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item ">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <div>Tag</div>
                                </a>
                                <ul class="menu-sub">                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.tag.index')) active @endif">
                                        <a href="{{ route('admin.tag.index') }}" class="menu-link">
                                            <div>View</div>
                                        </a>
                                    </li>                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.tag.create')) active @endif">
                                        <a href="{{ route('admin.tag.create') }}" class="menu-link">
                                            <div>Add</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>     
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Faqs</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if(Request::routeIs('admin.faq.index')) active @endif">
                                <a href="{{ route('admin.faq.index') }}" class="menu-link">
                                    <div>View</div>
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.faq.create')) active @endif">
                                <a href="{{ route('admin.faq.create') }}" class="menu-link">
                                    <div>Add</div>
                                </a>
                            </li>
                        </ul>
                    </li>   
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Application</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if(Request::routeIs('admin.application.index')) active @endif">
                                <a href="{{ route('admin.application.index') }}" class="menu-link">
                                    <div>View</div>
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.application.create')) active @endif">
                                <a href="{{ route('admin.application.create') }}" class="menu-link">
                                    <div>Add</div>
                                </a>
                            </li>
                        </ul>
                    </li>  
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Slider</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if(Request::routeIs('admin.slider.index')) active @endif">
                                <a href="{{ route('admin.slider.index') }}" class="menu-link">
                                    <div>View</div>
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.slider.create')) active @endif">
                                <a href="{{ route('admin.slider.create') }}" class="menu-link">
                                    <div>Add</div>
                                </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="menu-item @if(Request::routeIs('admin.about.edit')) active @endif">
                        <a href="{{ route('admin.about.edit') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>About us</div>
                        </a>
                    </li>     
                    @if(auth()->user()->role == 'admin')
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Location</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item ">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <div>Country</div>
                                </a>
                                <ul class="menu-sub">                                    
                                    <li class="menu-item @if(Request::routeIs('admin.country.index')) active @endif">
                                        <a href="{{ route('admin.country.index') }}" class="menu-link">
                                            <div>View</div>
                                        </a>
                                    </li>                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.country.create')) active @endif">
                                        <a href="{{ route('admin.country.create') }}" class="menu-link">
                                            <div>Add</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item ">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <div>State</div>
                                </a>
                                <ul class="menu-sub">                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.state.index')) active @endif">
                                        <a href="{{ route('admin.state.index') }}" class="menu-link">
                                            <div>View</div>
                                        </a>
                                    </li>                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.state.create')) active @endif">
                                        <a href="{{ route('admin.state.create') }}" class="menu-link">
                                            <div>Add</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item ">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <div>City</div>
                                </a>
                                <ul class="menu-sub">                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.city.index')) active @endif">
                                        <a href="{{ route('admin.city.index') }}" class="menu-link">
                                            <div>View</div>
                                        </a>
                                    </li>                                    
                                    <li class="menu-item  @if(Request::routeIs('admin.city.create')) active @endif">
                                        <a href="{{ route('admin.city.create') }}" class="menu-link">
                                            <div>Add</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>  
                    @endif
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Meta Details</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if(Request::routeIs('admin.meta.product.index')) active @endif">
                                <a href="{{ route('admin.meta.product.index') }}" class="menu-link">
                                    <div>Product</div>
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.meta.blog.index')) active @endif">
                                <a href="{{ route('admin.meta.blog.index') }}" class="menu-link">
                                    <div>Blog</div>
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.meta.application.index')) active @endif">
                                <a href="{{ route('admin.meta.application.index') }}" class="menu-link">
                                    <div>Application</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Extra</span>
                    </li>   
                    @if(auth()->user()->role == 'admin') l
                    <li class="menu-item @if(Request::routeIs('admin.user.index')) active @endif">
                        <a href="{{ route('admin.user.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>User</div>
                        </a>
                    </li>
                    <li class="menu-item @if(Request::routeIs('admin.userhistory.index')) active @endif">
                        <a href="{{ route('admin.userhistory.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>User History</div>
                        </a>
                    </li>
                    @endif           
                    <li class="menu-item">  
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-chart"></i>
                            <div>Setting</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item  @if(Request::routeIs('admin.setting')) active @endif">
                                <a href="{{ route('admin.setting') }}" class="menu-link">
                                    <div>General Setting</div>  
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.homesetting')) active @endif">
                                <a href="{{ route('admin.homesetting') }}" class="menu-link">
                                    <div>Home Setting</div>  
                                </a>
                            </li>
                            <li class="menu-item @if(Request::routeIs('admin.user.changepassword')) active @endif">
                                <a href="{{ route('admin.user.changepassword') }}" class="menu-link">
                                    <div>Change Password</div>  
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item @if(Request::routeIs('admin.logout')) active @endif">
                        <a href="{{ route('admin.logout') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-log-out"></i>
                            <div>Logout</div>
                        </a>
                    </li>
                </ul>            
            </aside>
            <!-- Layout page -->
            <div class="layout-page">
                <!-- BEGIN: Navbar-->
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">                    
                    <!--  Brand demo (display only for navbar-full and hide on below xl) -->                    
                    <!-- ! Not required for layout-without-menu -->
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>                    
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">                        
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                                    <!-- <i class="bx bx-search bx-sm"></i> -->
                                    <!-- <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span> -->
                                </a>
                            </div>
                        </div>
                        <!-- /Search -->                        
                        <ul class="navbar-nav flex-row align-items-center ms-auto">                                         
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ url('admin/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ url('admin/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">
                                                    {{ auth()->user()->name }}
                                                    </span>
                                                    <small class="text-muted">{{ auth()->user()->role }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.setting') }}">
                                            <i class="bx bx-credit-card me-2"></i>
                                            <span class="align-middle">Setting</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                            <i class='bx bx-log-in me-2'></i>
                                            <span class="align-middle">LogOut</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>                    
                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper  d-none">
                        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
                        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
                    </div>                
                </nav>
                <!-- / Navbar -->
                <!-- END: Navbar-->