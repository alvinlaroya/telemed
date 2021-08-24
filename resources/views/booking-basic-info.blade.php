@extends('layouts.home')

@section('content')
@if(isset($settings) && $settings['maintenance'] == 1)
<div class="alert alert-danger mt-5" role="alert">
    {{ $settings['notice'] }}
</div>
@else

@include('form-notification')
<div class="homepage-banner-section">
    <div class="py-5 text-center">
        <h2>Appointment Scheduling</h2>
    </div>
    <div class="container">

        <div class="row ">
            <div class="col-12">
                <h4>Basic Information</h4>
                <span class="extras">Please provide your correct information. This will be used for your registration.</span>
                <form action="{{ route('booking-service-screening') }}" method="POST" class="needs-validation mt-3" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row basicForms">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="firstName" class="required">First Name</label>
                                    @if(isset($settings['user']['patient']))
                                    <input type="text" name="firstname" class="form-control" id="firstName" placeholder="" value="{{ $settings['user']['patient']['first_name'] }}" required>
                                    @else
                                    <input type="text" name="firstname" class="form-control" id="firstName" placeholder="" value="" required>
                                    @endif
                                    <div class="invalid-feedback">First name is required.</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="lastName" class="required">Last Name</label>
                                    @if(isset($settings['user']['patient']))
                                    <input type="text" name="lastname" class="form-control" id="lastName" placeholder="" value="{{ $settings['user']['patient']['last_name'] }}" required>
                                    @else
                                    <input type="text" name="lastname" class="form-control" id="lastName" placeholder="" value="" required>
                                    @endif
                                    <div class="invalid-feedback">Last name is required.</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    @php
                                    if (isset($settings['user']['patient'])) {
                                    $mobile = $settings['user']['patient'] ? substr($settings['user']['patient']['mobile'], 3) : '';
                                    } else {
                                    $mobile = "";
                                    }
                                    @endphp
                                    <label for="mobile" class="required">Mobile</label><br />
                                    <input type="text" name="mobile" class="form-control int-phone" id="mobile" placeholder="" value="{{ $mobile }}" required>
                                    <div class="invalid-feedback">Valid mobile number is required.</div>
                                    <span id="phone-valid-msg" class="valid-fb d-none">✓ Valid</span>
                                    <span id="phone-error-msg" class="invalid-fb d-none"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="required">Email</label>
                                    @if($settings['user'])
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $settings['user']['email'] }}" required>
                                    @else
                                    <input type="email" name="email" class="form-control" id="email" value="" required>
                                    @endif
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="password" class="required">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <div class="invalid-feedback">Please enter a valid password</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="password_confirmation" class="required">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                    <div class="invalid-feedback" id="confirm_password_error_message"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="seniorPWD" class="custom-control-input" id="seniorPWD">
                                        <label class="custom-control-label" for="seniorPWD">Check this box if you are Senior Citizen or PWD.</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 displayIDNo">
                                    <label for="idNumber">ID Number</label><span class="note">Please bring your Senior Citizen ID/PWD ID during your visit for validation.</span>
                                    <input type="text" name="idNumber" class="form-control" id="idNumber" placeholder="ID Number" value="">
                                    <div class="invalid-feedback">ID Number is required.</div>
                                </div>
                                <div class="col-md-3 mb-3 seniorPwdID">
                                    <label for="seniorPwdID">Attach Senior/PWD ID (Front)</label><span class="note">&nbsp;</span>
                                    <input type="file" name="seniorPwdID" class="form-control" id="seniorPwdID" placeholder="Senior/PWD ID" value="">
                                    <div class="invalid-feedback">File attachment is required.</div>
                                </div>
                                <div class="col-md-3 mb-3 seniorPwdIDBack">
                                    <label for="seniorPwdIDBack">Attach Senior/PWD ID (Back)</label><span class="note">&nbsp;</span>
                                    <input type="file" name="seniorPwdIDBack" class="form-control" id="seniorPwdIDBack" placeholder="Senior/PWD ID" value="">
                                    <div class="invalid-feedback">File attachment is required.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I have read and agree to the site terms of use and data privacy policy. <a href="#" data-toggle="modal" data-target="#terms-of-use">Read more</a>
                            </label>
                        </div><br>
                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="btnNext" disabled>Next</button>
                        @include('includes/service-text-assistance')
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="terms-of-use" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">TERMS AND CONDITIONS OF USE:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="font-size: 15px">
                        <h5>Prefatory</h5>
                        <p class="modal-p">E-conomy, Inc. doing business under the names and styles of “MyHospital”, “My
                            E-Hospital”, “EHospital”, and “My E-Doctor” is a private corporate entity duly
                            licensed to operate an internet-based telehealth and telemedicine services portal known
                            as “MyHospital” that is designed to offer virtual clinic and other value added services
                            including the capacity to arrange and coordinate the general health queries of the
                            portal’s users with duly licensed and skilled user PHYSICIANs who in turn have the
                            requisite expertise to answer and/or diagnose user patient medical queries and
                            dispense prescription drugs and medicines, laboratory requests, and first aid advice
                            through partner laboratories, diagnostic clinics, hospitals and pharmacies.
                        </p>
                        <p class="modal-p">
                            MyHospital is neither engaged in the practice of medicine nor is it a provider of health care and/or medical services.
                        </p>
                        <p class="modal-p">
                            The USER is under or is in need of medical care and treatment, and requires the
                            customized services of an internet-based telehealth and telemedicine services provider
                            that has the capacity to arrange, coordinate, and provide access and/or scheduled
                            appointments to PHYSICIANs who can answer and/or diagnose general health queries,
                            dispense prescriptions, laboratory requests, and first aid advice in an efficient, orderly,
                            and safe manner.
                        </p>
                        <p class="modal-p">
                            The USER has agreed to avail the services offered by MyHospital and MyHospital has agreed to provide the services to the USER.
                        </p>
                        <p class="modal-p">By using the MyHospital portal, the USER unconditionally agrees to these terms and
                            conditions which shall constitute as his Agreement with MyHospital, to wit:
                        </p>
                        <h6 class="font-weight-bold">1. MYHOSPITAL’S OBLIGATIONS AND REPRESENTATIONS</h6>
                        <ol style="list-style-type: lower-latin;">
                            <li>
                                MyHospital shall provide the USER access to its internet portal as well as to the
                                services available therein depending on the subscription package acquired by the
                                latter. The various subscription packages, its inclusive services, and prices are
                                stated herein.
                            </li>
                            <li>
                                MyHospital shall employ and utilize existing and commercially available internet
                                connectivity service for both fixed broadband and mobile internet capability to allow
                                the USER access to the former’s internet portal at any given time with the
                                exceptions of:
                                <ol>
                                    <li>
                                        scheduled offline periods for maintenance activities with proper notice given
                                        at least forty-eight (48) hours before the scheduled offline period; and
                                    </li>
                                    <li>
                                        causes beyond the control of the MyHospital such as but not limited to
                                        internet service provider failure and/or delay, fortuitous events such as “acts of
                                        god” including natural occurrences, floods, typhoons, storms, earthquakes or
                                        other cataclysmic events, and/or “acts of man” including riots, strikes, wars, civil
                                        unrest, governmental prohibitions, quarantines, robbery, theft and the like.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                MyHospital shall provide the USER with access and/or an appointment to a partner
                                Physician who is qualified and duly licensed to practice medicine in the Philippines,
                                and can answer and/or diagnose patient user general health medical queries and
                                dispense prescription drugs and medicines, laboratory requests, and first aid advice
                                through partner laboratories, diagnostic clinics, hospitals and pharmacies.
                            </li>
                            <li>
                                MyHospital shall strictly comply with the confidentiality provisions of this Agreement
                                as stated in paragraph 4 hereof.
                            </li>
                        </ol>
                        <h6 class="font-weight-bold">2. USER’S OBLIGATIONS AND REPRESENTATIONS</h6>
                        <ol style="list-style-type: lower-latin;">
                            <li>
                                The USER represents and warrants that he is at least eighteen (18) years of age and has the legal capacity to enter into contracts and agreements.
                            </li>
                            <li>
                                The USER shall provide his true and accurate personal circumstances as well as
                                information relating to his person and prior and/or existing health condition and
                                treatments, including prior or existing information on: symptoms and diagnosis;
                                and/or any form of treatment such as medical and/or surgical, alternative and/or
                                traditional medicine treatment, pediatric, maternity, dental, psychiatric, other forms of
                                treatment, and/or medical research and development activities.
                            </li>
                            <li>
                                In the event the USER is acting in a representative capacity in favor of another who
                                is incapacitated to enter into contracts and agreements, the said USER represents
                                and warrants that he is duly authorized to act as such attorney-in-fact. Upon
                                MyHospital’s request, the USER shall provide the latter proof or evidence of his
                                authority to act as representative and attorney-in-fact of his principal.
                            </li>
                            <li>
                                In the event the USER is acting in a representative capacity as referred to in the
                                immediately preceding sub-paragraph, he shall also provide the true and accurate
                                personal circumstances of his principal as well as information relating to his
                                principal’s prior and/or existing health condition and treatments, including prior or
                                existing information on: symptoms and diagnosis; and/or any form of treatment such
                                as medical and/or surgical, alternative and/or traditional medicine treatment,
                                pediatric, maternity, dental, psychiatric, other forms of treatment, and/or medical
                                research and development activities.
                            </li>
                            <li>
                                The USER agrees that the information required in the preceding sub-paragraphs
                                shall be transmitted by MyHospital to its partner physicians, laboratories, diagnostic
                                clinics, hospitals and pharmacies for processing and for the purpose of providing his
                                or his principal’s medical care and treatment.
                            </li>
                            <li>
                                The USER acknowledges that his failure to provide true, accurate, and complete
                                information to MyHospital may not be sufficient for the purposes required by the
                                referred partner Physician and may result in inaccurate medical care, diagnosis and
                                treatment.
                            </li>
                            <li>
                                The USER shall remit his payment to MyHospital, through the various commercial
                                payment portals, for the services he will avail depending on the cost of the
                                subscription package he will acquire as stated herein. In the event the USER’s
                                complete medical care and treatment will require more than the services provided in
                                his existing subscription package, the USER undertakes to purchase additional
                                subscription packages as necessary to complete the same. In the event the USER’s
                                medical care and treatment is not completed due to his failure to purchase additional
                                subscription packages, he acknowledges that MyHospital shall not be held liable.
                            </li>
                            <li>
                                The USER’s availment of MyHospital’s services shall be for his personal and non-
                                commercial use only. The USER shall use MyHospital’s services for legal purposes
                                only and in compliance with all laws, rules, and regulations.
                            </li>
                            <li>
                                The USER shall not, under any circumstance, allow a third party to use hi MyHospital account, password, and username.
                            </li>
                            <li>
                                The USER fully acknowledges and agrees that MyHospital has no participation and
                                control over the diagnosis dispensed and treatment recommended by the Physicians
                                referred to him by MyHospital who are themselves users of the MyHospital portal.
                            </li>
                            <li>
                                The USER acknowledges and agrees that MyHospital, its Board of Directors,
                                management, employees, and assigns do not dictate or impose upon the
                                Physician’s practice of medicine, delivery of direct patient care, or independent
                                judgment in the practice of medicine.
                            </li>
                            <li>
                                The USER acknowledges and agrees that MyHospital does not exercise any direct
                                control and/or supervision over his diagnosis and/or treatment as patient user of the
                                MyHospital portal.
                            </li>
                            <li>
                                The USER fully acknowledges and agrees that MyHospital has no participation and
                                control over the treatment provided by the laboratories, diagnostic clinics, and
                                hospitals referred by MyHospital.
                            </li>
                            <li>
                                The USER fully acknowledges and agrees that MyHospital has no participation and
                                control over the medicinal drugs and supplies prescribed by the Physicians and
                                dispensed by the pharmacies referred by MyHospital.
                            </li>
                            <li>
                                The USER acknowledges and agrees that MyHospital shall not be liable for any
                                error, mistake, fault or oversight arising from the Physician’s practice of medicine,
                                delivery of direct patient care, independent judgment in the practice of medicine, and
                                in the rendition of consultation and prescription services to him as user of the
                                MyHospital portal.
                            </li>
                            <li>
                                The USER shall not reverse engineer, reverse compile, reverse assemble,
                                decompile, disassemble, translate, alter, destroy, infect, tamper, hack, modify,
                                corrupt, copy or otherwise defraud MyHospital’s applications, programs, softwares,
                                codes, business model, user interface designs, user interface experience, and other
                                information technologies.
                            </li>
                            <li>
                                The USER has read and understood the terms and conditions of this Agreement and all other supplementary and amendatory agreements.
                            </li>
                            <li>
                                The USER further warrants that he has fully informed his principal as to the terms
                                and conditions of this Agreement, and that his principal has fully understood,
                                consented and accepted the same.
                            </li>
                        </ol>
                        <h6 class="font-weight-bold">3. TERM AND TERMINATION</h6>
                        <ol style="list-style-type: lower-latin;">
                            <li>
                                Term: This Agreement shall be effective upon the USER’s purchase of any of the subscription packages enumerated herein.
                            </li>
                            <li>
                                Termination.
                                By MyHospital:
                                <ol style="list-style-type: lower-roman;">
                                    <li>
                                        MyHospital may suspend the USER’s right to use its portal in the event of a
                                        material breach of any of his Obligations and Representations as stated in
                                        paragraph 2 hereof. During the term of the suspension, MyHospital shall
                                        afford the USER the right to explain, within five (5) days from receipt of a
                                        notice through the MyHospital portal, why his right to use the MyHospital
                                        portal shall not be terminated based on the alleged material breach of his
                                        Obligations and Representations.
                                    </li>
                                    <li>
                                        Within three (3) days from receipt of the USER’s explanation, MyHospital
                                        shall render its judgment on whether it will terminate the USER’s right to use
                                        its portal or reinstate the same.
                                    </li>
                                    <li>
                                        In the event MyHospital decides to terminate the USER’s right to use its portal
                                        for material breach of his Obligations and Representations under paragraph 2
                                        hereof, MyHospital shall forfeit the remaining balance of the monetary value
                                        of the USER’s existing subscription package as and by way of liquidated
                                        damages.
                                    </li>
                                </ol>
                                <p class="modal-p">By the USER: </p>
                                <ol style="list-style-type: lower-roman;">
                                    <li>
                                        In the event the USER alleges that MyHospital has committed a material
                                        breach of any of its Obligations and Representations as stated in paragraph
                                        1 hereof, MyHospital shall have a period of five (5) days within which to
                                        rectify the alleged material breach from notice made by the USER through
                                        the MyHospital portal.
                                    </li>
                                    <li>
                                        Should MyHospital fail to rectify its alleged material breach of any of its
                                        Obligations and Representations as stated in paragraph 1 hereof, the USER
                                        may terminate his contractual relationship with MyHospital.
                                    </li>
                                    <li>
                                        In the event of the USER’s termination of its contractual relationship as
                                        stated in the immediately preceding sub-paragraph, MyHospital shall refund
                                        to the USER the remaining balance of the monetary value of his existing
                                        subscription package.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                Survival: The provisions of paragraphs 4, 5, and 6 of this Agreement shall
                                survive the termination of this Agreement and remain in full force and effect
                                thereafter.
                            </li>
                        </ol>
                        <h6 class="font-weight-bold">4. CONFIDENTIAL INFORMATION</h6>
                        <p class="modal-p">
                            MyHospital and the USER mutually agree to the following confidentiality obligations:
                        </p>
                        <ol style="list-style-type: lower-latin;">
                            <li>
                                Confidential Information. As used in this Agreement, the term “Confidential
                                Information” shall mean any information or any part thereof, furnished by the USER
                                or his representatives to MyHospital relating to his person and his prior and/or
                                existing health condition and treatment. This confidential information shall include
                                prior or existing information on: symptoms and diagnosis; and/or any form of
                                treatment such as medical and/or surgical, alternative and/or traditional medicine,
                                pediatric, maternity, dental, psychiatric, other forms of treatment, and/or research
                                and development activities regardless of whether such information is specifically
                                designated as confidential and whether such information is in written, oral, electronic
                                or other form. Such information may further include personal information and
                                circumstances, patient records and history, and the like.
                            </li>
                            <li>
                                Confidentiality Obligations:
                                <ol>
                                    <li>
                                        Utilization of Confidential Information
                                        <p class="modal-p">
                                            MyHospital agrees that it shall:
                                        </p>
                                        <ol style="list-style-type: lower-roman;">
                                            <li>
                                                safeguard, keep, treat and maintain all Confidential Information in strict confidence;
                                            </li>
                                            <li>
                                                use all Confidential Information solely for the purpose intende whether expressly or impliedly stated; ; and
                                            </li>
                                            <li>
                                                strictly comply with the provisions of Republic Act No. 10173 otherwise known as “The Data Privacy Act of 2012”.
                                            </li>
                                        </ol>
                                    </li>
                                    <li>
                                        Non-Disclosure to Third Parties
                                        <p class="modal-p">
                                            MyHospital shall not, without the express consent of the USER, disclose, deliver,
                                            reproduce or make available any Confidential Information or any summaries,
                                            analysis, or other documents arising therefrom to any party as well as the
                                            existence and the content of this Agreement.
                                        </p>
                                    </li>
                                    <li>
                                        Degree of Care
                                        <p class="modal-p">
                                            MyHospital undertakes to apply to all Confidential Information disclosed in
                                            accordance with the provisions of this Agreement the same degree of care with
                                            which it treats and protects its own Confidential Information against public
                                            disclosure.
                                        </p>
                                    </li>
                                    <li>
                                        Exceptions
                                        <p class="modal-p">
                                            The confidentiality obligation of this Agreement shall not apply to information which was received by MyHospital from the USER that:
                                        </p>
                                        <ol style="list-style-type: lower-roman;">
                                            <li>
                                                was in the public domain prior to the time of its disclosure under this Agreement;
                                            </li>
                                            <li>
                                                entered the public domain after the time of its disclosure through means other than by breach of this Agreement;
                                            </li>
                                            <li>
                                                was known to MyHospital prior to the disclosure by the USER;
                                            </li>
                                            <li>
                                                was disclosed to MyHospital without restriction by a third party having the full right to disclose this information;
                                            </li>
                                            <li>
                                                was independently developed by MyHospital without use of the information disclosed under this Agreement;
                                            </li>
                                            <li>
                                                was announced by joint press statements or releases; and
                                            </li>
                                            <li>
                                                is required to be disclosed in order to comply with (a) applicable laws
                                                and regulations, including, without limitation, to Philippine legislation;
                                                and (b) an order of a Philippine court, tribunal, administrative agency,
                                                authority, or other government agency provided that the MyHospital, at
                                                the request and expense of the USER, uses reasonable efforts to limit
                                                such disclosure to the extent requested.
                                            </li>
                                        </ol>
                                    </li>
                                    <li>
                                        Consequences of Termination
                                        <p class="modal-p">
                                            In the event of the expiration or termination of this Agreement, MyHospital
                                            undertakes to automatically return to the USER all documents, memoranda, notes,
                                            photographs, copies, and all other forms of the Confidential Information disclosed in
                                            accordance with the terms and conditions of this Agreement. Confidential
                                            Information, which cannot be returned, must be automatically destroyed and
                                            MyHospital shall, upon the USER’s request, thereafter confirm in writing that such
                                            destruction was completed.
                                            The obligations hereto relating to the confidentiality and use of Confidential
                                            Information shall survive the expiration or termination of this Agreement.
                                        </p>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                Ownership
                                <p class="modal-p">
                                    MyHospital recognizes the exclusive right and title of the USER to all Confidential
                                    Information disclosed by the latter. No license or conveyance of such rights and title
                                    to MyHospital is granted or implied under this Agreement. Nothing in this Agreement
                                    shall be deemed to grant to MyHospital a license, directly or by implication, any
                                    intellectual property rights to all Confidential Information provided by the USER. If
                                    any such rights are to be granted to MyHospital, such grant shall be expressly set
                                    forth in a separate agreement.
                                </p>
                            </li>
                        </ol>
                        <h6 class="font-weight-bold">5. INTELLECTUAL PROPERTY RIGHTS</h6>
                        <ol style="list-style-type: lower-latin;">
                            <li>
                                MyHospital’s services, materials, processes, procedures, business model, trade
                                names, and trademarks are exclusively owned by E-conomy, Inc. and is protected
                                by copyright, patent, trademark, intellectual property laws, international conventions
                                and treaties.
                            </li>
                            <li>
                                The USER’s availment of the services offered by MyHospital does not grant him any
                                form of ownership or intellectual property rights over the said services, materials,
                                processes, procedures, business model, trade names, and trademarks.
                            </li>
                            <li>
                                Any commercial or promotional distribution, publishing or exploitation thereof is strictly prohibited unless expressly permitted by MyHospital.
                            </li>
                            <li>
                                E-conomy, Inc. and MyHospital reserve all rights and privileges appurtenant to the
                                aforesaid services, materials, processes, procedures, business model, trade names,
                                and trademarks that are not expressly provided under this Agreement.
                            </li>
                        </ol>
                        <h6 class="font-weight-bold">6. LIMITATION OF LIABILITY</h6>
                        <p class="modal-p">
                            E-conomy, Inc. shall not be liable to any USER of its MyHospital portal for any consequences resulting from:
                        </p>
                        <ol style="list-style-type: lower-latin;">
                            <li>
                                any modification in this Agreement including any error, permanent or
                                temporary interruption, discontinuance, suspension or other type of
                                unavailability of services;
                            </li>
                            <li>
                                deletion, corruption, or failure to store any user data including those originating from laboratories, diagnostic clinics, hospital, and pharmacies;
                            </li>
                            <li>
                                use of any USER data uploaded by user Physicians, laboratories, diagnostic clinics, hospital, and pharmacies to the MyHospital portal;
                            </li>
                            <li>
                                failure to provide true, accurate, and complete information to MyHospital that may result in inaccurate medical care, diagnosis and treatment;
                            </li>
                            <li>
                                upgrading or downgrading or cancellation of any subscription package for services availed;
                            </li>
                            <li>
                                any disclosure, loss or unauthorized use of the login credentials of the USER
                                for the use of MyHospital’s portal due to the negligence or fault of the said
                                USER;
                            </li>
                            <li>
                                the USER’s access of the MyHospital’s portal through the use of browsers other than those recommended, accepted or supported by MyHospital;
                            </li>
                            <li>
                                the variance between technologies and platforms used for access of certain
                                features, functions, features or functionalities of MyHospital’s portal that are
                                designed for use on a personal computer or laptop and do not function on a
                                mobile platform or a tablet; and
                            </li>
                            <li>
                                MyHospital’s application of any of the remedies described in these Agreement,
                                even if the reasonable grounds or legal basis for the application of these
                                remedies turns out to be thereafter unfounded or invalid.
                            </li>
                        </ol>
                        <h6 class="font-weight-bold">7. GENERAL PROVISIONS</h6>
                        <ol style="list-style-type: lower-latin;">
                            <li>
                                Entirety and Integration of Agreement. This Agreement embodies the total
                                understanding, accord, and covenant between the parties regarding the
                                subject matter and therefore cancels and supersedes all prior discussions
                                and understandings with respect to the same subject matter, whether written
                                or oral.
                            </li>
                            <li>
                                Validity and Enforceability. If any provision or part of this Agreement is held
                                unenforceable by a court of competent jurisdiction, that particular provision
                                shall be stricken off and shall not affect the validity or enforceability of the
                                remaining provisions.
                            </li>
                            <li>
                                Relationship of the Parties. This Agreement shall not be construed as
                                creating an agency, partnership, joint venture, fiduciary duty, or any other
                                legal relationship between E-conomy, Inc. doing business under the names
                                and styles of MyHospital, My E-Hospital, EHospital, and My E-Doctor, and the
                                USER. The USER shall not represent to the contrary, whether expressly, by
                                implication, appearance or otherwise.
                            </li>
                            <li>
                                Interchangeability. It is hereby understood that the use of the word “he” in this Agreement shall refer to both the male and female gender.
                            </li>
                            <li>
                                Disclaimer. The USER agrees that all services he obtains by virtue of the
                                MyHospital portal have no corresponding warranties, whether express or
                                implied. MyHospital disclaims all warranties, whether express or implied. The
                                USER’s availment of MyHospital’s services shall be at his own risk and
                                assumes full responsibility for all risks associated therewith. MyHospital does
                                not guarantee the medical services and treatments provided by its partner
                                physicians, laboratories, diagnostic clinics, hospitals, and pharmacies.
                            </li>
                            <li>
                                Indemnification. The USER unconditionally agrees to defend, indemnify, and
                                hold harmless E-conomy, Inc. doing business under the name and style of
                                MyHospital, My E-Hospital, EHospital, and My E-Doctor, its affiliates,
                                subsidiaries, Board of Directors, officers, employees, agents, and assigns
                                from any claims, losses, damages, liabilities including attorney’s fees of any
                                kind whatsoever arising directly or indirectly out of his use or misuse of the
                                MyHospital portal. MyHospital reserves its right, at its own expense, to
                                assume the exclusive defense and control of any legal matter before any
                                court, body or tribunal in any venue or jurisdiction which the USER is required
                                to defend, indemnify, and hold MyHospital as harmless from. In case
                                MyHospital assumes its exclusive defense on the matters previously stated
                                herein, the USER agrees to unconditionally cooperate with MyHospital for
                                such defense.
                            </li>
                            <li>
                                Arbitration. Any dispute, controversy, claim or disagreement arising from this
                                Agreement shall be settled by arbitration in the republic of the Philippines by a
                                panel of three (3) Philippine Dispute Resolution Center, Inc. arbitrators and in
                                accordance with its existing Arbitration Rules.
                            </li>
                            <li>
                                Venue by Agreement. The parties hereto agree that any litigation arising out
                                of this Agreement shall be filed in the courts of competent jurisdiction of
                                Quezon City to the exclusion of other courts.
                            </li>
                            <li>
                                Severability. If any one or more provisions of this Agreement shall, for any
                                reason, be held void or unenforceable, the legality or enforceability of the
                                remaining provisions shall not, in any way, be affected or impaired, and shall
                                remain in full force and effect.
                            </li>
                            <li>
                                Non-waiver. Failure of either party to insist upon the strict performance of
                                any of the terms and conditions stated in this Agreement shall not be deemed
                                as a relinquishment or waiver of any right or remedy that said Party may have
                                nor shall it be construed as a waiver of any subsequent breach or default in
                                the terms and conditions which shall continue to be in full force and effect. No
                                waiver by either party of any of their rights under this Agreement shall be
                                deemed to have been made unless expressed by all responsible parties
                                through the MyHospital portal.
                            </li>
                            <li>
                                Notices – Any notice, request or consent required or permitted to be given or
                                made pursuant to this Agreement shall be made through the MyHospital
                                portal.  Any such notice, request or consent shall be deemed to have been
                                given or made when sent by the concerned party via the MyHospital portal to
                                the other party when addressed to the following:
                                <div style="margin-left: 50px;">
                                    <p class="modal-p">
                                        E-conomy, Inc. doing business under the names and styles
                                        of MyHospital, My E-Hospital, EHospital, and My E-
                                        Doctor
                                        Attention: The General Manager
                                        USER
                                        Username:
                                        Email Address:
                                        Postal Address:
                                        Telephone/Mobile No.:
                                    </p>
                                </div>
                                Any written communication shall be transmitted by MyHospital to the USER’s email address, postal address, and/or telephone/mobile number.
                            </li>
                            <li>
                                Assignment. MyHospital may assign, or transfer its rights and obligations
                                under this Agreement or any part thereof without the USER’s express
                                approval. The USER, on the other hand, may not assign, or transfer his rights
                                and obligations under this Agreement or any part thereof.
                            </li>
                            <li>
                                Amendment and Modification. This Agreement may be amended or
                                modified by MyHospital at anytime and the USER’s continued use thereof
                                shall be deemed as his conformity to the said amendments. It is the USER’s
                                responsibility to periodically check these terms and conditions for any
                                changes and/or amendments.
                            </li>
                        </ol>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnAgreeAndContinue">Agree and Continue</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="agreeAndContinue">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@push('scripts')
<script>
    var checker = document.getElementById('flexCheckDefault');
    var sendbtn = document.getElementById('btnNext');
    var agreebtn = document.getElementById('btnAgreeAndContinue');

    checker.onchange = function() {
        sendbtn.disabled = this.checked ? false : true
    }

    agreebtn.onclick = function() {
        sendbtn.disabled = false
        checker.checked = true
    }

    // https://github.com/amsul/pickadate.js/issues/424
    // $(function() {
    //     $('.birthpicker').pickadate({
    //       selectYears: true,
    //       selectMonths: true,
    //       min: new Date(1988,3,20),
    //       max: true
    //     })
    // })

</script>
@endpush
