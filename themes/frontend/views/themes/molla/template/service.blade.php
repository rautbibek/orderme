@extends(getLayout())
@section('title', $service->title . ' | Tradekunj Services' )
@section('content')
    <div class="page-content">
        <div class="page-header text-center mb-2">
            <h1 class="page-title">{{ $service->title }}<span>Services</span></h1>
        </div>

        <div class="product">
            <div class="row justify-content-center">
                @foreach($experts as $expert)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media grey-bg">
                                <a href="{{route('experts.detail', $expert->slug)}}">
                                    <img src="{{$expert->image}}" style="border-radius: 50%;max-width:170px;display: inline-block !important;height:150px;width:150px;vertical-align:middle"  alt="Product image" class="product-image">
                                </a>
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{$expert->address}}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="{{route('experts.detail', $expert->slug)}}">{{$service->title}}</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <a href="{{route('experts.detail', $expert->slug)}}">View Detail <i class="icon-long-arrow-right"></i> </a>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <div class="product-action">

                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div>

                @endforeach
            </div>
        </div>

    </div>
@endsection
