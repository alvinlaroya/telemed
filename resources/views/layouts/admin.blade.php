<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="wyswyg-upload-image" content="{{ route('wyswyg.upload-image') }}">

    <title>{{ config('app.name', 'MyHospital') }}</title>
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
    @stack('custom-styles')

    <script src="{{ asset('js/ckeditor.js') }}"></script>
</head>

<body class="admin-panel">
    @include('includes.notices')
    <nav class="navbar navbar-light navbar-expand-lg flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-4 col-lg-2 mr-0 px-3" href="{{ route('doctor.index') }}">
            <img id="logo" src="/images/logo-v2.png" alt="" />
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav w-100 px-3 d-flex">
            <li class="nav-item text-nowrap mr-4 d-none" style="position:relative">
                <a href="#" class="nav-link dropdown-toggle notificationIcon" id="notificationsMenu"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right notificationDropdown pb-0"
                    data-home-url="{{ route('admin.index') }}" data-fetch-url="{{ route('admin.notifications') }}"
                    data-read-url="{{ route('admin.notification.mark') }}" aria-labelledby="notificationsMenu"
                    style="position:absolute"></div>
            </li>
            {{-- <li class="nav-item text-nowrap">
                    <a class="nav-link" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Sign out</a>
                </li> --}}
            <li class="nav-item dropdown ml-auto p-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
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
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar-sticky sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('admin.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('admin.index') }}">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li> --}}


                        <li class="nav-item children">
                            <a class="nav-link parent" href="javascript:void(0);">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                                        <i class="fas fa-home"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.diagnostic') ? 'active' : '' }}" href="{{ route('admin.diagnostic') }}">
                                        <i class="fas fa-chart-bar"></i> Diagnostic
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.consultations') }}">
                                        <i class="fas fa-briefcase"></i> Consultations
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.patients.index') ? 'active' : '' }}"
                                        href="{{ route('admin.patients.index') }}">
                                        <i class="fas fa-user-injured"></i>
                                        Patients
                                    </a>
                                </li>
                            </ul>
                        </li>



                        {{-- <li class="nav-item">
                                <a class="nav-link {{ url()->current() == route('admin.servicesBooking') ? 'active' : '' }}" href="{{ route('admin.servicesBooking') }}">
                                <i class="fas fa-book"></i>
                                Services Booking
                                </a>
                            </li> --}}
                        <li class="nav-item children">
                            <a class="nav-link parent" href="javascript:void(0);">
                                <i class="fas fa-chart-area"></i> Reports
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.reports.transactions') ? 'active' : '' }}"
                                        href="{{ route('admin.reports.transactions') }}">
                                        <i class="fas fa-chart-bar"></i>
                                        Transactions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.reports.payments') ? 'active' : '' }}"
                                        href="{{ route('admin.reports.payments') }}">
                                        <i class="fas fa-money-bill"></i>
                                        Payments
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.reports.patientTransactions') ? 'active' : '' }}"
                                        href="{{ route('admin.reports.patientTransactions') }}">
                                        <i class="fas fa-user"></i>
                                        Transaction Per Patient
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item children">
                            <a class="nav-link parent" href="javascript:void(0);">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.doctors.index') ? 'active' : '' }}"
                                        href="{{ route('admin.doctors.index') }}">
                                        <i class="fas fa-user-md"></i>
                                        Doctors
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.services.index') ? 'active' : '' }}"
                                        href="{{ route('admin.services.index') }}">
                                        <i class="fas fa-briefcase-medical"></i>
                                        Services
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.service-categories.index') ? 'active' : '' }}"
                                        href="{{ route('admin.service-categories.index') }}">
                                        <i class="fas fa-notes-medical"></i>
                                        Centers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.specializations.index') ? 'active' : '' }}"
                                        href="{{ route('admin.specializations.index') }}">
                                        <i class="fas fa-briefcase"></i>
                                        Specializations
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.hmo-accreditations.index') ? 'active' : '' }}"
                                        href="{{ route('admin.hmo-accreditations.index') }}">
                                        <i class="fas fa-award"></i>
                                        HMO Accreditations
                                    </a>
                                </li>
                                @if (auth()->user()->role == \App\User::SUPERADMIN)
                                    <li class="nav-item">
                                        <a class="nav-link {{ url()->current() == route('admin.users.index') ? 'active' : '' }}"
                                            href="{{ route('admin.users.index') }}">
                                            <i class="fas fa-users"></i>
                                            Users
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.settings') ? 'active' : '' }}"
                                        href="{{ route('admin.settings') }}">
                                        <i class="fas fa-cog"></i>
                                        General Settings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.sms-notifications') ? 'active' : '' }}"
                                        href="{{ route('admin.sms-notifications') }}">
                                        <i class="fas fa-tasks"></i>
                                        SMS Notifications
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                        <a class="nav-link {{ url()->current() == route('admin.form.service') ? 'active' : '' }}" href="{{ route('admin.form.service') }}">
                                            <i class="fas fa-clipboard-list"></i>
                                            Services Forms
                                        </a>
                                    </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link {{ url()->current() == route('admin.form.doctors') ? 'active' : '' }}"
                                        href="{{ route('admin.form.doctors') }}">
                                        <i class="fas fa-user-md"></i>
                                        Doctor Forms
                                    </a>
                                </li>
                            </ul>
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
                                <a href="{{ route('admin.index') }}">Home</a>
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

    @push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
@endpush

    
</body>

</html>
