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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
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

        .avatar {
            vertical-align: middle;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            margin-left: 20px;
            margin-top: 4px;
        }

        /*  .dropdown-toggle::after {
            display:none;
        } */
        #form1:hover {
            filter: drop-shadow(0px 1px 4px #000000);
            transition: .1s ease;
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.25.3/moment.min.js"></script>
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@4.4.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>
</head>

<body class="patient-panel">
    <nav class="navbar navbar-expand-lg flex-md-nowrap p-0 shadow">

        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ route('patient.index') }}">
            <img src="/images/logo-v2.png" style="width: 250px;" alt="">
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}

        <ul class="navbar-nav w-100 px-3">

            <li class="nav-item mr-auto">
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
            <li style="margin-right: 20px">
                <img src="https://icon-library.com/images/user-icon-image/user-icon-image-17.jpg" alt="Avatar" class="avatar">
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

                    <ul class="nav flex-column" style="margin-top: -20px">
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() == route('patient.index') ? 'active' : '' }}" aria-current="page" href="{{ route('patient.index') }}">
                                <i class="fas fa-user-cog"></i> &nbsp;Profile
                            </a>
                        </li>
                    </ul>

                </div>

            </nav>

            <main id="app" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mb-5">
                <div style="margin-top: 30px">
                    @include('patient.forms.profile')
                </div>
            </main>

            <div class="modal eventModal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalTitle" aria-hidden="true">
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
        </div>

        <div class="modal fade" id="requiredPromptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">MYHOSPITAL</h5>
                    </div>
                    <div class="modal-body">
                        Hi {{ auth()->user()->name }} Your account still has information that needs to be completed
                        before you can proceed to dashboard.<br>
                        Please complete all of the required fields.
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-primary">Continue</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- temp. nandito schedule vue --}}
    <script src="{{ mix('js/admin.js') }}"></script>

    <script src="{{ mix('js/doctor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js" integrity="sha256-O4r2M4p1dxfVFgKvwK23D1RQdTU8ABlIBir9aGP+KJY=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <script>
        $(function() {
            if ($('.toast').length > 0) {
                $('.toast').toast('show')
            }

            $('#requiredPromptModal').modal('show')
        });

    </script>
    @stack('scripts')
</body>

</html>
