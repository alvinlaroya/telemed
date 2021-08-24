@extends('layouts.doctor-home')

@section('content')
    <section class="homepage-banner-section doctors-bg">
        <div class="homepage-banner container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="text header-banner">
                        <h1>My Patients. My Practice.</h1>
                        <h1>This is <span class="logo-wrap">My<span class="logo-text">Hospital.</span></span></h1>
                        <p class="tagline">
                            Quality healthcare that is accessible and convenient while providing real
                            value for money.
                        </p>
                        <hr />
                        <div class="description">
                            <p>
                                At MyHospital, healthcare gets better and easier for everyone,
                                including the ones saving lives. With our telemed services, we connect
                                you to patients, make consultations easy, and help you streamline
                                diagnostic testing and medical prescriptions. We support you and your
                                practice in scheduling, coordinating, record keeping and billing so you
                                can focus on providing quality healthcare for our patients.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="text second-header-banner">
                        <h2>Interested in reaching new patients and growing your practice?</h2>
                        <div class="description">
                            <a href="mailto:info@myhospital.ph?subject=Interested to join the MyHospital Community&body=Good day, I'm very much interested to know how MyHospital can help me grow my practice and reach potential clients.%0d%0a %0d%0aHere are my contact details:%0d%0aFull Name: %0d%0aNumber:%0d%0a %0d%0aThank you."
                                style="color: #2b9ad6" class="link-below">Contact Us</a> <span>today to join the telemed
                                revolution. Our
                                customer care representative will call and help you reach
                                new potential patients. To start, simply download our
                            </span>
                            <a href="{{ route('download.enrollment.form') }}" style="color: #2b9ad6"
                                class="link-below">Enrollment Form</a> <span>and then email a completed and signed
                                copy to
                                myhospital.admin@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="what-is-telemed">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <h1>WHAT IS THE TELEMED REVOLUTION?</h1>
                    <p class="description">
                        The COVID-19 pandemic served as a catalyst to a
                        flourishing future of healthcare. What telemed is doing is
                        increasing not just access to healthcare, but to quality
                        healthcare.
                    </p>
                    <p class="description">
                        At MyHospital, we believe that rapid telemed adoption is
                        a matter of necessity. It helps protect both vulnerable
                        frontline healthcare workers, doctors like you, so you
                        can continue caring for patients from the safety and
                        comforts of home. Telemed provides a glimmer of hope
                        and connection amidst isolation during these trying
                        times.
                    </p>
                    <p class="description">
                        Even when COVID-19 is no longer a threat, telemed will
                        be here to stay. In cities where it's becoming
                        increasingly hard to schedule health appointments,
                        telemed allows you to deliver care to more people
                        everywhere.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class=" doctor-benefits-section doctor-benefits-container">
        <div class="container doctor-benefits">
            <div class="header">
                <h1><b>JOIN MyHospital, JOIN THE TELEMED REVOLUTION</b></h1>
                <h4>At MyHospital, we help you provide accessible care to your patients
                </h4>
                <h4>through telemed. Here are the benefits.</h4>
            </div>

            <div class="benefits">
                <div class="benefit">
                    <img class="benefit-img" src="{{ asset('img/benefit-1.png') }}">
                    <div class="benefit-list">
                        <h1>Convenience</h1>

                        <ul>
                            <li>
                                We take care of your online consultations for your current and future
                                patients.
                            </li>
                            <li>
                                We coordinate telemed consultations to maximize your time and allow you to
                                see more patients.

                            </li>
                            <li>
                                We make sure your schedule, diagnostics and collection of fees are
                                organized so you spend more time with patients and less in traffic.

                            </li>
                            <li>
                                We make sure there are safety measures in place to lessen the risk of
                                exposure to communicable diseases.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="benefit">
                    <img class="benefit-img" src="{{ asset('img/benefit-2.png') }}">
                    <div class="benefit-list">
                        <h1>Better Healthcare </h1>
                        <ul>
                            <li>
                                We provide you with more exposure to practice your
                                specialties on patients.
                            </li>
                            <li>
                                We increase your census and outpatient traffic
                                referrals.
                            </li>
                            <li>
                                We give you access to patients coming from different
                                locations all over the country.
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="benefit">
                    <img class="benefit-img" src="{{ asset('img/benefit-3.png') }}">
                    <div class="benefit-list">
                        <h1>Value for Money</h1>
                        <ul>
                            <li>
                                We help you save on back end and administrative costs.
                            </li>
                            <li>
                                We provide personalized service you want and need.
                            </li>
                            <li>
                                We give you control. Control your schedule, service, rate and time. Choose which services to
                                manage your front and back end.
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>


        {{-- <div class="container">
            <div class="text-center mb-5">
                <h1>Interested in reaching new patients</h1>
                <h1> and growing your
                    practice? </h1>
            </div>
            <div class="row download-section" style="font-size: 24px;">
                <div class="col-md-5">
                    <a href="mailto:info@myhospital.ph?subject=Interested to join the MyHospital Community&body=Good day, I'm very much interested to know how MyHospital can help me grow my practice and reach potential clients.%0d%0a %0d%0aHere are my contact details:%0d%0aFull Name: %0d%0aNumber:%0d%0a %0d%0aThank you."
                        style="color: #2b9ad6" class="link-below">Contact Us</a> <span>and grow your practice. Our customer
                        care representative will call and help you
                        reach new potential patients.
                    </span>
                </div>
                <div class="col-md-2 center">
                    <div
                        style="background-color: white; height: 40px; width: 40px; text-align: center; box-shadow: 0 0 6px -2px; border-radius: 50px; margin: auto">
                        <span style="font-size: 14px; margin-bottom: -20px;">AND</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <span>Download </span> <a href="{{ route('download.enrollment.form') }}" style="color: #2b9ad6"
                        class="link-below">Enrollment Form</a> <span>then email signed and completed form to
                        myhospital.admin@gmail.com</span>
                </div>
            </div>
        </div> --}}
    </section>
    <section class="home-cards doctor-cards">
        <div class="container">
            <div class="text">
                <h1> MyHospital SERVICES FOR DOCTORS</h1>
                <p>
                    We help you serve your patients from consultation to prescriptions and follow up for the best patient
                    outcomes.
                </p>
                <p>
                    Our team also keeps you posted on your patient's activities for key information prior to
                    your follow up telemed consultation.
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 col-12">
                    <a href="{{ route('book-doctor') }}">
                        <div class="hospital-card hospital-card-consultation">
                            <img class="hospital-card-img" src="{{ asset('img/card-logo.png') }}">

                            <div class="bottom">
                                <h1><span>My</span>Doctors</h1>
                                <p>
                                    Have your telemed schedules
                                    managed for you in an efficient and
                                    convenient way. You can select your
                                    schedule and keep posted on
                                    appointments and billings.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-12">
                    <a href="{{ route('booking-service-patient') }}">
                        <div class="hospital-card hospital-card-diagnostics">
                            <img class="hospital-card-img" src="{{ asset('img/card-logo.png') }}">

                            <div class="bottom">
                                <h1><span>My</span>Lab</h1>
                                <p>
                                    Think of this as your lab to take all
                                    the necessary tests that your
                                    patients need, in a safe, efficient
                                    way.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-12">
                    <div class="hospital-card hospital-card-pharmacy">
                        <img class="hospital-card-img" src="{{ asset('img/card-logo.png') }}">

                        <div class="bottom">
                            <h1><span>My</span>Pharmacy</h1>
                            <p>
                                Your patients can now easily fulfill your
                                medical prescriptions in a timely and
                                efficient manner.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="doctor-why-choose">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <h1>
                            WHY CHOOSE MyHospital?
                        </h1>
                        <p>
                            At MyHospital, we believe that communal well-being is vital to
                            individual health. That's why we help build a healthier
                            tomorrow, together with our patients, trusted doctors, and
                            partner laboratories.
                        </p>
                        <p>
                            The MyHospital team works tirelessly to make essential
                            health services, especially COVID-related health services,
                            easier to access for everyone. MyHospital is designed to
                            change with the times -- offering nearby access,
                            science-based guidance, and affordable services to all our
                            patients.
                        </p>
                        <p>
                            Together with our doctors and partner laboratories, we're
                            imagining new ways to help Filipinos stay safe, healthy, and
                            informed whenever and wherever they are.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <h1>
                            Grow your practice today.
                        </h1>
                        <p>
                            <a href="mailto:info@myhospital.ph?subject=Interested to join the MyHospital Community&body=Good day, I'm very much interested to know how MyHospital can help me grow my practice and reach potential clients.%0d%0a %0d%0aHere are my contact details:%0d%0aFull Name: %0d%0aNumber:%0d%0a %0d%0aThank you."
                                style="color: #2b9ad6" class="link-below">Contact Us</a> to join the telemed
                            revolution. Our customer care
                            representative will call and help you
                            reach new potential patients.
                        </p>
                        <p>To start, simply download our <a href="{{ route('download.enrollment.form') }}"
                                style="color: #2b9ad6" class="link-below">Enrollment Form</a> and then email a completed and
                            signed copy to
                            myhospital.admin@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
