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
                        {{-- <x-front.booking-form></x-front.booking-form> --}}
                        <div class="col-md-5">
                            @livewire('front.booking-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- arrow down -->
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </aside>
    <section class="about section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <span>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                    </span>
                    <div class="section-subtitle">The OluNana Gardens</div>
                    <div class="section-title">Your Green Oasis for Memorable Occasions</div>

                    <h5>Why Choose Our Gardens Venue?</h5>
                    {{-- {!! File::get('text/home_content.txt') !!} --}}

                    <!-- call -->
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:{{ env('PHONE_NUMBER') }}">{{ env('PHONE_NUMBER') }}</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp">
                    <img src="olunana/img/19.jpg" alt="" class="mt-90 mb-30">
                </div> --}}
                <div class="col col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <img src="olunana/img/13.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    @livewire('front.blog')
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/2.jpg"
            data-overlay-dark="2">
            <div class="container">
                <div class="row">
                    <!-- Reservation -->
                    <div class="col-md-7 mb-30 mt-30">
                        <p><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i
                                class="star-rating"></i><i class="star-rating"></i></p>
                        <h5>Embrace Tranquility and Luxury Amidst Nature's Splendor at Olunana Gardens</h5>
                        <div class="reservations mb-30">
                            <div class="icon color-1"><span class="flaticon-call"></span></div>
                            <div class="text">
                                <p class="color-1">Reservation</p> <a class="color-1" href="tel:{{ env('PHONE_NUMBER') }}">{{ env('PHONE_NUMBER') }}</a>
                            </div>
                        </div>
                        <p><i class="ti-check"></i><small>Call us, it's toll-free.</small></p>
                    </div>
                    <!-- Booking From -->
                    {{-- <x-front.booking-form></x-front.booking-form> --}}
                    <div class="col-md-5">
                        @livewire('front.booking-form')
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- Clients -->
    {{-- <x-front.clients></x-front.clients> --}}
</div>
