<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keyword')">
    <meta name="author" content="Sumer Choudhary">
    <meta name="copyright" content="{{ $setting->title }}" />

    <meta property="og:type" content="website" />
    <meta property='og:locale' content='en_US' />
    <meta property="og:site_name" content="{{ $setting->title }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="{{ url('images/setting/logo',$setting->logo) }}" />
    <link rel="canonical" href="{{url()->current()}}"/>

    <meta name="twitter:card" content="{{ $setting->title }}" />
    <meta name="twitter:site" content="{{ $setting->title }}" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta name="twitter:image" content="{{ url('images/setting/logo',$setting->logo) }}" />
    <meta name="twitter:creator" content="Sumer Choudhary">
    <meta name="msvalidate.01" content="DF3659272215666028CFB769FC81AFF8" />

    <link rel="icon" href="{{ url('images/setting',$setting->favicon) }}" sizes="32x32">


        <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

       

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/fontawesome.min.js" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
        
        
        
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>

       <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">

       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  
       

       <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

       <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://www.jqueryscript.net/demo/Easy-jQuery-International-Telephone-Input-Plugin-IntlInputPhone/js/intlInputPhone.min.js"></script>

       {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css"> --}}
       <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css" rel="stylesheet" media="screen">
   
   
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput-jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.min.js"></script>




           
</head>

<body>
    {!! $setting->analytics !!}
    {!! $setting->tag_manager !!}
    {!! $setting->console_script !!}
    @yield('schema')

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T88ZKBC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
