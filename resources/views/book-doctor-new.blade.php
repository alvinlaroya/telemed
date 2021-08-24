@extends('layouts.home')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.date.css') }}" rel="
                                    stylesheet">
    <link href="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/themes/classic.time.css') }}" rel="
                                    stylesheet">
    @livewireStyles
@endpush

@section('content')

    @if (isset($settings) && $settings['maintenance'] == 1)
        <div class="alert alert-danger mt-5" role="alert">
            {{ $settings['notice'] }}
        </div>
    @else

        <div id="app" class="appointmentForm book-doctor-section">

            <h1 class="text-center pb-3 mb-1 text-d-blue">Schedule a Consultation</h1>
            <div class="d-flex steps mb-4">
                <div class="d-inline-flex flex-wrap mx-auto justify-content-center">
                    <div class="step step1 {{ !session()->has('step_success') ? 'active' : '' }}">
                        <span>1. Patient Details</span>
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <!-- <div class="step step2">
                                        <span>2. Screening</span>
                                        <i class="fas fa-angle-right"></i>
                                       </div> -->
                    <div class="step step3">
                        2. Search a Doctor
                        <i class="fas fa-angle-right"></i>
                    </div>
                    <div class="step step4">
                        3. Schedule
                        <i class="fas fa-angle-right"></i>
                    </div>
                    <div class="step step5 {{ session()->has('step_success') ? 'active' : '' }}">
                        4. Done
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>

            <div class=" container main mt-2 px-3 px-lg-5">
                <div class="{{ session()->has('step_success') ? 'd-none' : '' }}" id="step1">
                    @include('appointment.patient-details')
                </div>

                <!-- <div id="step2" class="d-none">
                                                @include('appointment.screening-update')
                                            </div> -->

                <div id="step3" class="d-none">
                    @livewire('doctor-search')
                </div>

                <div id="step4" class="mt-5 d-none">
                    <div class="row" id="dateTimeForm">
                        <div class="col-6 offset-2">
                            <h5 id="selectedDoctorName">{{ optional($doctor)->display_name }}</h5>
                            <p id="selectedDoctorSpec">
                                {{ optional($doctor)->specializations_formatted }}
                            </p>
                            <hr>
                            <p class="py-1ssd">Select date and time based on doctors availability</p>
                            <div class="row" id="pickadate">
                                <div class="form-group col-7">
                                    <label for="date">Date</label>
                                    <input type="text" class="form-control datepicker" id="date">
                                </div>
                                <div class="form-group col-5">
                                    <label for="time">Time</label>
                                    <input type="time" class="form-control timepicker" id="time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-7">
                                    <label for="consultationType">Type of Consultation</label>
                                    <select class="custom-select" id="consultationType">
                                        @foreach (\App\Consultation::$types as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="alert alert-primary type-alert d-none" role="alert">
                                <span class="type-only-name font-italic"></span> is the only allowed consulation type on
                                selected date and time.
                            </div>
                            <div class="alert alert-primary reliever-alert d-none" role="alert">
                                Dr. <span class="selected-doctor-name"></span> is not available on this date.
                                But a reliever doctor will be able to see you.
                            </div>
                            <hr>
                            <button class="btn btn-primary" id="submitDateTime" disabled>Submit</button>
                            <button class="btn btn-light ml-2" id="cancelDateTime">Back</button>
                        </div>
                        <div class="col-2">
                            @if ($doctor)
                                <img src="{{ $doctor->getFirstMediaUrl('avatar') }}" id="selectedDoctorImg"
                                    class="img-thumbnail" alt="...">
                            @else
                                <img src="https://place-hold.it/200x200" id="selectedDoctorImg" class="img-thumbnail"
                                    alt="...">
                            @endif
                        </div>
                    </div>
                </div>

                {{-- @if (session()->has('step_success')) --}}
                <div id="step5" class="mt-5 d-none">
                    <div class="alert alert-success text-center" role="alert">
                        <h2 class="mb-3">Your appointment has been submitted.</h2>
                        <p>Please wait for the payment instructions.</p>
                        <p class="mt-4">Appointment Details:</p>
                        <ul class="appointmentDetails pl-0" style="list-style:none">
                            <li><strong>Reference #:</strong> <span class="refno"></span></li>
                            <li><strong>Type of Consultation:</strong> <span class="type"></span></li>
                            <li><strong>Name:</strong> <span class="name"></span></li>
                            <li><strong>Date & Time:</strong> <span class="date"></span></li>
                        </ul>
                    </div>
                    <p class="text-center mt-5">
                        <a href="{{ route('book-doctor') }}" class="btn btn-primary">
                            Book another Appointment
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-primary ml-2">
                            Go back Home
                        </a>
                    </p>
                </div>
                {{-- @endif --}}
            </div>

        </div>

    @endif

@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.date.js') }}"></script>
    <script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.time.js') }}"></script>
    <script>
        let currStep = 'step1';
        let sessDoctor = {{ session()->has('doctor') ? 1 : 0 }};
        document.addEventListener("livewire:load", function(event) {
            const dtForm = document.getElementById('dateTimeForm');

            if ($('input[name=authenticated]').val() == 'logged_in') {
                console.log('asfdaf');
                enableStep('step3');
            }

            @if (session()->has('doctor'))
                // setTimeout(() => {
                // enableStep('step4')
                // window.livewire.emitTo('doctor-search', 'resetDate')
                // })
            @endif

            const submit = document.getElementById('submitDateTime');
            submit.addEventListener('click', event => {
                let data = {
                    date: picker.get('value'),
                    time: timePicker.get('value')
                };
                window.livewire.emitTo('book-doctor', 'dateTimeSelected', data)
                // dtForm.classList.add("d-none");
                // enableStep('step3')
                let form = $("#patientForm");
                submitPatientForm(form);
            });
            const cancel = document.getElementById('cancelDateTime');
            cancel.addEventListener('click', event => {
                picker.clear()
                timePicker.clear()
                window.livewire.emitTo('doctor-search', 'clearSelected')
                submit.setAttribute("disabled", "disabled");
                // dtForm.classList.add("d-none");
                enableStep('step3')
            });

            const cType = document.getElementById('consultationType');
            cType.addEventListener('change', (e) => {
                let val = cType.options[cType.selectedIndex].value;
                window.livewire.emitTo('book-doctor', 'typeSelected', val)
                $("#typeInput").val(val);
            });

            let $input = $('.datepicker').pickadate({
                disable: [true]
            })
            let picker = $input.pickadate('picker')
            picker.on('close', function() {
                let dateVal = picker.get('value');
                window.livewire.emit('dateSelected', dateVal)
                $("#dateInput").val(picker.get('value'));
                if (!dateVal) {
                    submit.setAttribute("disabled", "disabled");
                }
            })

            let $timePicker = $('.timepicker').pickatime({
                interval: 5,
                // disable: [true]
            });

            let timePicker = $timePicker.pickatime('picker');

            timePicker.on('close', function() {
                let timeSelected = timePicker.get('value')
                $("#timeInput").val(timePicker.get('value'));
                if (timeSelected) {
                    window.livewire.emitTo('doctor-search', 'timeSelected', timeSelected)
                    submit.removeAttribute("disabled");
                }
            })

            window.livewire.on('timeSelectedData', data => {
                toggleReliever(data.reliever);
                enableConsultationType(data.sched_type);
            })

            window.livewire.hook('afterDomUpdate', () => {
                console.log('afterDomUpdate');
            });
            window.livewire.on('datePickerData', data => {
                console.log('datePickerData', data)
                enableStep('step4')
                let enable = data.dates;
                enable.unshift(true)
                picker.clear()
                picker.set('disable', true)
                picker.set('disable', enable)
                timePicker.set('interval', Number(data.minsInterval))
                // dtForm.classList.remove("d-none");
                // picker.set('disable', data.date)
            })

            window.livewire.on('doctorSelected', data => {
                $("#doctorInput").val(data.id);
                document.getElementById('selectedDoctorImg').src = data.img;
                document.getElementById('selectedDoctorName').innerHTML = data.name;
                document.querySelector('.selected-doctor-name').innerHTML = data.full_name;
                document.getElementById('selectedDoctorSpec').innerHTML = data.specializations;
            });

            window.livewire.on('enableTime', data => {
                let enable = data.enable
                let disabledTimes = data.disable
                enable.unshift(true)
                // timePicker.clear()
                // timePicker.set('min', data.min)
                // timePicker.set('max', data.max)
                // timePicker.set('disable', true)
                // timePicker.set('disable', disable)
                timePicker.set({
                    min: data.min,
                    max: data.max
                })

                let disabledTimesFormatted = []

                for (let disabledCount = 0; disabledCount < disabledTimes.length; disabledCount++) {
                    let currentTime = disabledTimes[disabledCount]
                    disabledTimesFormatted.push(
                        new Date(
                            currentTime[0],
                            currentTime[1],
                            currentTime[2],
                            currentTime[3]
                        )
                    )
                }

                timePicker.clear()
                timePicker.set('enable', true) // It refreshes the timePicker (or enables all the time)
                timePicker.set('disable', disabledTimesFormatted)

                submit.setAttribute("disabled", "disabled")
                toggleReliever(data.reliever)
                enableConsultationType();
            })

            window.livewire.on('enableStep', step => {
                enableStep(step);
            });

        })

        let relieverAlert = document.querySelector('.reliever-alert');

        function toggleReliever(show) {
            if (show) {
                relieverAlert.classList.remove("d-none");
            } else {
                relieverAlert.classList.add("d-none");
            }
        }

        const cTypeSelect = document.getElementById('consultationType');
        const typeAlert = document.querySelector('.type-alert');

        function enableConsultationType(type = null) {
            if (type) {
                cTypeSelect.value = type;
                cTypeSelect.setAttribute("disabled", "disabled")
                let typeText = cTypeSelect.options[cTypeSelect.selectedIndex].text
                document.querySelector('.type-only-name').innerHTML = typeText
                typeAlert.classList.remove("d-none")
            } else {
                typeAlert.classList.add("d-none")
                cTypeSelect.removeAttribute("disabled")
            }
        }

        function enableStep(step) {
            console.log(sessDoctor);
            if (step == 'step3' && sessDoctor) {
                sessDoctor = false;
                setTimeout(() => {
                    enableStep('step4')
                    window.livewire.emitTo('doctor-search', 'resetDate')
                })
                return;
            }

            let cssClass = '.' + step;
            if ($(cssClass).length) {
                const curr = $('.' + currStep)
                curr.removeClass('active')
                curr.find('i').removeClass('fa-check-circle').addClass('fa-angle-right')
                const next = $(cssClass)
                next.addClass('active')
                next.find('i').removeClass('fa-angle-right').addClass('fa-check-circle')
            }

            if ($('#' + currStep).length) {
                $('#' + currStep).addClass('d-none')
            }

            let id = '#' + step;
            if ($(id).length) {
                $(id).removeClass('d-none')
            }
            currStep = step;

            // if (step == 'step3') {
            // 	togglePForm()
            // }
        }

        function togglePForm(show = true) {
            let pForm = document.getElementById('step1Form');
            if (show) {
                pForm.classList.remove("d-none");
            } else {
                pForm.classList.add("d-none");
            }
        }

        // const cancelPForm = document.getElementById('cancelPForm');
        // cancelPForm.addEventListener('click', event => {
        // 	togglePForm(false)
        // 	enableStep('step2')
        // });

        document.querySelector("#patientForm").addEventListener("submit", function(e) {
            e.preventDefault();
            let patientForm = $("#patientForm");

            // for email checking if it is already registered
            $.ajax({
                type: 'POST',
                url: "{{ route('appointment.check.email') }}",
                data: patientForm.serialize(),
                dataType: 'json'
            }).then(function(response) {
                if (response.message === 'Email existing') {
                    let hostname = window.location.hostname;
                    window.location = "/login";
                }
            }, function(data) {
                console.log('error', data);
            });

            setTimeout(() => {
                let form = $("#patientForm");
                if (!form.hasClass('has-validation-errors')) {
                    // submitPatientForm(form);
                    // Clear localStorage
                    localStorage.removeItem('appointment_patient_screening');
                    enableStep('step3');
                }
            }, 500)
        });

        function submitPatientForm(form) {
            form.find('button[type=submit]').prop('disabled', true);
            $('#cancelDateTime').hide();
            $('#submitDateTime').prop('disabled', true).text('Please wait...');
            // const screeningForm = $('#screeningForm');
            const patientScreeningForm = $('.patientScreeningForm');

            // file upload
            var formData = new FormData($("#patientForm")[0]);

            $.ajax({
                    type: 'POST',
                    url: form.attr("action"),
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        let type = '';
                        if (response.type == 'online') {
                            type = 'Online';
                        } else if (response.type == 'walkin') {
                            type = 'Face to Face';
                        }

                        console.log(form.attr("action"));
                        console.log(response);
                        $('.appointmentDetails .refno').text(response.reference_no);
                        $('.appointmentDetails .name').text(response.patient.first_name + ' ' + response.patient
                            .last_name);
                        $('.appointmentDetails .type').text(type);
                        $('.appointmentDetails .date').text(moment(response.date_time).format('MMM-DD-YYYY h:mma'));
                        enableStep('step5');
                        $('.appointmentDetails .typeOfConsultation').text(response.type_display);
                    },
                    error: function(data) {
                        console.log('error', data);
                    },
                    complete: function(data) {
                        form.find('button[type=submit]').prop('disabled', false);
                    }
                })
                .fail(function(xhr, status, error) {
                    console.log(xhr.responseJSON, status, error)
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    @livewireScripts
@endpush
