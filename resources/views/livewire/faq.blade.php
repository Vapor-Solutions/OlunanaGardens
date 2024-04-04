<div>
    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4"
        data-background="olunana/img/20.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5>F.A.Qs</h5>
                    <h1>Frequently Asked Questions</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Faqs -->
    <section class="section-padding bg-cream">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="accordion-box clearfix">
                        @if (count($questions) > 0)
                            @foreach ($questions as $faq)
                                <li class="accordion block">
                                    <div class="acc-btn">{{ $faq->question }}</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">{{ $faq->answer }}</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <h1 class="text-center">No FAQs set yet</h1>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </section>

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
                                <p class="color-1">Reservation</p> <a class="color-1"
                                    href="tel:{{ env('PHONE_NUMBER') }}">{{ env('PHONE_NUMBER') }}</a>
                            </div>
                        </div>
                        <p><i class="ti-check"></i><small>Call us.</small></p>
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
</div>
