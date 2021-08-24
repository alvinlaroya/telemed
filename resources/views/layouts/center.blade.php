<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="wyswyg-upload-image" content="{{ route('wyswyg.upload-image') }}">

    <title>{{ config('app.name', 'ABC Hospital') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        @media (max-width: 767px) {
            .table.table-striped {
                margin-top: 16px;
            }

            .table.audit-log-table {
                margin-top: 16px;
            }
        }

    </style>


    @stack('custom-styles')

    <script src="{{ asset('js/ckeditor.js') }}"></script>
</head>

<body class="center-panel">
    @include('includes.notices')
    <nav class="navbar navbar-light navbar-expand-lg flex-md-nowrap p-0 shadow">
        <div class="container-fluid">
            <a class="navbar-brand col-md-4 col-lg-2 mr-0 px-3 logo" href="{{ route('center.index') }}">
                <img id="logo" src="/images/logo-v2.png" alt="" />
            </a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
                data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <form action="" class="d-flex">
                <ul class="navbar-nav px-3 w-100 align-items-center d-flex">
                    <li class="nav-item mr-auto">
                        {{-- <h5 class="mb-0" style="color:rgba(255, 255, 255, 0.5); display: none;">{{ auth()->user()->assignedCenter->name }}</h5> --}}
                    </li>
                    <li class="nav-item text-nowrap mr-4 allow-focus" style="position:relative">
                        <a href="#" class="nav-link dropdown-toggle notificationIcon" id="notificationsMenu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right notificationDropdown pb-0"
                            data-home-url="{{ route('center.index') }}"
                            data-fetch-url="{{ route('center.notifications') }}"
                            data-read-url="{{ route('center.notification.mark') }}"
                            aria-labelledby="notificationsMenu" style="position:absolute">
                            <div class="heading">
                                <h6>Notifications</h6>
                                @if (count(auth()->user()->unreadNotifications) > 0)
                                    <a href="{{ route('center.notification.mark-all') }}" class="markAllAsRead">Mark
                                        all as read</a>
                                @endif
                            </div>
                            <div class="body"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown ml-auto p-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item font-weight-bold disabled" href="#">
                                Logged in as {{ ucfirst(auth()->user()->role) }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" style="margin-right: 10px"></i> Sign out
                            </a>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar-sticky sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('center.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('center.index') }}">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('center/bookings*') ? 'active' : '' }}"
                                href="{{ route('center.bookings') }}">
                                <i class="fas fa-hand-holding-heart"></i>
                                Services Booking
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('center/services*') ? 'active' : '' }}"
                                href="{{ route('center.servicePrices') }}">
                                <i class="fas fa-briefcase-medical"></i>
                                Services
                            </a>
                        </li>
                        <li class="nav-item children">
                            <a class="nav-link parent" href="javascript:void(0);">
                                <i class="fas fa-chart-area"></i> Reports
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('center.reports.auditlog') ? 'active' : '' }}"
                                        href="{{ route('center.reports.auditlog') }}">
                                        <i class="fas fa-clipboard-list"></i>
                                        Audit Logs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('center.reports.payments') ? 'active' : '' }}"
                                        href="{{ route('center.reports.payments') }}">
                                        <i class="fas fa-money-bill"></i>
                                        Payments
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('center.reports.transactions') ? 'active' : '' }}"
                                        href="{{ route('center.reports.transactions') }}">
                                        <i class="fas fa-user"></i>
                                        Transactions
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('center/settings*') ? 'active' : '' }}"
                                href="{{ route('center.settings') }}">
                                <i class="fas fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main id="app" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @if (Request::is('admin'))
                            <li class="active">Home</li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ route('center.index') }}">Home</a>
                            </li>
                        @endif
                        @stack('breadcrumb')
                    </ol>
                </nav>
                @yield('content')
            </main>

            @if (session()->has('success') || session()->has('error'))
                <div class="toast main-toast customToast {{ session()->has('success') ? 'success' : '' }} {{ session()->has('error') ? 'error' : '' }}"
                    role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                    <div class="toast-body">
                        @if (session()->has('success'))
                            {{ session('success') }}
                        @elseif(session()->has('error'))
                            {{ session('error') }}
                        @endif
                    </div>
                </div>
            @endif
            <div class="toast customToast success cf-v" role="alert" aria-live="assertive" aria-atomic="true"
                data-delay="5000">
                <div class="toast-body">
                    Successfully updated custom forms.
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/admin.js') }}"></script>
    <script src="{{ mix('js/center.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.rcounter.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"
        integrity="sha256-O4r2M4p1dxfVFgKvwK23D1RQdTU8ABlIBir9aGP+KJY=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <script>
        $(function() {
            if ($('.main-toast').length > 0) {
                $('.main-toast').toast('show')
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
