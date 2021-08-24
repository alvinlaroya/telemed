@extends('layouts.frontpage')

@section('content')
    <div class="py-5 text-center">
        <h1>Patient Screening Form</h1>
    </div>
    <input type="hidden" name="patient_data" value="{{ session('patient_data') ? http_build_query(session('patient_data')) : '' }}">
    <form class="patientScreeningForm" action="{{ route('booking-fallrisk-screening') }}" data-save="{{ route('save-patient-screening-update') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="introduction">
                    <h2 class="step-title">INTRODUCTION</h2>
                    <p>ABC Hospital ensures the safety of its patients, employees, visitors and the community by identifying high-risk patients and medical staff managing them accordingly.</p>
                    <p>In compliance with RA 11332 Mandatory Reporting of Notifiable Diseases and Health Events of Public Health Concern Act, it is essential that you provide truthful information about your health condition and possible exposure. The collected data indicated herein is for the purpose of contact tracing to control COVID-19 transmission. The records will be retained in ABC Hospital and will be destroyed after 30 days from the date of accomplishment, following the National Archives of the Philippines Protocol and Joint Memorandum 20-04 Series of 2020 DTI and DOLE Supplemental Guidelines on Workplace Prevention and Control of COVID-19.</p>
                    <p>Please fill-out this form at least 24 hours before your scheduled appointment. After you fill-out the form, you will receive an email confirmation detailing your next steps with a PDF copy of the Patient Screening Form. Please print or save the PDF copy and show the copy during your visit.</p>
                    <p>Validity: This screening form will be valid for five (5) days. Any symptom which may develop or any unprotected exposure within this coverage period for the Patient will automatically invalidate this initial screening session. The Patient should accomplish a new screening form.</p>
                    <strong>Reminders:</strong>
                    <ul>
                        <li>NO Patient Screening Report NO Entry</li>
                        <li>NO Mask NO Entry</li>
                        <li>NO Face Shield NO Entry (Face shield should cover the whole face, visor types are not allowed)</li>
                        <li>Allow time for thermal scanning and validation of Patient Screening Report</li>
                        <li>Observe social distancing at all times</li>
                        <li>Come Approximately 20 minutes before your procedure</li>
                        <li>Only one (1) companion is allowed per patient (with his/her own companion Screening Report)</li>
                        <li>NO Companion Screening Report NO Entry</li>
                    </ul>
                </div>
                <div class="companion" style="display:none">
                    <h2 class="step-title">COMPANION</h2>
                    <div class="questions">
                        <p class="question required q-block">
                            <span class="pr-2">Will you be going to ABC Hospital with a companion?</span>
                            <span class="pr-2">
                                <input type="radio" name="screening[has_companion]" id="screening[has_companion][yes]" value="Yes" required>
                                <label for="screening[has_companion][yes]">Yes</label>
                            </span>
                            <span class="pr-2">
                                <input type="radio" name="screening[has_companion]" id="screening[has_companion][no]" value="No" required>
                                <label for="screening[has_companion][no]">No</label>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="companion-details" style="display:none">
                    <h2 class="step-title">COMPANION INFORMATION</h2>
                    <p>We are STRICTLY implementing a one (1) Companion per Patient to help ensure the safety of other patients and the Community.</p>
                    <p>We appreciate your cooperation and compliance.</p>
                    <div class="forms mb-4">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6">
                                <label for="firstName" class="required">First Name</label>
                                <input type="text" name="screening[companion_details][firstname]" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lastName" class="required">Last Name</label>
                                <input type="text" name="screening[companion_details][lastname]" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-6">
                                <label for="birthdate" class="required">Date of Birth</label>
                                <input type="date" name="screening[companion_details][birthdate]" max="{{ date('Y-m-d', strtotime("-1 day")) }}" class="form-control" id="birthdate" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="question required q-block mt-3 mt-md-0">
                                    <span class="pr-2">Gender</span>
                                    <span class="pr-2">
                                        <input type="radio" name="screening[companion_details][gender]" id="screening[companion_details][gender][male]" value="Male" required>
                                        <label for="screening[companion_details][gender][male]">Male</label>
                                    </span>
                                    <span class="pr-2">
                                        <input type="radio" name="screening[companion_details][gender]" id="screening[companion_details][gender][female]" value="Female" required>
                                        <label for="screening[companion_details][gender][female]">Female</label>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="questions patient-questions" style="display:none">
                    <h2 class="step-title">PATIENT SCREENING QUESTIONNAIRE</h2>
                    <ul>
                        @include('includes.screening.list-screening')
                    </ul>
                </div>
                <div class="questions companion-questions" style="display:none">
                    <h2 class="step-title">COMPANION SCREENING QUESTIONNAIRE</h2>
                    <ul>
                        @include('includes.screening.list-screening-companion')
                    </ul>
                </div>
                <input type="hidden" name="screening[companion_details][status]" value="">
                <div class="button-wrapper">
                    <input type="hidden" id="emergencyLink" value={{ route('emergencyNotice') }}>
                    <input type="hidden" id="teleConsult" value={{ route('teleConsult') }}>
                    <button type="button" class="btn btn-secondary" id="btnBack">Back</button>
                    <button type="button" class="btnSets btn-intro btn btn-primary">Next</button>
                    <button type="button" class="btnSets btn-hasCompanion btn btn-primary" style="display:none">Next</button>
                    <button type="button" class="btnSets btn-companionDetails btn btn-primary" style="display:none">Next</button>
                    <button type="button" class="btnSets btn-patientQuestion btn btn-primary" style="display:none">Next</button>
                    <button type="button" class="btnSets btn-setOne btn btn-primary" style="display:none">Next</button>
                    <button type="button" class="btnSets btn-setTwo btn btn-primary" style="display:none">Next</button>
                    <button type="button" class="btnSets btn-setThree btn btn-primary" style="display:none">Next</button>
                    <button type="button" class="btnSets btn-setFour btn btn-primary" style="display:none">Next</button>
                </div>
            </div>
            <div class="col-12">
                @include('includes/service-text-assistance')
            </div>
        </div>
    </form>

@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
@endpush
