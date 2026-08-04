@extends('user.user-master')
@section('content')
    @include('layouts.header')

    <div class="main">
        <section class="ind1">
            <div class="mn-sldr">
                <div class="mn-img-cntnr">
                    <img src="{{ asset('/assets/ltst-img/2.jpg') }}" alt="">
                </div>
                <div class="mn-img-cntnr">
                    <img src="{{ asset('/assets/ltst-img/8.jpg') }}" alt="">
                </div>
                <div class="mn-img-cntnr">
                    <img src="{{ asset('/assets/ltst-img/4.jpg') }}" alt="">
                </div>
            </div>
            <div class="mn-cont-fl">
                <div class="container">
                    <div class="mn-content">
                        <div>
                            <h1 data-aos="fade-in" data-aos-duration="1500">Powering the World’s Clean Energy Future</h1>
                            <h3 data-aos="fade-in" data-aos-duration="1500"><span>Third Edition –</span> <br> Kerala’s
                                Premier Renewable Energy Showcase</h3>
                            <div class="dt-bx-flx">
                                <div class="dt-bx">
                                    <h3>9</h3>
                                    <div class="dt-bx-btm-bx">
                                        <p>Friday</p>
                                    </div>
                                </div>
                                <div class="dt-bx">
                                    <h3>10</h3>
                                    <div class="dt-bx-btm-bx">
                                        <p>Saturday</p>
                                    </div>
                                </div>
                                <div class="dt-bx">
                                    <h3>11</h3>
                                    <div class="dt-bx-btm-bx">
                                        <p>Sunday</p>
                                    </div>
                                </div>
                                <h2>Jan 2026</h2>
                            </div>
                            <div class="mn-btns">
                                <a href="/visitor-registration">
                                    <p class="p1">Visitor Registration</p>
                                </a>
                                {{-- <a href="/exhibitors-register"">
                                    <p class="p2">Exhibitor Registration</p>
                                </a> --}}
                            </div>
                            <div class="scl-flx">
                                <a href="https://www.facebook.com/Mastersgreenenergyexpo2026/" target="_blank">
                                    <div class="scl-bx">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </div>
                                </a>
                                <a href="https://www.youtube.com/@Mastersexpo2026" target="_blank">
                                    <div class="scl-bx">
                                        <i class="fa-brands fa-youtube"></i>
                                    </div>
                                </a>
                                <a href="https://www.instagram.com/mastersexpo_2026/" target="_blank">
                                    <div class="scl-bx">
                                        <i class="fa-brands fa-instagram"></i>
                                    </div>
                                </a>
                                <a href="https://www.linkedin.com/company/110237453/admin/dashboard/ " target="_blank ">
                                    <div class="scl-bx">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="ind2" id="about">
            <div class="container">
                <div class="ind2-content">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="h3" data-aos="fade-in" data-aos-duration="1500">About Us</h3>
                            <h2 data-aos="fade-in" data-aos-duration="1500">We are a premier platform for the solar and
                                clean energy industry</h2>
                            <div class="ind2-inr-flx">
                                <div class="ind2-inr-lft msk">
                                    <img src="{{ asset('/assets/imgs/1.png') }}" alt="">
                                </div>
                                <div class="ind2-inr-flx-rgt">
                                    <p class="p"><i class="fa-solid fa-location-dot" data-aos="fade-in"
                                            data-aos-duration="1500"></i>Puthiyakavu Ground Thripunithura, Ernakulam</p>
                                    <p data-aos="fade-in" data-aos-duration="1500">Masters Association, representing over
                                        700 MNRE-registered vendors across Kerala, proudly presents the MASTERS KERALA RE
                                        EXPO 2026 — a grand platform bringing together all stakeholders of the renewable
                                        energy, BESS and EV sectors.</p>
                                    <p data-aos="fade-in" data-aos-duration="1500">Discover the latest technologies,
                                        innovative products and sustainable solutions from leading manufacturers, suppliers,
                                        vendors, R&D institutions and service providers — all under one roof.</p>
                                    <div class="count-bx" data-aos="fade-in" data-aos-duration="2000">
                                        <ul id="timeControl">
                                            <li><span id="days"></span>Day</li>
                                            <li><span id="hours"></span>Hours</li>
                                            <li><span id="minutes"></span>Minutes</li>
                                            <li><span id="seconds"></span>Seconds</li>
                                        </ul>
                                    </div>
                                    <p class="ind2-cnt">Contact Us</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <div class="ind2-inr-rgt">
                                <div class="ind2-inr-rgt-tp">
                                    <img src="{{ asset('/assets/logo/logo3.png') }}" alt="">
                                </div>
                                <div style="position: relative;">
                                    <div class="ind2-inr-rgt-btm" data-aos="fade-in" data-aos-duration="1500">
                                        <img src="{{ asset('/assets/imgs/2.png') }}" alt="">
                                    </div>
                                    <div class="exp-bx">
                                        <img src="{{ asset('/assets/icons/1.png') }}" alt="">
                                        <div>
                                            <h3>5+</h3>
                                            <p>years Experience</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ind3">
            <div class="container">
                <div class="ind3-flx">
                    <div class="ind3-lft">
                        <div class="tle-spnsr">
                            <h3>Title Sponsor</h3>
                            <img src="{{ asset('/assets/logo/1.png') }}" alt="">
                        </div>
                    </div>
                    <div class="ind3-rgt">
                        <div class="mn-spnsr">
                            <h3>Co Sponsor</h3>
                            <div class="spnsr-flx">
                                <img src="{{ asset('/assets/logo/2.png') }}" alt="">
                                <img src="{{ asset('/assets/logo/3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="ind3-rgt">
                        <div class="reg-prtnrs">
                            <h3>Registration Partner</h3>
                            <div class="spnsr-flx">
                                <img src="{{ asset('/assets/logo/4.png') }}" alt="">
                                <img src="{{ asset('/assets/logo/5.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ind4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ind3-inr-lft">
                            <div class="ind3-inr-lft-inr1">
                                <img src="{{ asset('/assets/imgs/3.png') }}" alt="">
                            </div>
                            <div class="ind3-inr-lft-inr2">
                                <img src="{{ asset('/assets/imgs/4.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ind4-tp">
                            <!-- <h3 class="h3">Lorem ipsum dummy</h3> -->
                            <h2 data-aos="fade-in" data-aos-duration="1500">Kerala’s largest Exhibition on Renewable
                                Energy industry</h2>
                            <p data-aos="fade-in" data-aos-duration="1500">This exhibition brings together leading
                                innovators, manufacturers, and solution providers shaping the renewable energy industry.</p>
                        </div>
                        <div class="crcle-cont">
                            <div class="crcl-wth-txt">
                                <div class="crcle-cont-crcl1">
                                    <div class="crcle-cont-crcl2">
                                        <div class="chart-box">
                                            <div class="chart" data-value="85"></div>
                                        </div>
                                    </div>
                                </div>
                                <p>Renewable Energy Adoption</p>
                            </div>
                            <div class="crcl-wth-txt">
                                <div class="crcle-cont-crcl1">
                                    <div class="crcle-cont-crcl2">
                                        <div class="chart-box">
                                            <div class="chart" data-value="80"></div>
                                        </div>
                                    </div>
                                </div>
                                <p>Technology Innovation Showcase</h3>
                            </div>
                        </div>
                        <div class="goto">
                            <div class="goto-flx">
                                <div class="goto-inr-flx">
                                    <div class="count2">
                                        <div class="wth-pls">
                                            <p class="count">60</p><span>
                                                <P>K</P>
                                                <p>+</p>
                                            </span>
                                        </div>
                                        <p>Sqm <br> Exhibition Space</p>
                                    </div>
                                    <div class="gap-ln"></div>
                                    <div class="count2">
                                        <div class="wth-pls">
                                            <p class="count">12</p><span>
                                                <p>K</p>
                                                <p> +</p>
                                            </span>
                                        </div>
                                        <p>Trade <br>Visitors</p>
                                    </div>
                                </div>
                                <div class="goto-inr-flx">
                                    <div class="gap-ln"></div>
                                    <div class="count2">
                                        <div class="wth-pls">
                                            <p class="count">200</p><span class="sqm-flx">
                                                <p>+</p>
                                            </span>
                                        </div>
                                        <p>Over <br> exhibitors</p>
                                    </div>
                                    <div class="gap-ln"></div>
                                    <div class="count2">
                                        <div class="wth-pls">
                                            <p class="count">15</p><span class="sqm-flx">
                                                <p>+</p>
                                            </span>
                                        </div>
                                        <p>New <br> Product Launches</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="points-flx" data-aos="fade-in" data-aos-duration="1500">
                            <div class="pnt-rnd"></div>
                            <h4>Showcasing the latest innovations in solar, wind, and renewable energy technologies</h4>
                        </div>
                        <div class="points-flx" data-aos="fade-in" data-aos-duration="1500">
                            <div class="pnt-rnd"></div>
                            <h4>A premier platform for renewable energy products, services, and technologies</h4>
                        </div>
                        <br>
                        <div class="mn-btns">
                            <a href="/visitor-registration"">
                                <p class="p1">Visitor Registration</p>
                            </a>
                            <a href="/exhibitors-register"">
                                <p class="p2">Exhibitor Registration</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ind5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ind5-left">
                            <h2><span>Why</span> <br> Choose Us?</h2>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Kerala’s most comprehensive platform dedicated to solar, wind, and renewable energy
                                    solutions</p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Showcasing the latest technologies, products, and innovations from leading industry
                                    brands
                                </p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Connecting manufacturers, EPCs, installers, investors, and policymakers under one roof
                                </p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Enabling strong B2B networking, partnerships, and business opportunities</p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Featuring expert talks, live demos, and knowledge-sharing sessions</p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Supporting sustainable growth and clean energy adoption across Kerala and India</p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Designed for industry professionals, startups, and clean energy enthusiasts</p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Direct access to decision-makers, buyers, and project developers</p>
                            </div>
                        </div>

                        <div class="fr-up">
                            <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                <div class="ind5-rnd">
                                    <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                </div>
                                <p>Promoting Kerala’s vision for sustainable and energy-efficient growth</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ind6">
            <div class="container">
                <div class="ind6-hdng">
                    <h2>Event Highlights</h2>
                    <p>Discover key attractions, innovations, and experiences that make this renewable energy exhibition
                        truly impactful.</p>
                </div>
                <div class="ind6-btm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <!-- <h3>Cultural Seminars & Performance</h3> -->
                                        <p>South India’s Largest Renewable Energy Industry Job fair</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>60,000 Sq Ft Air-conditioned Exhibition Area</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Separate Pavilions for E-mobility & Technology Conference</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Technical Seminars by Experts on BESS, EV & Renewable Energy etc</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>B2B Lounge Facility & More Than 3000 Car Parking</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Adequate Promotional Campaign</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Easy Connectivity to Airport, Railway & Bus Stations</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Facilities Adjacent to Expo Campus</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Cultural Seminars and Performance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Access controlled visitor management</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Have cost-effect access to over 150 top brands from the Renewable Energy
                                            industry.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Launching of new products and services.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Interact with a large gathering of industry buyers and investors, and can build
                                            strategic business alliances.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fr-up">
                                <div class="ind5-flx" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="ind5-rnd">
                                        <img src="{{ asset('/assets/icons/2.png') }}" alt="">
                                    </div>
                                    <div>
                                        <p>Ease of doing business and opportunity to connect with industry professionals</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                                        <div class="ind5-flx">
                                            <div class="ind5-rnd">
                                                <img src=""/assets/icons/2.png" alt="">
                                            </div>
                                            <div>
                                                <h3>Cultural Seminars & Performance</h3>
                                                <p>Various Keralite art forms and Cultural Seminars</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ind5-flx">
                                            <div class="ind5-rnd">
                                                <img src="/assets/icons/2.png" alt="">
                                            </div>
                                            <div>
                                                <h3>Startup Pitch Competition</h3>
                                                <p>Witness the next big thing as startups present their groundbreaking ideas.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ind5-flx">
                                            <div class="ind5-rnd">
                                                <img src="/assets/icons/2.png" alt="">
                                            </div>
                                            <div>
                                                <h3>Techical Workshops & Seminars</h3>
                                                <p>Participate in hands-on sessions and learn from the best in the field.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ind5-flx">
                                            <div class="ind5-rnd">
                                                <img src="/assets/icons/2.png" alt="">
                                            </div>
                                            <div>
                                                <h3>Innovative Exhibitions</h3>
                                                <p>Explore cutting-edge technologies & products from leading companies across the globe.</p>
                                            </div>
                                        </div>
                                    </div> -->
                    </div>
                </div>
            </div>
        </section>
        <section class="ind7">
            <div class="container">
                <div class="flr-map">
                    <img src="{{ asset('/assets/imgs/6.png') }}" alt="">
                </div>
            </div>
        </section>
        <div class="partners-section">
            <div class="container">
                <div class="prtnr-hdng">
                    <h2>Expo 2025-26 Participants</h2>
                </div>
                <div class="prtnr-img-flx">
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/1.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/2.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/3.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/4.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/5.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/6.jpg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/7.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/8.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/9.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/10.jpg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/11.jpg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/12.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/13.jpg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/14.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/15.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/16.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/17.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/18.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/19.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/20.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/21.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/22.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/23.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/24.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/25.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/26.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/27.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/28.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/29.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/30.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/31.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/32.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/33.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/34.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/35.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/36.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/37.png') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/38.jpeg') }}" alt="">
                    </div>
                    <div class="prtnr-img">
                        <img src="{{ asset('/assets/prtnrs/39.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <section class="ind8">
            <div class="container">
                <div class="ind8-hdng">
                    <h2>Glimpses From Expo 2025</h2>
                    <p>A visual showcase capturing key moments, innovations, and experiences from Expo 2025.</p>
                </div>
                <!-- <div class="ind8-btm">

                                                    </div> -->
            </div>
            <div class="ind8-slider">
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/1.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/2.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/3.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/4.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/5.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/6.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/7.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/8.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/9.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/10.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/11.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('/assets/ltst-img/12.jpg') }}" alt="">
                </div>
            </div>
            <p class="p">View All</p>

        </section>
        <!-- <section class="ind9">
                                                <div class="container">
                                                    <div class="ind9-hdng">
                                                        <h2>Testimonials</h2>
                                                        <p>Hear what exhibitors, partners, and visitors have to say about their experience at the expo.</p>
                                                    </div>
                                                    <div class="testimoni">
                                                        <div class="item">
                                                            <div class="testi-bx">
                                                                <img class="test-ic" src="./assets/icons/4.png" alt="">
                                                                <div class="prof-flx">
                                                                    <div class="prof-img"></div>
                                                                    <h3>John doe</h3>
                                                                </div>
                                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it printer </p>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="testi-bx">
                                                                <img class="test-ic" src="./assets/icons/4.png" alt="">
                                                                <div class="prof-flx">
                                                                    <div class="prof-img"></div>
                                                                    <h3>John doe</h3>
                                                                </div>
                                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it printer </p>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="testi-bx">
                                                                <img class="test-ic" src="./assets/icons/4.png" alt="">
                                                                <div class="prof-flx">
                                                                    <div class="prof-img"></div>
                                                                    <h3>John doe</h3>
                                                                </div>
                                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it printer </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ind9-btm-lns">
                                                        <div class="ind9-btm-ln ln1"></div>
                                                        <div class="ind9-btm-ln ln2"></div>
                                                        <div class="ind9-btm-ln ln3"></div>
                                                    </div>
                                                </div>
                                            </section> -->
        <section class="ind10" id="cnct">
            <img class="ind10-bg" src="/assets/logo/logogit init --initial-branch=main --object-format=sha1.png"
                alt="">
            <div class="container">
                <div class="ind10-hdng">
                    <h2>Connect With Us</h2>
                </div>
                <div class="ind10-cont">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Stay connected with us for updates, opportunities, and participation</h2>
                            <p>Reach out to us for exhibitor inquiries, partnerships, sponsorships, and event information.
                            </p>
                            <div class="cnt-cont">
                                <div class="cnt-cont-flx">
                                    <div class="cnt-rnd-bx">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <a href="https://maps.app.goo.gl/6JspoZZUVwn796Gc6" target="_blank">
                                        <div>
                                            <p class="fr-fd">Our Location</p>
                                            <p>Puthiyakavu Ground, Thripunithura, Ernakulam</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="cnt-cont-flx">
                                    <div class="cnt-rnd-bx">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <a href="mailto:  info@solarmasters.org">
                                        <div>
                                            <p class="fr-fd">Work with us</p>
                                            <p> info@solarmasters.org</p>
                                        </div>
                                    </a>
                                </div>
                                {{-- <div class="cnt-cont-flx">
                                    <div class="cnt-rnd-bx">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <a href="tel:9946759777">
                                        <div>
                                            <p class="fr-fd">Call Us</p>
                                            <p>+91 99467 59777</p>
                                        </div>
                                    </a>
                                </div> --}}
                                <div class="cnt-cont-flx">
                                    <div class="cnt-rnd-bx">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <a href="tel:+9181298 38288">
                                        <div>
                                            <p class="fr-fd">Call Us</p>
                                            <p>+91 81298 38288</p>
                                        </div>
                                    </a>
                                </div>
                                <br>
                                <div class="cnt-scls">
                                    <h3>Follow Us On</h3>
                                    <div class="scl-flx">
                                        <a href="https://www.facebook.com/Mastersgreenenergyexpo2026/" target="_blank">
                                            <div class="scl-bx">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </div>
                                        </a>
                                        <a href="https://www.youtube.com/@Mastersexpo2026" target="_blank">
                                            <div class="scl-bx">
                                                <i class="fa-brands fa-youtube"></i>
                                            </div>
                                        </a>
                                        <a href="https://www.instagram.com/mastersexpo_2026/" target="_blank">
                                            <div class="scl-bx">
                                                <i class="fa-brands fa-instagram"></i>
                                            </div>
                                        </a>
                                        <a href="https://www.linkedin.com/company/110237453/admin/dashboard/ "
                                            target="_blank ">
                                            <div class="scl-bx">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cnt-frm-bx">
                                <form id="whatsappForm">
                                    <div class="inpts">
                                        <label>Name</label>
                                        <input type="text" id="name" required>
                                    </div>

                                    <div class="inpts">
                                        <label>Mobile</label>
                                        <input type="text" id="mobile" required>
                                    </div>

                                    <div class="inpts">
                                        <label>Place</label>
                                        <input type="text" id="place">
                                    </div>

                                    <div class="inpts">
                                        <label>Message</label>
                                        <textarea id="message"></textarea>
                                    </div>

                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="ind11">
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5428.107369011424!2d76.35706894114412!3d9.923713283995525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0873dab14e5639%3A0x89b07e0c12ef700a!2sPuthiya%20Kavu%20Temple%20North%20Ground!5e1!3m2!1sen!2sin!4v1766476624582!5m2!1sen!2sin"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(window).on("scroll", function(e) {
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            if ($(window).scrollTop() >= $(".goto").offset().top - $(window).height()) {
                if (!$(".goto").hasClass("animated")) {
                    $(".count").each(function() {
                        $(this)
                            .prop("Counter", 0)
                            .animate({
                                Counter: $(this).text(),
                            }, {
                                duration: 3000,
                                easing: "swing",
                                step: function(now) {
                                    $(this).text(numberWithCommas(Math.ceil(now)));
                                },
                            });
                    });
                    // $("#triggered").addClass("show");
                    $(".goto").addClass("animated");
                }
            }
        });
    </script>
    <script>
        // day timer==================================================================

        let timeControl = document.querySelector("#timeControl");
        let second = 1000;
        let minute = second * 60;
        let hour = minute * 60;
        let day = hour * 24;

        let countDown = new Date("jan 9, 2026 00:00:00").getTime();

        const myRacing = () => {
            let nowDate = new Date().getTime(),
                distance = countDown - nowDate;
            //
            (document.getElementById("days").innerText = Math.floor(distance / day)),
            (document.getElementById("hours").innerText = Math.floor(
                (distance % day) / hour
            )),
            (document.getElementById("minutes").innerText = Math.floor(
                (distance % hour) / minute
            )),
            (document.getElementById("seconds").innerText = Math.floor(
                (distance % minute) / second
            ));

            if (distance < 0) {
                clearInterval(MyTimer);
                timeToStart.innerHTML = "The camp began ☻";
                timeControl.innerHTML = "";
            }
        };
        MyTimer = setInterval(myRacing, 1000);

        // day timer close============================================================

        document.getElementById("whatsappForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let name = document.getElementById("name").value;
            let mobile = document.getElementById("mobile").value;
            let place = document.getElementById("place").value;
            let message = document.getElementById("message").value;

            let phoneNumber = "+918129838288"; // 👉 replace with your WhatsApp number (country code required)

            let whatsappMessage =
                `Name: ${name}%0A` +
                `Mobile: ${mobile}%0A` +
                `Place: ${place}%0A` +
                `Message: ${message}`;

            let whatsappURL = `https://wa.me/${phoneNumber}?text=${whatsappMessage}`;

            window.open(whatsappURL, "_blank");
        });
    </script>
@endsection
