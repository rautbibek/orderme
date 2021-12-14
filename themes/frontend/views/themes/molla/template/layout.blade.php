<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">


<!-- molla/index-4.html  22 Nov 2019 09:53:08 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('meta_keyword', 'tradekunj, e-commerce, shopping, buy and sell, buy, sell, nepal')">
    <meta name="description" content="@yield('meta_description', 'Tradekunj, A complete ecommerce platform, where you can buy or sell on your own. Get logged in today.')">
    <meta property="og:url" content="@yield('og_url', '/')" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('meta_description', 'Tradekunj, A complete ecommerce platform, where you can buy or sell on your own. Get logged in today.')" />
    <meta property="og:site_name" content="Tradekunj" />


    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('meta_description', 'Tradekunj, A complete ecommerce platform, where you can buy or sell on your own. Get logged in today.')" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:url" content="@yield('og_url', '/')" />
    <meta property="og:image" content="@yield('image',getConfig('logo'))" />
    <meta property="twitter:image" content="@yield('image',getConfig('logo'))" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{getConfig('favicon')}}">

{{--    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">--}}
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css')}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/css/plugins/jquery.countdown.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/css/skins/skin-demo-4.css')}}">
    <link rel="stylesheet" href="{{asset('themes/frontend/assets/css/demos/demo-4.css')}}">
    {{-- <script src="{{ asset('themes/frontend/js/hiFive.js') }}" ></script> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>

<body>

<!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "110480434662338");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

<div class="page-wrapper">
    <header class="header header-intro-clearance header-4">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <a href="tel:#"><i class="icon-phone"></i>Call: {{getConfig('phone_number')}}</a>
                </div><!-- End .header-left -->

                <div class="header-right">

                    <ul class="top-menu">
                        <li>
                            <ul>
                                @guest
                                    <li><a href="/login">Sign in / Sign up</a></li>
                                @else
                                    {{ Auth::user()->name }}
                                @endguest
                            </ul>
                        </li>
                    </ul><!-- End .top-menu -->
                </div><!-- End .header-right -->

            </div><!-- End .container -->
        </div><!-- End .header-top -->

        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="/" class="logo">
                        <img src="{{getConfig('logo')}}" alt="Tradekunj Logo" width="105" height="25">
                    </a>
                </div><!-- End .header-left -->

                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="{{ route('search') }}" method="get">
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="q" class="sr-only">Search</label>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                <input type="search" class="form-control" name="search" id="q" placeholder="Search product ..." required>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->
                </div>

                <div class="header-right">
{{--                    <div class="dropdown compare-dropdown">--}}
{{--                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">--}}
{{--                            <div class="icon">--}}
{{--                                <i class="icon-random"></i>--}}
{{--                            </div>--}}
{{--                            <p>Compare</p>--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                            <ul class="compare-products">--}}
{{--                                <li class="compare-product">--}}
{{--                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>--}}
{{--                                    <h4 class="compare-product-title"><a href="product.html">Blue Night Dress</a></h4>--}}
{{--                                </li>--}}
{{--                                <li class="compare-product">--}}
{{--                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>--}}
{{--                                    <h4 class="compare-product-title"><a href="product.html">White Long Skirt</a></h4>--}}
{{--                                </li>--}}
{{--                            </ul>--}}

{{--                            <div class="compare-actions">--}}
{{--                                <a href="#" class="action-link">Clear All</a>--}}
{{--                                <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>--}}
{{--                            </div>--}}
{{--                        </div><!-- End .dropdown-menu -->--}}
{{--                    </div><!-- End .compare-dropdown -->--}}

{{--                    <div class="wishlist">--}}
{{--                        <a href="wishlist.html" title="Wishlist">--}}
{{--                            <div class="icon">--}}
{{--                                <i class="icon-heart-o"></i>--}}
{{--                                <span class="wishlist-count badge">3</span>--}}
{{--                            </div>--}}
{{--                            <p>Wishlist</p>--}}
{{--                        </a>--}}
{{--                    </div><!-- End .compare-dropdown -->--}}

                    <div class="dropdown cart-dropdown">
{{--                        <a href="/cart" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">--}}
                        <a href="/cart" class="dropdown-toggle">
                            <div class="icon">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count">{{cartItem()}}</span>
                            </div>
                            <p>Cart</p>
                        </a>

{{--                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                            <div class="dropdown-cart-products">--}}
{{--                                <div class="product">--}}
{{--                                    <div class="product-cart-details">--}}
{{--                                        <h4 class="product-title">--}}
{{--                                            <a href="product.html">Beige knitted elastic runner shoes</a>--}}
{{--                                        </h4>--}}

{{--                                        <span class="cart-product-info">--}}
{{--                                                <span class="cart-product-qty">1</span>--}}
{{--                                                x $84.00--}}
{{--                                            </span>--}}
{{--                                    </div><!-- End .product-cart-details -->--}}

{{--                                    <figure class="product-image-container">--}}
{{--                                        <a href="product.html" class="product-image">--}}
{{--                                            <img src="{{asset('themes/frontend/assets/images/products/cart/product-1.jpg')}}" alt="product">--}}
{{--                                        </a>--}}
{{--                                    </figure>--}}
{{--                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>--}}
{{--                                </div><!-- End .product -->--}}

{{--                                <div class="product">--}}
{{--                                    <div class="product-cart-details">--}}
{{--                                        <h4 class="product-title">--}}
{{--                                            <a href="product.html">Blue utility pinafore denim dress</a>--}}
{{--                                        </h4>--}}

{{--                                        <span class="cart-product-info">--}}
{{--                                                <span class="cart-product-qty">1</span>--}}
{{--                                                x $76.00--}}
{{--                                            </span>--}}
{{--                                    </div><!-- End .product-cart-details -->--}}

{{--                                    <figure class="product-image-container">--}}
{{--                                        <a href="product.html" class="product-image">--}}
{{--                                            <img src="{{asset('themes/frontend/assets/images/products/cart/product-2.jpg')}}" alt="product">--}}
{{--                                        </a>--}}
{{--                                    </figure>--}}
{{--                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>--}}
{{--                                </div><!-- End .product -->--}}
{{--                            </div><!-- End .cart-product -->--}}

{{--                            <div class="dropdown-cart-total">--}}
{{--                                <span>Total</span>--}}

{{--                                <span class="cart-total-price">$160.00</span>--}}
{{--                            </div><!-- End .dropdown-cart-total -->--}}

{{--                            <div class="dropdown-cart-action">--}}
{{--                                <a href="cart.html" class="btn btn-primary">View Cart</a>--}}
{{--                                <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>--}}
{{--                            </div><!-- End .dropdown-cart-total -->--}}
{{--                        </div><!-- End .dropdown-menu -->--}}
                    </div><!-- End .cart-dropdown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->

        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="header-left">
                    <div class="dropdown category-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                            Browse Categories <i class="icon-angle-down"></i>
                        </a>

                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">
                                    @foreach(allCategory() as $category)
                                        <li class="item-lead"><a href="{{route('category', $category->slug)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul><!-- End .menu-vertical -->
                            </nav><!-- End .side-nav -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .category-dropdown -->
                </div><!-- End .header-left -->

                <div class="header-center">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            @foreach(getMenu('main_menu')['design'] ??  [] as $menu)
                                                    <li>
                                                        <li>
                                                            <a href="{{menuUrl($menu)}}" class="sf-with-ul">{{$menu['name']}}</a>
                                    @if(count($menu['children'] ?? []) > 0)
                                                            <div class="megamenu megamenu-md ">
                                                                <div class="row no-gutters">
                                                                    <div class="col-md-8">
                                                                        <div class="menu-col">
                                                                            <div class="row ">
                                                                                @foreach($menu['children'] ?? [] as $item )
                                                                                <div class="col-md-6">
                                                                                    <div class="menu-title">
                                                                                        <a href="{{menuUrl($item)}}" class="text-success">{{$item['name']}}</a>
                                                                                    </div><!-- End .menu-title -->
                                                                                    @if(count($item['children'] ?? []) > 0)
                                                                                    <ul>
                                                                                        @foreach($item['children'] ?? [] as $_item)
                                                                                        <li><a href="{{menuUrl($_item)}}">{{$_item['name']}}</a></li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                    @endif

                                                                                </div><!-- End .col-md-6 -->
                                                                                @endforeach
                                                                            </div><!-- End .row -->
                                                                        </div><!-- End .menu-col -->
                                                                    </div><!-- End .col-md-8 -->


                                                                </div><!-- End .row -->
                                                            </div><!-- End .megamenu megamenu-md -->
                                        @endif
                                                        </li>
                            @endforeach
                            {{--                            @foreach(getMenu('main_menu')['design'] ??  [] as $menu)--}}
{{--                            <li>--}}
{{--                                <a href="{{menuUrl($menu)}}" class="sf-with-ul">{{$menu['name']}}</a>--}}
{{--                                @if(count($menu['children'] ?? []) > 0)--}}
{{--                                    <ul>--}}
{{--                                        @foreach($menu['children'] ?? [] as $item )--}}
{{--                                        <li>--}}
{{--                                            <a href="{{menuUrl($item)}}" class="sf-with-ul">{{$item['name']}}</a>--}}
{{--                                            @if(count($item['children'] ?? []) > 0)--}}
{{--                                            <ul>--}}

{{--                                                @foreach($item['children'] ?? [] as $_item)--}}
{{--                                                     <li><a href="{{menuUrl($_item)}}">{{$_item['name']}}</a></li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                                @endif--}}
{{--                                        </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                @endif--}}
{{--                            </li>--}}

{{--                            @endforeach--}}

                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->
                </div><!-- End .header-center -->

            </div><!-- End .container -->
        </div><!-- End .header-bottom -->
    </header><!-- End .header -->
    @yield('content')

    <footer class="footer">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget widget-about">
                            <img src="{{getConfig('footer_logo')}}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                            <div class="widget-call">
                                <i class="icon-phone"></i>
                                Got Question? Call us 24/7
                                <a href="tel:#">{{getConfig('phone_number')}}</a>
                            </div><!-- End .widget-call -->
                        </div><!-- End .widget about-widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">{{getMenu('footer_menu_1')['name'] ?? ''}}</h4><!-- End .widget-title -->
                            <ul class="widget-list">
                                @foreach(getMenu('footer_menu_1')['design'] ?? [] as $menu)
                                    <li><a href="{{menuUrl($menu)}}">{{$menu['name']}}</a></li>
                                @endforeach
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">{{getMenu('footer_menu_2')['name'] ?? ''}}</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                @foreach(getMenu('footer_menu_2')['design'] ?? [] as $menu)
                                    <li><a href="{{menuUrl($menu)}}">{{$menu['name']}}</a></li>
                                @endforeach
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">{{getMenu('pages_menu')['name'] ?? ''}}</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                @foreach(getMenu('pages_menu')['design'] ?? [] as $menu)
                                    <li><a href="{{menuUrl($menu)}}">{{$menu['name']}}</a></li>
                                @endforeach
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .footer-middle -->

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">{{getConfig('copyright_text')}} © {{date('Y')}}</p><!-- End .footer-copyright -->
{{--                <figure class="footer-payments">--}}
{{--                    <img src="assets/images/payments.png" alt="Payment methods" width="272" height="20">--}}
{{--                </figure><!-- End .footer-payments -->--}}
            </div><!-- End .container -->
        </div><!-- End .footer-bottom -->
    </footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container mobile-menu-light">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">

                    @foreach(getMenu('main_menu')['design'] ??  [] as $menu)
                            <li>
                                <a href="{{menuUrl($menu)}}" >{{$menu['name']}}</a>
                                @if(count($menu['children'] ?? []) > 0)
                                    <ul>
                                        @foreach($menu['children'] ?? [] as $item )
                                            <li>
                                                <a href="{{menuUrl($item)}}" >{{$item['name']}}</a>
                                                @if(count($item['children'] ?? []) > 0)
                                                    <ul>

                                                        @foreach($item['children'] ?? [] as $_item)
                                                            <li><a href="{{menuUrl($_item)}}">{{$_item['name']}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>

                        @endforeach

                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                        @foreach(allCategory() as $category)
                            <li class="item-lead"><a href="{{route('category', $category->slug)}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul><!-- End .mobile-cats-menu -->
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->

        <div class="social-icons">
            @if(getConfig('facebookUrl') != '')
                <a href="{{getConfig('facebookUrl')}}" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            @endif
            @if(getConfig('twitterUrl') != '')
                    <a href="{{getConfig('twitterUrl')}}" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            @endif
            @if(getConfig('instagramUrl') != '')
                    <a href="{{getConfig('instagramUrl')}}" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            @endif
            @if(getConfig('youtubeUrl') != '')
                    <a href="{{getConfig('youtubeUrl')}}" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            @endif
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->

{{--<div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-10">--}}
{{--            <div class="row no-gutters bg-white newsletter-popup-content">--}}
{{--                <div class="col-xl-3-5col col-lg-7 banner-content-wrap">--}}
{{--                    <div class="banner-content text-center">--}}
{{--                        <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">--}}
{{--                        <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>--}}
{{--                        <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>--}}
{{--                        <form action="#">--}}
{{--                            <div class="input-group input-group-round">--}}
{{--                                <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn" type="submit"><span>go</span></button>--}}
{{--                                </div><!-- .End .input-group-append -->--}}
{{--                            </div><!-- .End .input-group -->--}}
{{--                        </form>--}}
{{--                        <div class="custom-control custom-checkbox">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>--}}
{{--                            <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>--}}
{{--                        </div><!-- End .custom-checkbox -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-2-5col col-lg-5 ">--}}
{{--                    <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Plugins JS File -->
 <script src="{{ asset('themes/frontend/js/frontend.js') }}" ></script>
<script src="{{asset('themes/frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/jquery.hoverIntent.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/superfish.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/jquery.plugin.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/jquery.countdown.min.js')}}"></script>
<!-- Main JS File -->
<script src="{{asset('themes/frontend/assets/js/main.js')}}"></script>
<script src="{{asset('themes/frontend/assets/js/demos/demo-4.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>

<script>
    $(document).ready(function() {
        $('#size').on('change', function (e) {
            var optionSelected = $('#size :selected').val();
            var variants = tradekunjProduct.variants
            var result = variants.find( function(variant){
                return variant.id === parseInt(optionSelected);
            });

            const price = result.price;
            const old_price = result.old_price;
            $('#price-selected').html(`Rs. ${price}`);
            $('#old-price-selected').html(!!old_price ? `Rs. ${old_price}` : null);
        })
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    });
</script>
@yield('js')
<script>
    @if(Session::has('message'))
    toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.success("{{ session('message') }}");
    @endif

    @if($errors->any())
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error('{{ $errors->first() }}')
    @endif

</script>
</body>


<!-- molla/index-4.html  22 Nov 2019 09:54:18 GMT -->
</html>
