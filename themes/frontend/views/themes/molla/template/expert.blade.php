@extends(getLayout())
@section('title', 'Service Detail | Tradekunj')
@section('content')
    <div class="page-content">
        <div class="page-header text-center mb-2">
            <h1 class="page-title text">Detail</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xl-6">
                    <figure class="store-media mb-2 mb-lg-0">
                        <img src="{{$expert->image}}" alt="image" style="max-height: 35rem;min-height:35rem">
                    </figure><!-- End .store-media -->
                </div><!-- End .col-xl-6 -->
                <div class="col-sm-7 col-xl-6">
                    <div class="store-content px-4 py-4" style="height:35rem;overflow:hidden">
                        <h3 class="store-title">About {{$expert->name}}</h3><!-- End .store-title -->
                        <p>{!! $expert->description !!}</p>
                    </div><!-- End .store-content -->
                    <a href="javascript:void(0)" class="px-4 py-4" id="read-more">Read More <i class="icon-long-arrow-right"></i></a>
                </div><!-- End .col-xl-6 -->
            </div>
        </div>

        <hr>
        
        <div class="page-content pb-0 mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-2 mb-lg-0">
                        <h2 class="title mb-1 text-center">Information</h2><!-- End .title mb-2 -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="contact-info">
                                    <h3>Personal Info</h3>

                                    <ul class="contact-list">
                                        <li>
                                            <i class="icon-user"></i>
                                            {{$expert->name}}
                                        </li>
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            {{$expert->address}}, {{$expert->province}}, {{$expert->city}}
                                        </li>
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="tel:#">{{$expert->phone}}</a>
                                        </li>
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="mailto:#">{{$expert->email}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="contact-info">
                                    <h3>About Services</h3>

                                    <ul class="contact-list">
                                        <li>
                                            <i class="icon-cog"></i>
                                            <span class="text-dark">{{$expert->service->title}}</span> <br>
                                        </li>
                                        <li>
                                            <i class="icon-calendar"></i>
                                            <span class="text-dark">Service Area</span> <br>{{$expert->address}}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-4">
                            <div class="contact-info">
                                <h3>Experiences</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">Service Period</span> <br>2 years+
                                    </li>
                                </ul>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

    </div>

@endsection

@section('js')
    <script>
        
        $('#read-more').click(function(e) {
            e.stopPropagation();
            $('.store-content').css({
                'height': 'auto'
            })
        });

        $(document).click(function() {
            $('.store-content').css({
                'height': '35rem'
            })
        })


    </script>
@endsection