@extends('layouts.covid-home')

@section('content')
    <section class="covid-banner-section">
        <div class="covid-banner">
            <div class="container">
                <div class="row right">
                    {{-- <div class="col-md-4 col-12 slider-col"></div>
                <div class="col-md-2 col-12 slider-col"></div> --}}
                    <div class="col-md-6 col-12 slider-col">
                        <div class="text">
                            <h1>Covid Care Center: MyHospital</h1>
                            <p>
                                At MyHospital, we aim to improve the experience of
                                both patients and doctors in handling mild and
                                asymptomatic cases of COVID-19. Stay safe, healthy,
                                and informed with MyHospital’s home service COVID
                                tests and COVID specialty care services.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="covid-services">
        <div class="container">
            <h1 class="title">Services</h1>
            <div class="row">
                <div class="col-md-12 col-12 order-md-1">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="service-card">
                                <h1 class="title">
                                    Assessment
                                </h1>
                                <div class="line"></div>
                                <p><b>Step 1:</b></p>

                                <p>Teleconsult : It’s as easy as 1-2-3.
                                    Our team will help asses your symptoms and advice what is needed accordingly.
                                    If symptoms are mild then we can proceed for home healthcare.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="service-card">
                                <h1 class="title">
                                    Schedule a Telemed Consult
                                </h1>
                                <div class="line"></div>
                                <p><b>Step 2:</b></p>

                                <p>
                                    Home Visit and Testing:
                                    Our doctors will visit
                                    you, assess your
                                    condition, take an
                                    RT-PCR test, and other
                                    lab tests. They will see
                                    what they can do to
                                    relieve your current
                                    symptoms.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="service-card">
                                <h1 class="title">
                                    Covid Test
                                </h1>
                                <div class="line"></div>
                                <p><b>Step 3:</b></p>

                                <p>
                                    Telemed Consult
                                    Follow up: The
                                    doctor will discuss
                                    the results and
                                    provide the next
                                    action steps.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="service-card">
                                <h1 class="title">
                                    Monitoring
                                </h1>
                                <div class="line"></div>
                                <p><b>Step 4:</b></p>
                                <p>
                                    Regular Monitoring and
                                    Consultation. Our COVID
                                    specialty care doesn’t end
                                    there, we will guide you
                                    every step of the way
                                    towards wellness and bring
                                    you back to full health once
                                    again.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-center justify-content-center service-button">
                <a href="{{ route('book-doctor') }}" class="white-button -lg">Start Here</a>
            </div>
        </div>
    </section>

    <section class="doctor-benefits-section doctor-benefits-container">
        <div class="container doctor-benefits">
            <div class="header">
                <h1><b>FEATURES AND BENEFITS OF MYHOSPITAL’S</b></h1>
                <h1><b>SPECIALTY COVID CARE CENTER</b></h1>
            </div>

            <div class="benefits">
                <div class="benefit">
                    <img class="benefit-img" src="{{ asset('img/benefit-1.png') }}">
                    <div class="benefit-list">
                        <h1>Value for Money</h1>

                        <p>
                            MyHospital helps you save on time and resources by
                            providing transparent and affordable professional and
                            service fees. We ensure each test and assessment to
                            detect early symptoms, helping you protect your loved
                            ones. As the entire process can be done at home, you
                            also save on time and transportation costs.
                        </p>
                    </div>
                </div>
                <div class="benefit">
                    <img class="benefit-img" src="{{ asset('img/benefit-2.png') }}">
                    <div class="benefit-list">
                        <h1>Access to Better Healthcare </h1>
                        <p>
                            Get access to better doctors, hospitals, labs, and
                            pharmacies. Our admin will help coordinate everything
                            for you, including home care and deliveries for their
                            medication. We also provide on demand doctor's
                            appointments and preventive/continuity of care for the
                            patient.
                        </p>
                    </div>
                </div>
                <div class="benefit">
                    <img class="benefit-img" src="{{ asset('img/benefit-3.png') }}">
                    <div class="benefit-list">
                        <h1>Convenience</h1>
                        <p>
                            Sign up for online consults and medical services
                            anytime without leaving your home or office. Lessen
                            the risk of getting infected by communicable
                            diseases. You will also have the option to receive
                            digital versions of your lab results.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="why-choose-myhospital">
        <div class="container">

            <div class="row">
                <div class="col-md-6">

                    <h1>
                        Why Choose MyHospital?
                    </h1>

                    <p>
                        At MyHospital, we believe that communal well-being is vital to
                        individual health. That's why we help build a healthier tomorrow,
                        together with our patients, trusted doctors, and partner
                        laboratories.
                    </p>
                    <p>
                        The MyHospital team works tirelessly to make essential health
                        services, especially COVID-related health services, easier to access
                        for everyone. MyHospital is designed to change with the times --
                        offering nearby access, science-based guidance, and affordable
                        services to all our patients.
                    </p>
                    <p>
                        Together with our doctors and partner laboratories, we're
                        imagining new ways to help Filipinos stay safe, healthy, and
                        informed whenever and wherever they are.
                    </p>
                </div>

            </div>
        </div>
    </section>
@endsection
