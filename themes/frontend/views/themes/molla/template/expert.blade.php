@extends(getLayout())
@section('title', 'Service Detail | Tradekunj')
@section('content')
<div class="page-content">
    <div class="page-header text-center mb-2">
        <h1 class="page-title text">Detail</h1>
    </div>

    <style>
        .expert-title {
            /*Typography*/
            font: 700 4em 'Oswald', sans-serif;
            text-transform: uppercase;
            text-align: center;
            line-height: 1em;
            /*Padding and margin*/
            padding: 0;
            margin: 0 0 32px;
            border-bottom: 3px solid rgb(51 51 51);
        }

    </style>

    <div class="container">

        <div class="stores mb-4 mb-lg-5">
            <h2 class="expert-title text-center mb-3">{{ $expert->name }}</h2><!-- End .title text-center mb-2 -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="store">
                        <div class="row">
                            <div class="col-sm-4  col-xl-4">
                                <figure class="store-media mb-2 mb-lg-0">
                                    <img src="{{ $expert->image }}" alt="image">
                                </figure>
                            </div>

                            <div class="col-sm-4 col-xl-4 d-flex justify-content-center">
                                <div class="store-content">
                                    <h3 class="store-title"><i class="icon-map-marker"></i>Address</h3>
                                    <!-- End .store-title -->
                                    <address>{{ $expert->address }}, {{ $expert->province }}, {{ $expert->city }}
                                    </address>
                                    <!-- <div><a href="tel:#">+1 987-876-6543</a></div> -->

                                    <h3 class="store-title mt-1"><i class="icon-phone"></i></i>Contact</h3>
                                    <!-- End .store-title -->
                                    <address>{{ $expert->phone }}</address>

                                    <h3 class="store-title mt-1"><i class="icon-envelope"></i>Email</h3>
                                    <!-- End .store-title -->
                                    <address>{{ $expert->email }}</address>

                                </div><!-- End .store-content -->
                            </div>

                            <div class="col-sm-4 col-xl-4 d-flex justify-content-center">
                                <div class="store-content">

                                    <h3 class="store-title mt-1"><i class="icon-cog"></i>Service</h3>
                                    <!-- End .store-title -->
                                    <address>{{ $expert->service->title }}</address>

                                    <h3 class="store-title mt-1"><i class="icon-calendar"></i></i>Service Area</h3>
                                    <!-- End .store-title -->
                                    <address>{{ $expert->address }}</address>

                                    <h3 class="store-title mb-1"><i class="icon-calendar"></i></i>Experience</h3>
                                    <!-- End .store-title -->
                                    <address></address>

                                </div><!-- End .store-content -->
                            </div>

                        </div><!-- End .row -->
                    </div><!-- End .store -->
                </div><!-- End .col-lg-6 -->

            </div><!-- End .row -->

            <hr class="mt-4 mb-5">

            <div class="text-center">
                <h2 class="title">Description</h2><!-- End .title -->
                <p>{!! $expert->description !!}</p>
            </div>
        </div><!-- End .stores -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title mb-1 text-center">For any queries, contact us.</h2><!-- End .title mb-2 -->

                    <form action="#" class="contact-form mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" id="cname" placeholder="Name *" required="">
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="cemail" placeholder="Email *" required="">
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" id="cphone" placeholder="Phone">
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" class="form-control" id="csubject" placeholder="Subject">
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" required=""
                            placeholder="Message *"></textarea>

                        <button type="submit" class="btn btn-outline-primary-2 ">
                            <span>SUBMIT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-5">

        </div>
    </div>

</div>

@endsection
