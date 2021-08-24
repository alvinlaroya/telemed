@extends('layouts.home')

@section('content')
    <section class="homepage-banner-section home-bg">
        <div class="container homepage-banner">
            <div class="text">
                <h1>My Health. My Choice</h1>

                <h1>This is <span class="logo-wrap">My<span class="logo-text">Hospital</span></span></h1>
                <p class="tagline">Quality healthcare that is <b>accessible</b> and <b>convenient</b> while
                    providing real <b>value for money</b>.</p>
                <hr />
                <div class="description">
                    <p>
                        Enter a new era in healthcare with MyHospital, where we
                        transform everyone’s access to healthcare. Get access to
                        quality healthcare by phone or video call, wherever you are
                        in the Philippines. We also offer on-the-go testing and other
                        essential COVID-19 health services, helping you and your
                        family stay safe amidst the pandemic.
                    </p>
                    <p>
                        At MyHospital, we strive to provide accessibility to the best
                        medical care possible. We collaborate with doctors,
                        diagnostic clinics, hospitals, and pharmacies for a more
                        centered healthcare focused on you.
                    </p>
                </div>
            </div>


        </div>
    </section>
    <section class="home-cards">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-12">
                    <a href="{{ route('book-doctor') }}">
                        <div class="hospital-card hospital-card-consultation">
                            <img class="hospital-card-img" src="{{ asset('img/card-logo.png') }}">

                            <div class="bottom">
                                <h1><span>My</span>Doctors</h1>
                                <p>
                                    Need a consultation?
                                    MyHospital has you covered.
                                    Get direct access to our
                                    knowledgeable, kind, and
                                    compassionate doctors anytime
                                    and anywhere.
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
                                    Tests required?
                                    MyHospital has partnered
                                    with leading laboratories
                                    and diagnostic centers to
                                    provide fast and efficient
                                    test results during these
                                    trying times.
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
                                Worried about lining up and
                                buying your own medication?
                                With our partner pharmacies,
                                MyHospital will make sure your
                                medicine is delivered fresh and
                                fast at your doorstep.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="special-services">
        <div class="container">
            <div class="row">
                <div class="col-md-1"> </div>

                <div class="col-md-3 col-12">
                    <div class="my-hospital"><span class="logo-wrap">My<span class="logo-text">Hospital</span></div>
                    <a href="{{ route('covid-home') }}">
                        <div class="-my-covid-care img-fluid d-flex flex-column justify-content-between">
                            <div class="middle">
                                <p>COVID-19<br>
                                    Tuberculosis(TB)<br>
                                    Tele and Home Care
                                </p>
                            </div>
                        </div>
                    </a>
                    {{-- <a href="{{ route('covid-home') }}">
                <div class="special-service-link">
                    Tuberculosis(TB)
                </div>
                </a>
                <a href="{{ route('covid-home') }}">
                    <div class="special-service-link">
                        Tele and Home Care
                    </div>
                </a> --}}
                </div>
                <div class="col-md-6 col-12">
                    <h1 class="title">Covid Care Specialty Center</h1>

                    <div class="row ellipse-text-container">
                        <ul>
                            <li>
                                <p class="text">
                                    We aim to provide both patients and doctors
                                    experience in handling mild and asymptomatic cases of
                                    COVID-19.
                                </p>
                            </li>
                            <li>
                                <p class="text">
                                    We coordinate with doctors to set up tele consultations
                                    or home visits and diagnostic tests. All test results will
                                    be sent to both patients and doctors to ensure smooth
                                    consultations focused on providing the best quality
                                    care.
                                </p>
                            </li>
                            <li>
                                <p class="text">
                                    MyHospital offers affordable packages for each type of
                                    COVID-related issue with easy and convenient fees
                                    collection.
                                </p>
                            </li>
                            <li>
                                <p class="text">
                                    We maximize your schedule by coordinating with the
                                    laboratories and diagnostic centers nearest to your
                                    location. This is to minimize traffic and maximize
                                    consultation time.
                                </p>
                            </li>
                            {{-- <li>
                            <p class="text">
                                Packages are conveniently arranged. Fees are collected easily.
                            </p>
                        </li>
                        <li>
                            <p class="text">
                                All supported by the MyHospital system.
                            </p>
                        </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="doctor-benefits-section">
            <div class="container doctor-benefits">
                {{-- <div class="header">
                <h1><b>JOIN US</b></h1>
                <h1>Here are the benefits.</h1>
            </div> --}}

                <div class="benefits">
                    <div class="benefit">
                        <img class="benefit-img" src="{{ asset('img/benefit-1.png') }}">
                        <div class="benefit-list">
                            <h1>Value for Money</h1>

                            <ul>
                                <li>
                                    Transparent and affordable Professional and
                                    Service fees
                                </li>
                                <li>
                                    Detailed instructions for tests and lab needs to
                                    prevent retaking tests
                                </li>
                                <li>
                                    Early detection of illnesses
                                </li>
                                <li>
                                    No need to leave home and pay for transportation
                                    and parking
                                </li>
                                <li>
                                    Discounts on labs and pharmaceutical needs
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="benefit">
                        <img class="benefit-img" src="{{ asset('img/benefit-2.png') }}">
                        <div class="benefit-list">
                            <h1>Access to Better Healthcare </h1>
                            <ul>
                                <li>
                                    Gain access to better doctors, hospitals, labs, and
                                    pharmacies
                                </li>
                                <li>
                                    Quick and easy booking of consults, hospital
                                    rooms, ambulances, labs and even medicine
                                </li>
                                <li>
                                    Home care and deliveries
                                </li>
                                <li>
                                    Our admin will help coordinate everything for you
                                </li>
                                <li>
                                    Preventive and continuity of care for the patient
                                </li>
                                <li>
                                    On demand doctor's appointments
                                </li>
                                <li>
                                    Faster results from Labs
                                </li>
                                <li>
                                    Neuro Cognitive (Psychiatry) consultation available
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="benefit">
                        <img class="benefit-img" src="{{ asset('img/benefit-3.png') }}">
                        <div class="benefit-list">
                            <h1>Convenience</h1>
                            <ul>
                                <li>
                                    Once we collect your records and files, our
                                    admin does all the work for you -- just wait for a
                                    consultation link
                                </li>
                                <li>
                                    Online consults and medical service anytime
                                    without leaving the comforts of your home or
                                    office
                                </li>
                                <li>
                                    Lessen risk of communicable diseases exposure
                                    in hospitals and clinics
                                </li>
                                <li>
                                    Good triage tool to determine urgency of
                                    patient's condition
                                </li>
                                <li>
                                    HMO/Insurance covered
                                </li>
                                <li>
                                    Lab results availability - may have the option to
                                    be released digitally
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="treatment-section">
        <div class="container">
            <div class="header">
                <h1><b>MyHospital Provides Treatment</b></h1>
                <h1>for the Following:</h1>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="covid-card">
                        <div class="middle">
                            <p>COVID-19<br>
                                Tuberculosis(TB)<br>
                                Tele and Home Care
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 spacer"></div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="heart-card">
                        <div class="middle">
                            <p>Cardio metabolic diseases<br>
                                Hypertension<br>
                                Obesity & Stroke<br>
                                Obstructive Sleep Apnea<br>
                                Diabetes Center (feet,
                                nutrition, retina, and cardio)
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="mental-card">
                        <div class="middle">
                            <p>Mental wellness<br>
                                Anxiety<br>
                                Depression<br>
                                Neuro Cognitive Psychiatric:
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 spacer"></div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="wellness-card">
                        <div class="middle">
                            <p>Annual Physical<br>
                                Balanced nutrition plans<br>
                                Vaccinations
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="why-choose-section">
        <div class="container">
            <h1 class="title"><b>WHY CHOOSE</b> <span class="logo-wrap">My<span class="logo-text">Hospital</span>?</h1>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <img class="benefit-img" src="{{ asset('img/benefit-3.png') }}">

                        At MyHospital, we believe
                        that communal well-being is
                        vital to individual health.
                        That's why we help build a
                        healthier tomorrow,
                        together with our patients,
                        trusted doctors, and partner
                        laboratories.
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <img class="benefit-img" src="{{ asset('img/benefit-2.png') }}">

                        The MyHospital team works
                        tirelessly to make essential
                        health services, especially
                        COVID-related health
                        services, easier to access for
                        everyone. MyHospital is
                        designed to change with the
                        times -- offering nearby
                        access, science-based
                        guidance, and affordable
                        services to all our patients.
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <img class="benefit-img" src="{{ asset('img/benefit-1.png') }}">

                        Together with our doctors
                        and partner laboratories,
                        we're imagining new ways to
                        help Filipinos stay safe,
                        healthy, and informed
                        whenever and wherever
                        they are.
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- <section class="special-services">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="container">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h1 class="title">SPECIALTY CENTER</h1>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="row d-flex justify-content-center">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="col-md-6 col-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="hospital-card -diagnostics d-flex flex-column justify-content-between">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="top">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h1>Covid Care Center</h1>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="bottom">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="line"></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <p>Our online tool helps you schedule your tests when it's most convenient for you.</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a href="{{ route('covid-home') }}" class="purple-button">Schedule Now</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </section> -->
    <!-- <section class="mission-section">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="row g-0">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="col-md-6 col-12 mission-image order-md-2"></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="col-md-6 col-12 mission-text order-md-1 d-flex justify-content-center flex-column">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="text">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h1>Our Mission</h1>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p>We are transforming everyone’s access to healthcare. We strive to provide accessibility to the best
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    medical care possible</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </section> -->
@endsection

<script>
    function goTo(route) {
        window.location.href = route;
    }
</script>
