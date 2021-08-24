{{-- LAYOUT FOR MEDICAL SERVICES --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="wyswyg-upload-image" content="{{ route('wyswyg.upload-image') }}">

    <title>{{ config('app.name', 'ABC Hospital') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.jpg') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @stack('custom-styles')
    @livewireStyles
    <!-- Styles -->
    @stack('styles')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
</head>

<body class="doctor-panel">
    @include('includes.notices')
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark flex-md-nowrap p-0 shadow">
        <div class="container-fluid">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ route('doctor.index') }}"
                style="margin-left: -10px">
                <span class="logo">
                    <h5>MYHOSPITAL</h5>
                </span>
            </a>

            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
                data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}


            <div action="" class="d-flex">
                <ul class="navbar-nav w-100 px-3">
                    <li class="nav-item text-nowrap mr-4" style="position:relative; margin-top: 8px">
                        <a href="#" class="nav-link dropdown-toggle notificationIcon" id="notificationsMenu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right notificationDropdown pb-0"
                            data-home-url="{{ route('doctor.index') }}"
                            data-fetch-url="{{ route('doctor.notifications') }}"
                            data-read-url="{{ route('doctor.notification.mark') }}"
                            aria-labelledby="notificationsMenu" style="position:absolute"></div>
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
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>



    <div class="container-fluid">

        <div class="row">

            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar-sticky sidebar collapse">

                <div class="position-sticky">

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('medical.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('medical.index') }}">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('medical-services/doctors*') ? 'active' : '' }}"
                                href="{{ route('medical.doctors') }}">
                                <i class="fas fa-user-md"></i>
                                Doctors
                            </a>
                        </li>
                    </ul>

                </div>

            </nav>

            <main id="app" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mb-5">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @if (Request::is('medical-services'))
                            <li class="active">Home</li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ route('medical.index') }}">Home</a>
                            </li>
                        @endif
                        @stack('breadcrumb')
                    </ol>
                </nav>

                @yield('content')

            </main>

            <div class="modal eventModal fade" id="eventModal" tabindex="-1" role="dialog"
                aria-labelledby="eventModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header pb-1">
                            <h5 class="modal-title" id="eventModalTitle"><span class="name"></span>'s Appointment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mt-0">
                            <span class="content"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                            <a href="#" type="button" class="btn btn-primary view-url">View Details</a>
                        </div>
                    </div>
                </div>
            </div>


            @if (session()->has('success') || session()->has('error'))
                <div class="toast customToast {{ session()->has('success') ? 'success' : '' }} {{ session()->has('error') ? 'error' : '' }}"
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


        </div>

    </div>

    {{-- temp. nandito schedule vue --}}
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"
        integrity="sha256-O4r2M4p1dxfVFgKvwK23D1RQdTU8ABlIBir9aGP+KJY=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <script>
        $(function() {
            if ($('.toast').length > 0) {
                $('.toast').toast('show')
            }
        });
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
