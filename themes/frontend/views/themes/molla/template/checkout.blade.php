@extends(getLayout())
@section('title', 'Checkout | Tradekunj')
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url({{asset('/themes/frontend/assets/images/page-header-bg.jpg')}})">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">

                            <div class="cart-bottom">
                                <form action="{{route('confirm.order')}}" method="post" class="contact-form mb-3">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="cname" class="sr-only">Name</label>
                                            <input type="text" name="name" class="form-control" id="cname" placeholder="Name *" >
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6">
                                            <label for="cphone" class="sr-only">Phone</label>
                                            <input type="tel" name="phone" class="form-control" id="cphone" placeholder="Phone">
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6">
                                            <label for="province" class="sr-only">Province</label>
                                            <select name="province" class="form-control" id="province">
                                                <option value="" selected disabled hidden>Select Province</option>
                                                @foreach($provinces as $key =>  $province)
                                                    <option value="{{$province['iso_code']}}">{{$province['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6">
                                            <label for="city" class="sr-only">City</label>
                                            <select name="city" class="form-control" id="city">
                                                <option value="" selected disabled hidden>Select City</option>
                                            </select>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-12">
                                            <label for="cstreet" class="sr-only">Street 1 *</label>
                                            <input type="tel" name="street1" class="form-control" placeholder="Street 1">
                                        </div><!-- End .col-sm-12 -->
                                        <div class="col-sm-12">
                                            <label for="cstreet" class="sr-only">Street 2</label>
                                            <input type="tel" name="street2" class="form-control" id="cstreet" placeholder="Street 2">
                                        </div><!-- End .col-sm-12 -->
                                    </div><!-- End .row -->
                                    <div class="d-flex justify-content-center"><span>OR</span></div>
                                    <hr>
                                        <div class="row">
                                            @foreach($shipping_address as $address)
                                            <div class="col-sm-12">
                                                <div class="form-check">

                                                    <input class="form-check-input" class="mt-2" value="{{$address->id}}" type="radio" name="address_selected" id="flexRadioDefault1">
                                                    <label class="form-check-label ml-3" for="flexRadioDefault1">
                                                        {{$address->name.' ,'. $address->street1}}
                                                    </label>
                                                </div>
                                            </div><!-- End .col-sm-6 -->

                                            @endforeach
                                        </div><!-- End .row -->
                                    <br><br>

                                    <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                        <span>SUBMIT</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form><!-- End .contact-form -->
                            </div><!-- End .cart-bottom -->
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>Rs. {{$order->items_total / 100}}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>

{{--                                    <tr class="summary-shipping-row">--}}
{{--                                        <td>--}}
{{--                                            <div class="custom-control custom-radio">--}}
{{--                                                <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">--}}
{{--                                                <label class="custom-control-label" for="free-shipping">Free Shipping</label>--}}
{{--                                            </div><!-- End .custom-control -->--}}
{{--                                        </td>--}}
{{--                                        <td>$0.00</td>--}}
{{--                                    </tr><!-- End .summary-shipping-row -->--}}

{{--                                    <tr class="summary-shipping-row">--}}
{{--                                        <td>--}}
{{--                                            <div class="custom-control custom-radio">--}}
{{--                                                <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">--}}
{{--                                                <label class="custom-control-label" for="standart-shipping">Standart:</label>--}}
{{--                                            </div><!-- End .custom-control -->--}}
{{--                                        </td>--}}
{{--                                        <td>$10.00</td>--}}
{{--                                    </tr><!-- End .summary-shipping-row -->--}}

{{--                                    <tr class="summary-shipping-row">--}}
{{--                                        <td>--}}
{{--                                            <div class="custom-control custom-radio">--}}
{{--                                                <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">--}}
{{--                                                <label class="custom-control-label" for="express-shipping">Express:</label>--}}
{{--                                            </div><!-- End .custom-control -->--}}
{{--                                        </td>--}}
{{--                                        <td>$20.00</td>--}}
{{--                                    </tr><!-- End .summary-shipping-row -->--}}

{{--                                    <tr class="summary-shipping-estimate">--}}
{{--                                        <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>--}}
{{--                                        <td>&nbsp;</td>--}}
{{--                                    </tr><!-- End .summary-shipping-estimate -->--}}

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>Rs. {{$order->total / 100}}</td>
                                    </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->
                            </div><!-- End .summary -->

                            <a href="/" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
    <script>
        $(document).ready(function() {
            $('#province').on('change', function (e) {
                var provinceSelected = $('#province :selected').val();
                // console.log(provinceSelected);
                $.ajax({
                    url: `/province/${provinceSelected}`,
                    type: "GET",
                    cache: true,
                    data:{},
                    success: function(dataResult){
                        var $el = $("#city");
                        $el.empty(); // remove old options
                        $.each(dataResult.subdivisions, function(key,value) {
                            $el.append($("<option></option>")
                                .attr("value", value).text(value));
                        });
                    }
                });

            })

        });
    </script>
@stop
