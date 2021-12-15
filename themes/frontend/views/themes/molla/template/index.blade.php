@extends(getLayout())
@section('title', 'User | Tradekunj')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ asset('themes/frontend/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">My Account</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-affiliate-program-link" data-toggle="tab" href="#tab-affiliate-program" role="tab" aria-controls="tab-affiliate-program" aria-selected="false">Affiliate Program</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="#">Sign Out</a> -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="nav-link" href="javascript:void(0);" onclick="logout()">Sign Out</a>
                                </form>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <p>Dashboard</p>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <!-- <p>No order has been made yet.</p>
                                <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a> -->
                                <div class="page-content">
                                    <h2 class="title text-center mb-2">Order History</h2>
                                    <div class="container">

                                        @foreach ($user_orders as $order)
                                        <article class="entry entry-list">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <div class="entry-body">
                                                        <article class="entry entry-list">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-8">
                                                                    <div class="entry-body">
                                                                        <div class="entry-meta">
                                                                            <span class="entry-author">
                                                                                by <a href="#">{{ $order->user->name }}</a>
                                                                            </span>
                                                                            <span class="meta-separator">|</span>
                                                                            <a href="#">{{ $order->created_at }}</a>
                                                                        </div><!-- End .entry-meta -->

                                                                        <h2 class="entry-title">
                                                                            <a href="single.html">#{{ $order->id }}</a>
                                                                        </h2><!-- End .entry-title -->

                                                                        <div class="entry-cats" style="display: flex;justify-content: space-between;">
                                                                            <p>Delivery Stauts
                                                                                @if ($order->shipping_state=='shipped')
                                                                                    <a href="#" class="btn btn-success btn-round btn-shadow text-white" style="padding: 0;">Delivered</a>
                                                                                @else   
                                                                                    <a href="#" class="btn btn-sm btn-danger btn-round btn-shadow text-white" style="padding: 0;">Pending</a>
                                                                                @endif
                                                                            </p>
                                                                            <p>Payment Status : 
                                                                                @if ($order->payment_state=='paid')
                                                                                    <a href="#" class="btn btn-success btn-round btn-shadow text-white" style="padding: 0;">Paid</a>
                                                                                @else   
                                                                                    <a href="#" class="btn btn-sm btn-danger btn-round btn-shadow text-white" style="padding: 0;">Unpaid</a>
                                                                                @endif
                                                                            </p>
                                                                            <p>
                                                                                Amount : RS {{ $order->total }}
                                                                            </p>
                                                                        </div><!-- End .entry-cats -->

                                                                        <div class="entry-content">
                                                                            <a href="#">
                                                                                <i class="icon-eye"></i>
                                                                            </a>
                                                                            <a href="#">
                                                                                <i class="icon-trash"></i>
                                                                            </a>
                                                                        </div><!-- End .entry-content -->
                                                                    </div><!-- End .entry-body -->
                                                                </div><!-- End .col-md-8 -->
                                                            </div><!-- End .row -->
                                                        </article><!-- End .entry -->

                                                        {{ $user_orders->links() }}
                                                        
                                                    </div><!-- End .entry-body -->
                                                </div><!-- End .col-md-8 -->
                                            </div><!-- End .row -->
                                        </article><!-- End .entry -->
                                        @endforeach

                                    </div><!-- End .container -->
                                </div>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    @foreach ($shipping_address as $address)
                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                                                <p>{{ $address->name }}<br>
                                                    {{ $address->street1 }}, {{ $address->street2 }}<br>
                                                    {{ $address->phone_number }}<br>
                                                    <!-- yourmail@mail.com<br> -->
                                                    <a href="#">Edit <i class="icon-edit"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-affiliate-program" role="tabpanel" aria-labelledby="tab-affiliate-program-link">
                                <p>Affiliate Section</p>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="#">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">

                                    <label>Email address *</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" required="">

                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2">

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@stop

@section('js')
<script>
    function logout() {
        document.getElementById("logout-form").submit();
    }
</script>
@endsection