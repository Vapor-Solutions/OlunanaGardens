<div>
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4"
        data-background="olunana/img/13.jpg" wire:ignore>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5>Hotel Blog</h5>
                    <h1>Our News</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- News  -->
    <section class="news section-padding bg-blck">
        @if (count($posts) > 0)
        <div class="container">
            <div class="row">
                @foreach ($posts as $post)

                <div wire:key='post-{{ $post->id }}' class="col-md-4 mb-30">
                    <div class="item">
                        <div class="position-re o-hidden"> <img class="img-fluid" width="900" height="1200" src="{{ asset($post->blog_photo_url) }}" alt="">
                            <div class="date">
                                <a href="{{ route('blog-post', $post->id) }}">
                                    <span>{{ Carbon\Carbon::parse($post->created_at)->format('M') }}</span>
                                    <i>{{ Carbon\Carbon::parse($post->created_at)->format('d') }}</i> </a>
                            </div>
                        </div>
                        <div class="con"> <span class="category">
                                <a href="javascript:void(0)">{{ $post->category?->title }}</a>
                            </span>
                            <h5><a href="{{ route('blog-post', $post->id) }}">{{ $post->title }}</a></h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $posts?->links('vendor.livewire.cappa',['scrollTo'=>false]) }}
                </div>
            </div>
        </div>
        @else
        <h1 class="text-center text-muted">No Posts Yet</h1>
        @endif
    </section>

    <section class="testimonials" wire:ignore>
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
    <x-front.clients></x-front.clients>
</div>
