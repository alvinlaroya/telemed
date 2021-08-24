@extends('layouts.frontpage')

@section('content')

    <div class="py-5 text-center mt-5">
        <h2 class="mb-4" style="color: red;">Based on the initial screening, we advise you to contact your Physician and set an appointment for Teleconsultation.</h2>

        <p class="downloadScreening mb-4" style="display:none">
            Please click the link below to download your screening form.<br/>
            <a href="#" class="btn btn-primary mt-3" target="_blank"><i class="fas fa-download mr-2"></i> Download</a>
        </p>

        <p>
            <p>Based on the information provided, we highly recommend that:</p>
            <ol class="text-left">
                <li>You <b>consult with your Attending Physician</b> through available means (e.g.: <a href="{{ route('book-doctor') }}"><b>teleconsultation</b></a>) for further assessment and evaluation; OR</li>
                <li>If you are an HMO member, contact your HMO for referral to a physician for further assessment and evaluation; OR</li>
                <li>If you do not have an Attending Physician in ABC Hospital or you are not an HMO member, you may call ABC Hospital Healthhub at 1111-2222 local 2189/2832 or email <a href="mailto:abc@hospital.com">abc@hospital.com</a> for Teleconsultation and further medical advice.</li>
            </ol>
            <p>Please check your email for more details. (kindly check spam folders)</p>
            <p>Thank you!</p>
        </p>

        <p>For  inquiries, please call +632 1111 2222 or email us at abc@hospital.com</p>
    </div>

@endsection

@push('scripts')
    <script>
        if(localStorage.getItem('consult_patient_screening')){
            $('.downloadScreening .btn').attr('href', localStorage.getItem('consult_patient_screening'));
            $('.downloadScreening').show();
        }
    </script>
@endpush
