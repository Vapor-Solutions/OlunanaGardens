<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4"
        data-background="img/banners/about.jpg?{{ time() }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption mt-90">
                    <h5>Discover OluNana Gardens</h5>
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <span>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                    </span>
                    <div class="section-subtitle">OluNana Gardens</div>
                    <div class="section-title">Get to Know Us</div>
                    {!! File::get(public_path('/text/about_content1.txt')) !!}
                    <!-- reservation -->
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:{{ env('PHONE_NUMBER') }}">{{ env('PHONE_NUMBER') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6 animate-box" data-animate-effect="fadeInUp"> <img src="/olunana/img/18.jpg"
                                alt="" class="mt-90 mb-30">
                        </div>
                        <div class=" col-6 animate-box" data-animate-effect="fadeInUp"> <img src="/olunana/img/17.jpg"
                                alt="">
                        </div>
                        <div class="col-6 animate-box" data-animate-effect="fadeInUp"> <img src="/olunana/img/11.jpg"
                                alt="" class="mt-90 mb-30">
                        </div>
                        <div class=" col-6 animate-box" data-animate-effect="fadeInUp"> <img src="/olunana/img/23.jpg"
                                alt="">
                        </div>
                        <div class=" col-12 animate-box" data-animate-effect="fadeInUp"> <img src="/olunana/img/24.jpg"
                                alt="" class="mt-90 mb-30">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-front.services2></x-front.services2>
    <x-front.facilities></x-front.facilities>
    @if ($testimonials)
        <x-front.testimonials></x-front.testimonials>
    @endif
</div>
