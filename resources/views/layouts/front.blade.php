<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Calendar Test project</title>
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="{{ asset('front/js/ie/html5shiv.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/ie9.css') }}" />
</head>
<body>
    <div id="app">
        {{-- Body content--}}
        @yield('content')

        <!-- Footer -->
        <footer id="footer">
            <div class="copyright">
                &copy; Untitled. Design: <a href="http://templated.co/">TEMPLATED</a>.
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/skel.min.js') }}"></script>
    <script src="{{ asset('front/js/util.js') }}"></script>
    <!--[if lte IE 8]><script src="{{ asset('front/js/ie/respond.min.js') }}"></script><![endif]-->
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
