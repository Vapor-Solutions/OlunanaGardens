<section class="pricing section-padding bg-blck">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="section-subtitle"><span>Best Experience</span></div>
                <div class="section-title"><span>Our Specialities</span></div>
                {!! File::get(public_path('/text/speciality_content.txt')) !!}
                <x-front.reservations></x-front.reservations>
            </div>
            <div class="col-md-8">
                <div class="owl-carousel owl-theme">
                    @foreach ($eventTypes as $type)
                        <div class="pricing-card">
                            <img src="{{ $type->image_path ?? 'img/pricing/1.jpg' }}" alt="">
                            <div class="desc">
                                <div class="name">{{ $type->title }}</div>
                                <div class="amount"><span>from</span>KES{{ number_format($type->price, 0) }}</div>
                                <ul class="list-unstyled list">
                                    {{ $type->description }}
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
