@extends(getLayout())
@section('title', $product->title)
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a>Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-separated">
                                @foreach($product->image as $key => $image)
                                <figure class="product-separated-item">
                                    <img src="{{$image}}" data-zoom-image="{{$image}}" alt="product image">
                                </figure>
                                @endforeach

                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="product-details sticky-content">
                                <h1 class="product-title">{{$product->title}}</h1><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">{{'Rs. '. $product->variants[0]->price}}</span>
                                    <span class="old-price">{{$product->variants[0]->old_price ?'Rs. '. $product->variants[0]->old_price : ''}}</span>
                                </div><!-- End .product-price -->

                                <div class="product-content">
                                    <p>{{$product->short_description}}</p>
                                </div><!-- End .product-content -->

                                <div class="details-filter-row details-row-size">
                                    <label for="size">Variants:</label>
                                    <div class="select-custom">
                                        <select name="variant" id="size" class="form-control">
                                            <option value="#" selected="selected">Select a variant</option>
                                            @foreach($pov as $variant)
                                            <option value="{{$variant['id']}}">{{$variant['options']}}</option>
                                            @endforeach

                                        </select>
                                    </div><!-- End .select-custom -->

                                    {{-- <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a> --}}
                                </div><!-- End .details-filter-row -->
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->

                                <div class="product-details-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>

                                    <div class="details-action-wrapper">
                                        <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                    </div><!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->

                                <div class="accordion accordion-plus product-details-accordion" id="product-accordion">

                                    <div class="card card-box card-sm">
                                        <div class="card-header" id="product-info-heading">
                                            <h2 class="card-title">
                                                <a role="button" data-toggle="collapse" href="#" aria-expanded="true" aria-controls="product-accordion-info">
                                                    Description
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="product-accordion-info" class="collapse show" aria-labelledby="product-info-heading" data-parent="#product-accordion">
                                            <div class="card-body">
                                                <div class="product-desc-content">
                                                    {!! $product->description !!}
                                                </div><!-- End .product-desc-content -->
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                </div><!-- End .accordion -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->

                <hr class="mt-3 mb-5">

                <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                     data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
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
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                    @foreach($productLike as $product)
                        @include('themes.molla.template.productSingle')
                    @endforeach
                </div><!-- End .owl-carosel -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

@stop
