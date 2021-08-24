@component('mail::message')
@if($referralType == 'ER')
<p>Dear {{ $firstname }},</p>
<p>You are <b style="color:red">not cleared to accompany</b> the Patient for his/her appointment at ABC Hospital.</p>
<p>Based on the information provided, we highly recommend that:</p>
<ol>
    <li>You consult with your Attending Physician through available means (e.g.: teleconsultation) for further assessment and evaluation; OR</li>
    <li>If you are an HMO member, contact your HMO for referral to a physician for further assessment and evaluation; OR</li>
    <li>If you do not have an Attending Physician in ABC Hospital or you are not an HMO member, you may call ABC Hospital Healthhub at 11111-222 local 1234/5678 or email <a href="mailto:abc@hospital.com">abc@hospital.com</a> for Teleconsultation and further medical advice; OR</li>
    <li>You <b style="color:red">proceed to the Emergency Department</b> (or any healthcare facility for COVID-19 screening and care) for further assessment and evaluation especially if your <b style="color:red">symptoms are worsening or you have fever</b>;</li>
</ol>
<p>Please bring a printed copy or saved copy of the Companion Screening Form attached in this email when you go to the Emergency Department or share this screening form with your Physician when you schedule a Teleconsultation appointment.</p>
<p>If you need to purchase your medicines, call ABC Hospital to have your medicines delivered to your home. Contact ABC Hospital at 09991234567 or send a message thru viber at 0999-123-4567. You may also place your orders online at <a href="//www.abchospital.com.ph">www.abchospital.com.ph</a></p>
<p>For inquiries, you may call 09991234567.</p>
@elseif($referralType == 'Teleconsult')
<p>Dear {{ $firstname }},</p>
<p>You are <b style="color:#3869d4">not cleared to accompany</b> the Patient for his/her appointment at ABC Hospital.</p>
<p>Based on the information provided, we highly recommend that:</p>
<ol>
    <li>You <b style="color:#3869d4">consult with your Attending Physician</b> through available means (e.g.: <a href="{{ route('book-doctor') }}"><b>teleconsultation</b></a>) for further assessment and evaluation; OR</li>
    <li>If you are an HMO member, contact your HMO for referral to a physician for further assessment and evaluation; OR</li>
    <li>If you do not have an Attending Physician in ABC Hospital or you are not an HMO member, you may call ABC Hospital Healthhub at 11111-222 local 1234/5678 or email <a href="mailto:abc@hospital.com">abc@hospital.com</a> for Teleconsultation and further medical advice.</li>
</ol>
<p>Please save a copy of the Companion Screening Form attached in this email and share this screening form with your Physician when you schedule a Teleconsultation appointment.</p>
<p>If you need to purchase your medicines, call ABC Hospital to have your medicines delivered to your home. Contact ABC Hospital at 09991234567 or send a message thru viber at 0999-123-4567. You may also place your orders online at <a href="//www.abchospital.com.ph">www.abchospital.com.ph</a></p>
<p>For inquiries, you may call 09991234567.</p>
@else
<p>Hi {{ $firstname }},</p>
<p>Your screening record has been generated.</p>
<p>Please download and/or print the attached PDF file and present it when you visit our facility.</p>
<p>For inquiries, you may call 09991234567.</p>
@endif

<p>Thank you and stay safe!</p>
{{ config('app.name') }}
@endcomponent
