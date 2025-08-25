<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Olunana Gardens</title>
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Barlow&family=Barlow+Condensed&family=Gilda+Display&display=swap">
    <link rel="stylesheet" href="css/plugins.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Menu -->
    <div class="cappa-wrap">
        <div class="cappa-wrap-inner">
            <x-front.sidebar-links></x-front.sidebar-links>
            <div class="cappa-menu-footer">
                <div class="reservation">
                    <a href="tel:8551004444">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <i class="flaticon-call"></i>
                        </div>
                        <div class="call">Reservations: <br><span>+254 712 345 678</span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Logo & Menu Burger -->
    <header class="cappa-header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-6 col-md-6 cappa-logo-wrap">
                    <a href="/" class="cappa-logo">
                        <img src="{{ asset('img/logo.png') }}?{{ rand(1, 670) }}" alt="">
                    </a>
                </div>
                <!-- Menu Burger -->
                <div class="col-6 col-md-6 text-right cappa-wrap-burger-wrap"> <a href="#"
                        class="cappa-nav-toggle cappa-js-cappa-nav-toggle"><i></i></a> </div>
            </div>
        </div>
    </header>
    <!-- Kenburns Slider -->
    <aside class="kenburns-section" id="kenburnsSliderContainer" data-overlay-dark="3">
        <div class="kenburns-inner h-100">
            <div class="v-middle">
                <div class="container">
                    <div class="row h-100">
                        <div class="col-md-7">
                            <div class="v-middle caption"> <span>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                </span>
                                <h4>Welcome to OluNana</h4>
                                <h3>BLOOMING EVENTS IN NATURE'S EMBRACE</h3>
                                <div class="butn-light mt-30 mb-30"> <a href="#" data-scroll-nav="2"><span>Our
                                            Offerings</span></a> </div>
                            </div>
                        </div>
                        <!-- Booking From -->
                        <x-front.booking-form></x-front.booking-form>
                    </div>
                </div>
            </div>
        </div>
        <!-- arrow down -->
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </aside>
    <!-- About -->
    <section class="about section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <span>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                    </span>
                    <div class="section-subtitle">The OluNana Gardens</div>
                    <div class="section-title">Your Green Oasis for Memorable Occasions</div>

                    <h5>Why Choose Our Gardens Venue?</h5>
                    <p>With sprawling gardens and impeccable event spaces, we provide the perfect backdrop for weddings,
                        corporate events, and all your celebrations. Our professional team ensures every detail is taken
                        care of, so you can relax and enjoy your event.</p>

                    <h5>Our Natural Paradise</h5>
                    <p>Our gardens are meticulously curated to offer a diverse range of flora, from vibrant blooms to
                        soothing greenery. Stroll along winding paths, listen to the chirping of birds, and let the
                        fragrance of flowers enchant your senses.</p>

                    <h5>Your Event, Our Expertise</h5>
                    <p>We specialize in creating unforgettable moments. Whether it's an intimate gathering or a grand
                        celebration, our experienced team will work with you to make your event a seamless success. From
                        decorations to catering, we've got it all covered.</p>

                    <!-- call -->
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:855-100-4444">855 100 4444</a>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp">
                    <img src="olunana/img/7.jpg" alt="" class="mt-90 mb-30">
                </div>
                <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp">
                    <img src="olunana/img/1.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms -->
    {{-- <x-front.rooms></x-front.rooms> --}}
    <!-- Pricing -->
    {{-- <x-front.pricing></x-front.pricing> --}}
    <!-- Promo Video -->
    {{-- <x-front.promo-video></x-front.promo-video> --}}
    <!-- Facilties -->
    <x-front.facilities></x-front.facilities>
    <!-- Testiominals -->
    <x-front.testimonials></x-front.testimonials>
    <!-- Services -->
    <x-front.services></x-front.services>
    <!-- News -->
    <x-front.news></x-front.news>
    <!-- Reservation & Booking Form -->
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/2.jpg"
            data-overlay-dark="2">
            <div class="container">
                <div class="row">
                    <!-- Reservation -->
                    <div class="col-md-7 mb-30 mt-30">
                        <p><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i
                                class="star-rating"></i><i class="star-rating"></i></p>
                        <h5>Each of our guest rooms feature a private bath, wi-fi, cable television and include full
                            breakfast.</h5>
                        <div class="reservations mb-30">
                            <div class="icon color-1"><span class="flaticon-call"></span></div>
                            <div class="text">
                                <p class="color-1">Reservation</p> <a class="color-1" href="tel:855-100-4444">855 100
                                    4444</a>
                            </div>
                        </div>
                        <p><i class="ti-check"></i><small>Call us, it's toll-free.</small></p>
                    </div>
                    <!-- Booking From -->
                    <x-front.booking-form></x-front.booking-form>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients -->
    <x-front.clients></x-front.clients>
    <!-- Footer -->
    <x-front.footer></x-front.footer>
    <!-- jQuery -->
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.min.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.isotope.v3.0.2.js"></script>
    <script src="js/pace.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scrollIt.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/YouTubePopUp.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/vegas.slider.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- Vegas Background Slideshow (vegas.slider kenburns) -->
    <script>
        $(document).ready(function() {
            $('#kenburnsSliderContainer').vegas({
                slides: [{
                    src: "img/slider/1.jpg"
                }, {
                    src: "img/slider/2.jpg"
                }, {
                    src: "img/slider/3.jpg"
                }],
                overlay: true,
                transition: 'fade2',
                animation: 'kenburnsUpRight',
                transitionDuration: 1000,
                delay: 10000,
                animationDuration: 20000
            });
        });
    </script>
</body>

</html>
