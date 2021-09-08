@extends(getLayout())
@section('title', $page->title)
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Page</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">

            <div class="container">
                <article class="entry single-entry entry-fullwidth">
                    <div class="row">
                        <div class="col-lg-11">
                            <div class="entry-body">

                                <h2 class="entry-title entry-title-big text-center">
                                    {{$page->title}}
                                </h2><!-- End .entry-title -->

                                <div class="entry-content editor-content mt-5">
                                    {!! $page->description !!}
                                </div><!-- End .entry-content -->

                            </div><!-- End .entry-body -->
                        </div><!-- End .col-lg-11 -->

                    </div><!-- End .row -->
                </article><!-- End .entry -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@stop
