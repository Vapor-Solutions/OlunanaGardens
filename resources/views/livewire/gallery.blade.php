<div>
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4"
        data-background="img/banners/gallery.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5>Images & Videos</h5>
                    <h1>Our Gallery</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Gallery -->
    <section class="section-padding">
        <div class="container">
            <div class="col-md-12">
                <div class="section-subtitle">Images</div>
                <div class="section-title">Image Gallery</div>
            </div>
            @if (count($galleries) <= 0)
                <h3 class="section-title text-center text-uppercase" style="color: #95343F">No Images Uploaded Yet</h3>
            @endif
            @foreach ($event_types as $type)
                @if (count($type->photos) > 0)
                    <h5 class="section-subtitle text-center" style="color: #95343F">{{ $type->title }}</h5>
                @endif
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-4">
                    <!-- 3 columns -->
                    @foreach ($type->photos as $photo)
                        <div class="col gallery-item mosaic-tile ml-1">
                            <a href="{{ asset($photo->image_path) }}" title="" target="_blank" class="img-zoom">
                                <div class="gallery-box">
                                    <div class="gallery-img "> <img src="{{ asset($photo->image_path) }}"
                                            class="img-fluid mx-auto d-block" alt="work-img"> </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            @endforeach
        </div>
    </section>
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/2.jpg?{{ time() }}"
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
</div>
</div>
</div>
