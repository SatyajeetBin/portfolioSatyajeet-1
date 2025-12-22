@extends('layouts.webpage')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">


                    <div class="col-lg-6 d-flex flex-column justify-content-center align-items text-center text-md-start"
                        data-aos="fade-up">
                        <h2>Order Medicines & Book Lab Tests from Nearby Pharmacies & Labs – Free Delivered in 60 Minutes
                        </h2>
                        <p>Find and compare medicines & tests nearby. Check live stock and prices, compare ratings, book
                            home sample pickup, and get free medicine delivery in 60 minutes or instant pickup.</p>
                        <div class="d-flex mt-4 justify-content-center justify-content-md-start">
                            <a href="#" class="download-btn"><i class="bi bi-google-play"></i> <span>Google
                                    Play</span></a>
                            <a href="#" class="download-btn"><i class="bi bi-apple"></i> <span>App
                                    Store</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center align-items text-center text-md-start"
                        data-aos="fade-up">
                        <img src="assets/frontend/img/hero-side-banner.png" alt="Phone 2" class="phone-2">
                    </div>
                </div>
            </div>

        </section>
        <!-- /Hero Section -->

        <!-- Featured Section -->
        <section id="featured" class="featured section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Everything You Need in One App</h2>
                <p>Your complete healthcare solution for medicines and lab tests</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="img">
                                <img src="assets/frontend/img/Group 6994.png" alt="" class="img-fluid">
                                <!-- <div class="icon">
                        <i class="bi bi-geo-alt"></i><i class="bi bi-capsule" style="margin-left:-8px; font-size:0.7em;"></i>
                        </div> -->
                            </div>
                            <h2 class="title">One Tap. All Nearby Pharmacies.</h2>
                            <p>
                                Live stock, live prices — just tap and get it delivered or pick it up 24/7.
                            </p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="img">
                                <img src="assets/frontend/img/Group 6993.png" alt="" class="img-fluid">
                            </div>
                            <h2 class="title">Compare & Book Lab Tests</h2>
                            <p>
                                Check nearby labs, choose your test, and book instantly- with home collection options
                                too.
                            </p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card">
                            <div class="img">
                                <img src="assets/frontend/img/Group 6996.png" alt="" class="img-fluid">
                                <!-- <div class="icon"><i class="bi bi-hospital"></i></div> -->
                            </div>
                            <h2 class="title">Jan Aushadhi Kendra</h2>
                            <p>
                                (JAK): Search. Find. Order.
                            </p>
                        </div>
                    </div><!-- End Card Item -->

                </div>

            </div>

        </section><!-- /Featured Section -->

        <!-- Cards Section -->
        <section id="cards" class="cards section">
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <h2>How it works?</h2>
            </div>
            <div class="container">

                <div class="text-center mb-4 steps-img" data-aos="zoom-out">
                    <img src="assets/frontend/img/Group 6997.png" alt="">
                </div>

                <div class="row gy-4">

                    <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-item">
                            <span>01</span>
                            <h4>Search Medicine/Test</h4>
                            <p>Find the medicine or lab test you need</p>
                        </div>
                    </div><!-- Card Item -->

                    <div class="col-lg-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-item">
                            <span>02</span>
                            <h4>Compare Prices & Availability</h4>
                            <p>See live prices and stock from nearby pharmacies</p>
                        </div>
                    </div><!-- Card Item -->

                    <div class="col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-item">
                            <span>03</span>
                            <h4>Choose Delivery or Pickup</h4>
                            <p>Select convenient delivery or pickup option</p>
                        </div>
                    </div><!-- Card Item -->

                    <div class="col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-item">
                            <span>04</span>
                            <h4>Order & Book From Trusted Pharmacy/Lab</h4>
                            <p>Complete your order with trusted partners</p>
                        </div>
                    </div><!-- Card Item -->

                </div>

            </div>

        </section><!-- /Cards Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up">
                <div class="row align-items-xl-center gy-5">

                    <div class="col-xl-5 content">
                        <h3>About Us</h3>
                        <h2>Why Choose Gomeds 24/7?</h2>
                        <a href="/about" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="col-xl-7">
                        <div class="row g-4 icon-boxes">

                            <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box text-center flex-fill">
                                    <img src="assets/frontend/img/60-Min Delivery.png" alt="60-Min Delivery"
                                        class="feature-icon">
                                    <h3>60-Min Delivery</h3>
                                    <p>Your meds, at your door in under an hour.</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box text-center flex-fill">
                                    <img src="assets/frontend/img/On-Time Lab Sample Pickup.png"
                                        alt="On-Time Lab Sample Pickup" class="feature-icon">
                                    <h3>On-Time Lab Sample Pickup</h3>
                                    <p>No delays. Labs come to you—right on schedule.</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box text-center flex-fill">
                                    <img src="assets/frontend/img/7 Pharmacy Pickup.png" alt="24/7 Pharmacy Pickup"
                                        class="feature-icon">
                                    <h3>24/7 Pharmacy Pickup</h3>
                                    <p>Order ahead, pick up anytime. Even at 2 AM.</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box text-center flex-fill">
                                    <img src="assets/frontend/img/Free Delivery & Pickup.png" alt="Free Delivery & Pickup"
                                        class="feature-icon">
                                    <h3>Free Delivery & Pickup</h3>
                                    <p>Zero delivery fees. Pharmacies & labs that come to you.</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="600">
                                <div class="icon-box text-center flex-fill">
                                    <img src="assets/frontend/img/0 Commission to Pharmacies.png"
                                        alt="0% Commission to Pharmacies" class="feature-icon">
                                    <h3>0% Commission to Pharmacies</h3>
                                    <p>We don't take a cut—more savings go to you.</p>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="700">
                                <div class="icon-box text-center flex-fill">
                                    <img src="assets/frontend/img/Up to 80 Off.png" alt="Up to 80% Off"
                                        class="feature-icon">
                                    <h3>Up to 80% Off</h3>
                                    <p>Massive discounts on meds & tests, always.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>









        <!-- Gallery Section -->
        <section id="gallery" class="gallery section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Gallery</h2>
                <p>A glimpse of how Gomeds 24/7 makes healthcare easier</p>
            </div><!-- End Section Title -->

            <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 0
                },
                "768": {
                  "slidesPerView": 3,
                  "spaceBetween": 30
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 30
                },
                "1200": {
                  "slidesPerView": 7,
                  "spaceBetween": 30
                }
              }
            }
          </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1339.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1339.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/screen2.png"><img
                                    src="assets/frontend/img/app-gallery/screen2.png" class="img-fluid"
                                    alt=""></a></div>

                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/screen3.png"><img
                                    src="assets/frontend/img/app-gallery/screen3.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/screen4.png"><img
                                    src="assets/frontend/img/app-gallery/screen4.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/screen5.png"><img
                                    src="assets/frontend/img/app-gallery/screen5.png" class="img-fluid"
                                    alt=""></a></div>
                        <!-- <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                    href="assets/frontend/img/app-gallery/Rectangle 1342.png"><img
                                        src="assets/frontend/img/app-gallery/Rectangle 1342.png" class="img-fluid"
                                        alt=""></a></div> -->
                        {{-- <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1343.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1343.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1344.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1344.png" class="img-fluid"
                                    alt=""></a></div> --}}
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1345.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1345.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1346.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1346.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1353.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1353.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1352.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1352.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1347.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1347.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1348.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1348.png" class="img-fluid"
                                    alt=""></a></div>

                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1354.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1354.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1351.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1351.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full"
                                href="assets/frontend/img/app-gallery/Rectangle 1352.png"><img
                                    src="assets/frontend/img/app-gallery/Rectangle 1352.png" class="img-fluid"
                                    alt=""></a></div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Gallery Section -->





        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Frequently Asked Questions</h2>
                <p>Everything you need to know about Gomeds</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            <div class="faq-item faq-active">
                                <h3>How do I know if medicine is in stock?</h3>
                                <div class="faq-content">
                                    <p>Our app shows real-time stock availability from all nearby pharmacies. You can
                                        see live inventory before placing your order. We update stock levels every few
                                        minutes to ensure accuracy.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>How do I choose pickup vs delivery?</h3>
                                <div class="faq-content">
                                    <p>During checkout, you can select either home delivery (within 60 minutes) or
                                        pickup from the pharmacy at your convenience, even 24/7. Delivery is free for
                                        orders above ₹200.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>What labs are available in my area?</h3>
                                <div class="faq-content">
                                    <p>The app automatically shows all certified labs near your location with ratings,
                                        prices, and available tests. You can filter by test type, collection options,
                                        and view customer reviews before booking.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Can I book Jan Aushadhi medicines?</h3>
                                <div class="faq-content">
                                    <p>Yes! We have partnered with Jan Aushadhi Kendras to provide you access to
                                        affordable generic medicines with live stock updates and home delivery. Save up
                                        to 80% on medicines.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Is there any delivery charge?</h3>
                                <div class="faq-content">
                                    <p>No delivery charges! We provide free delivery and pickup services. Our partner
                                        pharmacies and labs come to you at no extra cost, making healthcare truly
                                        accessible.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->


                        </div>

                    </div><!-- End Faq Column-->

                </div>

            </div>

        </section><!-- /Faq Section -->

        <!-- Contact Section -->

        <!-- /Contact Section -->

    </main>
@endsection
