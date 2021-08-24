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
    <link href='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css' rel='stylesheet' />
    <link href="{{ mix('css/doctor.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <style>
        @media (max-width: 767px) {
            .table.table-striped {
                margin-top: 16px;
            }
        }

        #app {
            position: relative;
        }

        .timeContext {
            left: 50% !important;
            top: 50% !important;
            transform: translate(-50%, -50%);
        }

    </style>

    @stack('custom-styles')

    <script src="https://cdn.jsdelivr.net/npm/moment@2.25.3/moment.min.js"></script>
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@4.4.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>
</head>

<body class="doctor-panel">
    @include('includes.notices')
    <nav class="navbar navbar-light navbar-expand-lg flex-md-nowrap p-0 shadow">

        <a class="navbar-brand col-md-4 col-lg-2 mr-0 px-3" href="{{ route('doctor.index') }}">
            <img id="logo" src="/images/logo-v2.png" alt="" />
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}

        <ul class="navbar-nav w-100 px-3">

            <li class="nav-item mr-auto"></li>
            <li class="nav-item text-nowrap mr-4 allow-focus" style="position:relative">
                <a href="#" class="nav-link dropdown-toggle notificationIcon" id="notificationsMenu"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right notificationDropdown pb-0"
                    data-home-url="{{ route('doctor.index') }}"
                    data-fetch-url="{{ route('doctor.notifications') }}"
                    data-read-url="{{ route('doctor.notification.mark') }}" aria-labelledby="notificationsMenu"
                    style="position:absolute">
                    <div class="heading">
                        <h6>Notifications</h6>
                        @if (count(auth()->user()->unreadNotifications) > 0)
                            <a href="{{ route('doctor.notification.mark-all') }}" class="markAllAsRead">Mark all as
                                read</a>
                        @endif
                    </div>
                    <div class="body"></div>
                </div>
            </li>
            <li class="nav-item dropdown" style="margin-left: -15px">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item font-weight-bold disabled" href="#">
                        Logged in as {{ ucfirst(auth()->user()->role) }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                        href="{{ route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'edit',
]) }}">
                        <i class="fas fa-user" style="margin-right: 10px"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt" style="margin-right: 10px"></i> Sign out
                    </a>
                </div>
            </li>
            {{-- <li class="nav-item text-nowrap">
		      <a class="nav-link" href="#" onclick="event.preventDefault();
	                document.getElementById('logout-form').submit();">Sign out</a>
		    </li> --}}
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
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('doctor.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('doctor.index') }}">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('doctor.schedule') ? 'active' : '' }}"
                                href="{{ route('doctor.schedule') }}">
                                <i class="fas fa-calendar"></i>
                                Schedule
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('doctor.calendar') ? 'active' : '' }}"
                                href="{{ route('doctor.calendar') }}">
                                <i class="fas fa-calendar-alt"></i>
                                Calendar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('doctor.appointments') || strpos(url()->current(), 'appointments') ? 'active' : '' }}"
                                href="{{ route('doctor.appointments') }}">
                                <i class="fas fa-briefcase"></i>
                                Appointments
                            </a>
                        </li>
                        @if (!auth()->user()->isSecretary())
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current() == route('doctor.users.index') ? 'active' : '' }}"
                                    href="{{ route('doctor.users.index') }}">
                                    <i class="fas fa-users"></i>
                                    Users
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() ==
route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'edit',
])
    ? 'active'
    : '' }}"
                                href="{{ route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'edit',
]) }}">
                                <i class="fas fa-user-md"></i>
                                {{ auth()->user()->isSecretary()
    ? "Doctor's Profile"
    : 'My Profile' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() ==
route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'settings',
])
    ? 'active'
    : '' }}"
                                href="{{ route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'settings',
]) }}">
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
                        @if (Request::is('doctor'))
                            <li class="active">Home</li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ route('doctor.index') }}">Home</a>
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
                            <h5 class="modal-title" id="eventModalTitle"><span class="name"></span></h5>
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

            @if (auth()->user()->isDoctor() &&
    !auth()->user()->agreed_to_terms)
                @include('doctor.terms-and-conditions-modal')
            @endif

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
    <script src="{{ mix('js/admin.js') }}"></script>

    <script src="{{ mix('js/doctor.js') }}"></script>
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

            @if (auth()->user()->isDoctor() &&
                !auth()->user()->agreed_to_terms)
                $('#termsAndConditionModal').modal({
                show: true,
                keyboard: false,
                backdrop: "static"
                })
            
                $('#btnAgreeAndContinue').on('click', function(){
                $.ajax({
                url: '{{ route('doctor.terms-and-conditions.agree') }}',
                method: 'post',
                dataType: 'json',
                data: {
                _token: $('meta[name=csrf-token]').attr('content')
                },
                success: function(response) {
                if(response.status == 200) {
                $('#termsAndConditionModal').modal('hide')
                }
                },
                error: function(response) {
                alert('Something went wrong, please try to refresh the page.')
                }
                })
                });
            @endif

        });
    </script>
    @stack('scripts')

    @php
        $currentDoctor = auth()
            ->user()
            ->isSecretary()
            ? auth()->user()->assignedDoctor
            : auth()->user()->doctor;
        $needsUpdate = false;
        if (empty($currentDoctor->consultation_fee) || empty($currentDoctor->consultation_duration)) {
            $needsUpdate = true;
        }
    @endphp
    @if ($needsUpdate == true)
        <div class="modal noticeModal fade" id="noticeModal"
            data-settings-url="{{ route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'settings',
]) }}"
            tabindex="-1" role="dialog" aria-labelledby="noticeModalTitle" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header pb-1">
                        <h5 class="modal-title" id="noticeModalTitle">Welcome
                            {{ auth()->user()->isSecretary()
    ? auth()->user()->name
    : auth()->user()->doctor->name }}
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">
                            Please update your settings by clicking <a
                                href="{{ route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'settings',
]) }}"><strong>here</strong></a>.<br /><br />
                            Fill-out your CONSULTATION FEE and DURATION so patients can book and appointment with you.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('doctor.profile', [
    'doctor' => auth()->user()->isSecretary()
        ? auth()->user()->assignedDoctor
        : auth()->user()->doctor,
    'type' => 'settings',
]) }}"
                            type="button" class="btn btn-success">Update Settings Now</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</body>

</html>
