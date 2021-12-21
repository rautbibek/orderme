@extends(getLayout())
@section('title', 'User | Tradekunj')
@section('content')
    <main class="main">

    <div class="container" style="height: 80vh">
        <div id="__tradekunj.frontend__" ></div>
{{--        <p>under maintenance</p>--}}
{{--        <p><a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--              onclick="event.preventDefault();--}}
{{--                                             document.getElementById('logout-form').submit();">--}}
{{--                {{ __('Logout') }}--}}
{{--            </a>--}}

{{--        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--            @csrf--}}
{{--        </form></p>--}}
    </div>
    </main><!-- End .main -->
@stop
