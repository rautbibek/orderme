@extends(getLayout())
@section('title', 'Tradekunj E-commerce')
@section('content')
    <main class="main">
        <div class="intro-slider-container mb-5">
            <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
                 data-owl-options='{
                        "dots": true,
                        "nav": false,
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                @foreach (getConfig('slider')?? [] as $slider)
                    @if(count($slider) > 0)
                        <div class="intro-slide" style="background-image: url('{{$slider['slide_image']}}');">
                            <div class="container intro-content">
                                <div class="row justify-content-end">
                                    <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                        <h3 class="intro-subtitle text-primary">{{$slider['slide_caption_title'] ?? ''}}</h3><!-- End .h3 intro-subtitle -->
                                        <h1 class="intro-title">{{$slider['slide_caption_intro'] ?? ''}}</h1><!-- End .intro-title -->

                                        <div class="intro-price">
                                            <sup>Today:</sup>
                                            <span class="text-primary">
                                            {{$slider['slide_price'] ?? ''}}
                                        </span>
                                        </div><!-- End .intro-price -->

                                        <a href="{{$slider['slide_button_link'] ?? ''}}" class="btn btn-primary btn-round">
                                            <span>{{$slider['slide_button_text'] ?? ''}}</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </a>
                                    </div><!-- End .col-md-6 offset-md-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .intro-content -->
                        </div><!-- End .intro-slide -->
                    @endif
                @endforeach

            </div><!-- End .intro-slider owl-carousel owl-simple -->

            <span class="slider-loader"></span><!-- End .slider-loader -->
        </div><!-- End .intro-slider-container -->

        @foreach (getConfig('popular_collection')?? [] as $col)
        @if(count($col) > 0)
                <div class="container">
                    <h2 class="title text-center mb-4">{{$col['name'] ?? ''}}</h2><!-- End .title text-center -->
                    <div class="cat-blocks-container">
                        <div class="row">
                            @foreach (getCollection($col['collection'] ?? [])->take(6)?? [] as $product)
                                <div class="col-6 col-sm-4 col-lg-2">
                                    <a href="{{route('product.detail', $product->slug)}}" class="cat-block">
                                        <figure>
                                            <span>
                                                <img src="{{productImage($product->id)}}" style="object-fit:contain; height: 300px; background-color: white"  alt="Collection image">
                                            </span>
                                        </figure>

                                        <h3 class="cat-block-title">{{$product->title}}</h3><!-- End .cat-block-title -->
                                        <span>Rs. {{$product->price}} &nbsp; <del> Rs. {{$product->old_price}}</del></span>
                                    </a>
                                </div><!-- End .col-sm-4 col-lg-2 -->
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .cat-blocks-container -->
                </div><!-- End .container -->
            @endif
        @endforeach

        <div class="mb-4"></div><!-- End .mb-4 -->

        <div class="container">
            <div class="row justify-content-center">
                @foreach(getConfig('offer_cart') ?? [] as $card)
                @if(count($card) > 0)
                        <div class="col-md-6 col-lg-4">
                            <div class="banner banner-overlay banner-overlay-light">
                                <a href="#">
                                    <img src="{{$card['image'] ?? ''}}" alt="Banner">
                                </a>

                                <div class="banner-content">
                                    <h4 class="banner-subtitle"><a href="#">{{$card['title'] ?? ''}}</a></h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title"><a href="{{$card['link'] ?? ''}}">{{$card['description'] ?? ''}}</a></h3><!-- End .banner-title -->
                                    <a href="{{$card['link'] ?? ''}}" class="banner-link">{{$card['button'] ?? ''}}<i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                    @endif
                @endforeach

            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-3"></div><!-- End .mb-5 -->
        @foreach(getConfig('collection_gallery') ?? [] as $colKey => $collection)
            @if(count($collection) > 0)
        <div class="container new-arrivals">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">{{$collection['name'] ?? ''}}</h2><!-- End .title -->
                </div><!-- End .heading-left -->

                <div class="heading-right">
                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        @foreach($collection['collection'] ?? [] as $key=> $col)
                            <li class="nav-item">
                                <a class="nav-link {{$key == 0 ? 'active' : ''}}" id="new-tv-link" data-toggle="tab" href="#new-{{$key}}-{{$colKey}}" role="tab" aria-controls="new-tv-tab" aria-selected="false">{{getCollectionName($col)}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="tab-content tab-content-carousel just-action-icons-sm">
                @foreach($collection['collection'] ?? [] as $key=> $col)
                <div class="tab-pane p-0 fade show {{$key== 0? 'active': ''}}" id="new-{{$key}}-{{$colKey}}" role="tabpanel" aria-labelledby="new-all-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                         data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>
                        @foreach(getCollection($col)->take(8) ?? [] as $product )
                            @include('themes.molla.template.productSingle')
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                @endforeach
            </div><!-- End .tab-content -->
        </div><!-- End .container -->
            @endif
        @endforeach

        <div class="mb-6"></div><!-- End .mb-6 -->
        @foreach(getConfig('banner_design') ?? [] as $banner)
            @if(count($banner) > 0)
        <div class="container">
            <div class="cta cta-border mb-5" style="background-image: url('{{$banner['backgroundImage'] ?? asset('themes/frontend/assets/images/demos/demo-4/bg-1.jpg')}}');">
                <img src="{{$banner['image'] ?? ''}}" alt="camera" class="cta-img" style="max-height: 150px">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="cta-content">
                            <div class="cta-text text-right text-white">
                                <p>{{$banner['title'] ?? ''}} <br><strong>{{$banner['description'] ?? ''}}</strong></p>
                            </div><!-- End .cta-text -->
                            <a href="{{$banner['link'] ?? ''}}" class="btn btn-primary btn-round"><span>{{$banner['button'] ?? ''}}</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .cta-content -->
                    </div><!-- End .col-md-12 -->
                </div><!-- End .row -->
            </div><!-- End .cta -->
        </div><!-- End .container -->
@endif
        @endforeach
        @foreach(getConfig('trending_collection') ?? [] as $colKey => $collection)
            @if(count($collection) > 0)
        <div class="bg-light pt-5 pb-6">
            <div class="container trending-products">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">{{$collection['name'] ?? ''}}</h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                    <div class="heading-right">
                        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                            @foreach($collection['collection'] ?? [] as $key => $col)
                            <li class="nav-item">
                                <a class="nav-link {{$key == 0 ? 'active' : ''}}" id="trending-best-link" data-toggle="tab" href="#trending-{{$key}}-{{$colKey}}" role="tab" aria-controls="trending-best-link" aria-selected="false">{{getCollectionName($col)}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div><!-- End .heading-right -->
                </div><!-- End .heading -->

                        <div class="tab-content tab-content-carousel just-action-icons-sm">
                            @foreach($collection['collection'] ?? [] as $key => $col)
                            <div class="tab-pane p-0 fade show {{$key == 0 ? 'active': ''}}" id="trending-{{$key}}-{{$colKey}}" role="tabpanel" aria-labelledby="trending-best-link">
                                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                                     data-owl-options='{
                                            "nav": true,
                                            "dots": false,
                                            "margin": 20,
                                            "loop": false,
                                            "responsive": {
                                                "0": {
                                                    "items":2
                                                },
                                                "480": {
                                                    "items":2
                                                },
                                                "768": {
                                                    "items":3
                                                },
                                                "992": {
                                                    "items":5
                                                }
                                            }
                                        }'>
                                    @foreach(getCollection($col)->take(8) as $product)
                                        @include('themes.molla.template.productSingle')
                                    @endforeach
                                </div><!-- End .owl-carousel -->
                            </div><!-- .End .tab-pane -->
                            @endforeach
                        </div><!-- End .tab-content -->

            </div><!-- End .container -->
        </div><!-- End .bg-light pt-5 pb-6 -->
            @endif
        @endforeach
        <div class="mb-5"></div><!-- End .mb-5 -->

        <div class="container">
            <div class="row justify-content-center">
                @foreach(getConfig('bottom_card') ?? [] as $card)
                    @if(count($card) > 0)
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="{{$card['image'] ?? ''}}" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">{{$card['title'] ?? ''}}</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title"><a href="{{$card['link'] ?? ''}}">{{$card['description'] ?? ''}}</a></h3><!-- End .banner-title -->
                                <a href="{{$card['link'] ?? ''}}" class="banner-link">{{$card['button'] ?? ''}}<i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-4 -->
                    @endif
                @endforeach

            </div><!-- End .row -->
        </div><!-- End .container -->
        <div class="mb-5"></div><!-- End .mb-5 -->
        @foreach(getConfig('bottom_collection') ?? [] as $col)
            @if(count($col) > 0)
        <div class="container for-you">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">{{$col['name'] ?? ''}}</h2><!-- End .title -->
                </div><!-- End .heading-left -->
            </div><!-- End .heading -->

            <div class="products">
                <div class="row justify-content-center">
                    @foreach(getCollection($col['collection'] ?? [])->take(8) ?? [] as $product)
                    <div class="col-6 col-md-4 col-lg-2">
                        @include('themes.molla.template.productSingle')
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- End .container -->
            @endif
        @endforeach
        <div class="mb-4"></div><!-- End .mb-4 -->

        <div class="container">
            <hr class="mb-0">
        </div><!-- End .container -->

        <div class="icon-boxes-container bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-white">
                                    <i class="icon-rocket"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                                <p class="text-white">Orders $50 or more</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                                <p>Within 30 days</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                                <p>when you sign up</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                                <p>24/7 amazing services</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .icon-boxes-container -->
    </main><!-- End .main -->

@stop
