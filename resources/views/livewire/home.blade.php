<div>
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
                            <p>Reservation</p> <a href="tel:{{ env('PHONE_NUMBER') }}">{{ env('PHONE_NUMBER') }}</a>
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
    {{-- <x-front.facilities></x-front.facilities> --}}
    <!-- Testiominals -->
    {{-- <x-front.testimonials></x-front.testimonials> --}}
    <!-- Services -->
    {{-- <x-front.services></x-front.services> --}}
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
</div>
