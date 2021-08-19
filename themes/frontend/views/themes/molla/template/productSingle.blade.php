<div class="product product-2">
    <figure class="product-media">
        <a href="{{route('product.detail', $product->id)}}">
            <img src="{{productImage($product->id)}}" alt="Product image" class="product-image">
        </a>

        {{--                                            <div class="product-action-vertical">--}}
        {{--                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>--}}
        {{--                                            </div><!-- End .product-action -->--}}

        <div class="product-action">
            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
            <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
        </div><!-- End .product-action -->
    </figure><!-- End .product-media -->

    <div class="product-body">
        <h3 class="product-title"><a href="product.html">{{$product->title}}</a></h3><!-- End .product-title -->
        <div class="product-price">
            Rs. {{$product->price}} &nbsp; <del style="color: grey">{{'Rs. '.$product->old_price}}</del>
        </div><!-- End .product-price -->
        {{--                                            <div class="ratings-container">--}}
        {{--                                                <div class="ratings">--}}
        {{--                                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->--}}
        {{--                                                </div><!-- End .ratings -->--}}
        {{--                                                <span class="ratings-text">( 4 Reviews )</span>--}}
        {{--                                            </div><!-- End .rating-container -->--}}

        {{--                                            <div class="product-nav product-nav-dots">--}}
        {{--                                                <a href="#" style="background: #69b4ff;"><span class="sr-only">Color name</span></a>--}}
        {{--                                                <a href="#" style="background: #ff887f;"><span class="sr-only">Color name</span></a>--}}
        {{--                                                <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>--}}
        {{--                                            </div><!-- End .product-nav -->--}}
    </div><!-- End .product-body -->
</div><!-- End .product -->
