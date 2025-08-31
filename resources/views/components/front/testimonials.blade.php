<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/7.jpg?{{ time() }}" data-overlay-dark="3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="testimonials-box">
                        <div class="head-box">
                            <h6>Testimonials</h6>
                            <h4>What Client's Say?</h4>
                            <div class="line"></div>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                                <div class="item">
                                    <span class="quote"><img src="img/quot.png" alt=""></span>
                                    <p>{{ $testimonial->comment }}</p>
                                    <div class="info">
                                        <div class="author-img"> <img src="{{ $testimonial->client->profile_photo_url }}" alt=""> </div>
                                        <div class="cont">
                                            <h6>{{ $testimonial->client->name }}</h6> <span>Guest review</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
