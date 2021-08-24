@extends('layouts.frontpage')

@section('content')

    <div class="py-5 text-center mt-5">
        <h2 class="mb-4" style="color: red;">Please proceed to the Emergency Department or any health care facility for <br/>Covid-19 screening and care.</h2>
        {{-- <p class="lead mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> --}}

        <p class="downloadScreening mb-4" style="display:none">
            Please click the link below to download your screening form.<br/>
            <a href="#" class="btn btn-primary mt-3" target="_blank"><i class="fas fa-download mr-2"></i> Download</a>
        </p>

        <p>
            <p>Based on the information provided, we highly recommend that:</p>
            <ol class="text-left">
                <li>You consult with your Attending Physician through available means (e.g.: teleconsultation) for further assessment and evaluation; OR</li>
                <li>If you are an HMO member, contact your HMO for referral to a physician for further assessment and evaluation; OR</li>
                <li>If you do not have an Attending Physician in ABC Hospital or you are not an HMO member, you may call ABC Hospital Healthhub at 1111-2222 local 2189/2832 or email <a href="mailto:abc@hospital.com">abc@hospital.com</a> for Teleconsultation and further medical advice; OR</li>
                <li>You <b style="color:red">proceed to the Emergency Department</b> (or any healthcare facility for COVID-19 screening and care) for further assessment and evaluation especially if your <b style="color:red">symptoms are worsening or you have fever</b>;</li>
            </ol>
            <p>Please check your email for more details. (kindly check spam folders)</p>
            <p>Thank you!</p>
        </p>

        <p>For inquiries, please call +632 1111 2222 or email us at abc@hospital.com</p>
    </div>

@endsection

@push('scripts')
    <script>
        if(localStorage.getItem('appointment_patient_screening')){
            $('.downloadScreening .btn').attr('href', localStorage.getItem('appointment_patient_screening'));
            $('.downloadScreening').show();
        }
    </script>
@endpush
