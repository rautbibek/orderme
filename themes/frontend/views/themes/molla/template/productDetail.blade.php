@extends(getLayout())
@section('title', $product->title)
@section('content')
    <div class="page-content mt-5">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure  style="display: flex; justify-content: center; background-color: whitesmoke">
                                <img id="product-zoom" style="max-height: 400px; width: auto" src="{{productImage($product->id)}}" data-zoom-image="assets/images/products/single/extended/3-big.jpg" alt="product image">
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach($product->image as $image)
                                <a class="product-gallery-item" href="#" data-image="{{$image}}" data-zoom-image="{{$image}}">
                                    <img src="{{$image}}" alt="product side">
                                </a>
                                @endforeach

                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{$product->title}}</h1><!-- End .product-title -->

{{--                            <div class="ratings-container">--}}
{{--                                <div class="ratings">--}}
{{--                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->--}}
{{--                                </div><!-- End .ratings -->--}}
{{--                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>--}}
{{--                            </div><!-- End .rating-container -->--}}
                            <div class="product-price">
                                {{'Rs. ' .$product->variants[0]->price}} &nbsp; <del style="color:grey">{{'Rs. ' .$product->variants[0]->old_price}}</del>
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>{{$product->short_description}} </p>
                            </div><!-- End .product-content -->

{{--                            <div class="details-filter-row details-row-size">--}}
{{--                                <label for="size">Size:</label>--}}
{{--                                <div class="select-custom">--}}
{{--                                    <select name="size" id="size" class="form-control">--}}
{{--                                        <option value="#" selected="selected">Select a size</option>--}}
{{--                                        <option value="s">Small</option>--}}
{{--                                        <option value="m">Medium</option>--}}
{{--                                        <option value="l">Large</option>--}}
{{--                                        <option value="xl">Extra Large</option>--}}
{{--                                    </select>--}}
{{--                                </div><!-- End .select-custom -->--}}
{{--                            </div><!-- End .details-filter-row -->--}}

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
                                    <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->

{{--                            <div class="product-details-footer">--}}
{{--                                <div class="product-cat">--}}
{{--                                    <span>Category:</span>--}}
{{--                                    <a href="#">Women</a>,--}}
{{--                                    <a href="#">Shoes</a>,--}}
{{--                                    <a href="#">Sandals</a>,--}}
{{--                                    <a href="#">Yellow</a>--}}
{{--                                </div><!-- End .product-cat -->--}}

{{--                                <div class="social-icons social-icons-sm">--}}
{{--                                    <span class="social-label">Share:</span>--}}
{{--                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>--}}
{{--                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>--}}
{{--                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>--}}
{{--                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>--}}
{{--                                </div>--}}
{{--                            </div><!-- End .product-details-footer -->--}}
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>--}}
{{--                    </li>--}}
                </ul>
            </div><!-- End .container -->

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="row"  style="background-color: whitesmoke">
                            <div class="container py-5">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-4 ">
                                        <h2>{{$product->title}}</h2>
                                        <p>{{$product->description}}</p>
                                    </div><!-- End .col-lg-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .container -->
                        </div><!-- End .product-desc-row -->

                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
               </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <div class="container">
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
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->

@stop
