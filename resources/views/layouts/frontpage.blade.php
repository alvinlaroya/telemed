<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyHospital') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- cookiealert styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}">
    <link href="{{ mix('css/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/nis5ieo.css">
    <!-- Custom styles for this template -->
    {{-- <link href="pricing.css" rel="stylesheet"> --}}

    @stack('styles')
    <style>
        .modal-p {
            font-size: 15px;
        }

    </style>
</head>

<body>
    @include('includes.notices')
    <header>
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img id="logo" src="/images/logo-v2.png" alt="" />
                </a>
            </div>
            <div class="nav-links">
                <ul>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Menu</a></li>
                </ul>
            </div>
        </div>
    </header>
    <section id=main>
        <div class="container" id="app">
            @yield('content')
        </div>

    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="footer-nav">
                        <p>Pages</p>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-nav">
                        <p>Contact Us</p>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8"></div>
            </div>
        </div>
    </footer>

    <!-- START Bootstrap-Cookie-Alert -->
    <div class="alert text-center cookiealert" role="alert">
        <span>We use cookies to improve your browsing experience. Continuing to use this site means you agree to our <a
                href="{{ route('privacyPolicy') }}">privacy policy</a> and <a href="{{ route('termsOfUse') }}">terms
                of
                use</a>.</span>

        <button type="button" class="btn btn-primary btn-sm acceptcookies">
            OK
        </button>
    </div>
    <!-- END Bootstrap-Cookie-Alert -->
    @env('local')
    <script src="http://localhost:35729/livereload.js"></script>
    @endenv
</body>

<!-- Scripts -->
<script src="{{ asset('js/intTel/intlTelInput.min.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"
integrity="sha256-O4r2M4p1dxfVFgKvwK23D1RQdTU8ABlIBir9aGP+KJY=" crossorigin="anonymous"></script>
<!-- Include cookiealert script -->
<script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>
@stack('scripts')

</html>
