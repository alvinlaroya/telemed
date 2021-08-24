@extends('layouts.frontpage')

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

    <div id="app">

        <h1 class="text-center pb-3 mb-1 text-d-blue">Schedule a Consultation </h1>
        <div class="d-flex steps">
            <div class="d-inline-flex flex-wrap mx-auto">
                <div class="step step1  {{ !session()->has('step_success') ? 'active' : '' }}">
                    <span>1. Search a Doctor</span>
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="step step2">
                    <span>2. Date and Time</span>
                    <i class="fas fa-angle-right"></i>
                </div>
                <div class="step step3">
                    3. Patient Details
                    <i class="fas fa-angle-right"></i>
                </div>
                <div class="step step4 {{ session()->has('step_success') ? 'active' : '' }}">
                    4. Done
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <div class="main mt-2">
            <div id="step1" class="{{ session()->has('step_success') ? 'd-none' : '' }}">
                @livewire('doctor-search')
            </div>

            <div id="step2" class="mt-5 {{ session()->has('doctor') ?: 'd-none' }}">
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
                        <div class="alert alert-primary reliever-alert d-none" role="alert">
                            Dr. <span class="selected-doctor-name"></span> is not available on this date.
                            But a reliever doctor will be able to see you
                        </div>
                        <hr>
                        <button class="btn btn-primary" id="submitDateTime" disabled>Submit</button>
                        <button class="btn btn-light ml-2" id="cancelDateTime">Cancel</button>
                    </div>
                    <div class="col-2">
                        @if ($doctor)
                            <img src="{{ $doctor->getFirstMediaUrl('avatar') }}" id="selectedDoctorImg"
                                class="img-thumbnail" alt="...">
                        @else
                            <img src="https://place-hold.it/200x200" id="selectedDoctorImg" class="img-thumbnail" alt="...">
                        @endif
                    </div>
                </div>
            </div>

            {{-- <div id="step3">
			@livewire('book-doctor')
		</div> --}}

            <div class="d-none" id="step3Form">
                <hr>
                @include('appointment.patient-details')
            </div>

            {{-- @if (session()->has('step_success')) --}}
            <div id="step4" class="mt-5 d-none">
                <div class="alert alert-success text-center" role="alert">
                    Successfully sent booking request!
                </div>
                <p class="text-center mt-5">
                    <a href="{{ route('book-doctor') }}" class="btn btn-primary">
                        {{-- <span aria-hidden="true">&laquo;</span> --}}
                        Back to search
                    </a>
                </p>
            </div>
            {{-- @endif --}}
        </div>

        {{-- @livewire('patient-details') --}}
    </div>

@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.date.js') }}"></script>
    <script src="{{ asset('vendor/pickadate.js-3.6.2/lib/compressed/picker.time.js') }}"></script>
    <script>
        let currStep = 'step1';
        document.addEventListener("livewire:load", function(event) {
            const dtForm = document.getElementById('dateTimeForm');

            @if (session()->has('doctor'))
                setTimeout(() => {
                enableStep('step2')
                window.livewire.emitTo('doctor-search', 'resetDate')
                })
            @endif

            const submit = document.getElementById('submitDateTime');
            submit.addEventListener('click', event => {
                let data = {
                    date: picker.get('value'),
                    time: timePicker.get('value')
                };
                window.livewire.emitTo('book-doctor', 'dateTimeSelected', data)
                // dtForm.classList.add("d-none");
                enableStep('step3')
            });
            const cancel = document.getElementById('cancelDateTime');
            cancel.addEventListener('click', event => {
                picker.clear()
                timePicker.clear()
                window.livewire.emitTo('doctor-search', 'clearSelected')
                submit.setAttribute("disabled", "disabled");
                // dtForm.classList.add("d-none");
                enableStep('step1')
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
                disable: [true]
            });
            let timePicker = $timePicker.pickatime('picker');
            timePicker.on('close', function() {
                let timeSelected = timePicker.get('value')
                $("#timeInput").val(timePicker.get('value'));
                if (timeSelected) {
                    // window.livewire.emitTo('doctor-search', 'timeSelected', timeSelected)
                    submit.removeAttribute("disabled");
                }
            })

            window.livewire.on('toggleReliever', show => {
                toggleReliever(show)
            })

            window.livewire.hook('afterDomUpdate', () => {
                console.log('afterDomUpdate');
            });
            window.livewire.on('datePickerData', data => {
                console.log('datePickerData', data)
                enableStep('step2')
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
                console.log('enableTime', data)
                let enable = data.enable
                enable.unshift(true)
                timePicker.clear()
                timePicker.set('min', data.min)
                timePicker.set('max', data.max)
                timePicker.set('disable', true)
                timePicker.set('disable', enable)
                submit.setAttribute("disabled", "disabled")
                toggleReliever(data.reliever)
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

        function enableStep(step) {
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

            if (step == 'step3') {
                togglePForm()
            }
        }

        function togglePForm(show = true) {
            let pForm = document.getElementById('step3Form');
            if (show) {
                pForm.classList.remove("d-none");
            } else {
                pForm.classList.add("d-none");
            }
        }

        const cancelPForm = document.getElementById('cancelPForm');
        cancelPForm.addEventListener('click', event => {
            togglePForm(false)
            enableStep('step2')
        });

        document.querySelector("#patientForm").addEventListener("submit", function(e) {
            e.preventDefault();
            setTimeout(() => {
                let form = $("#patientForm");
                if (!form.hasClass('has-validation-errors')) {
                    submitPatientForm(form);
                }
            }, 500)
        });

        function submitPatientForm(form) {
            form.find('button[type=submit]').prop('disabled', true);
            $.ajax({
                    type: 'POST',
                    url: form.attr("action"),
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response)
                        togglePForm(false)
                        enableStep('step4')
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
