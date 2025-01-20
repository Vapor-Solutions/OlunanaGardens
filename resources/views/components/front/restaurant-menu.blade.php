<section id="menu" class="restaurant-menu menu section-padding bg-blck">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-subtitle"><span>Olunana Gardens</span></div>
                <div class="section-title"><span>Restaurant Menu</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="tabs-icon col-md-10 offset-md-1 text-center">
                        <div class="owl-carousel owl-theme">
                            @foreach ($menuCategories as $key => $category)
                                <div id="tab-{{ $key + 1 }}" class="{{ $key == 0 ? 'active' : '' }} item">
                                    <h6>{{ $category->title }}</h6>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="restaurant-menu-content col-md-12">
                        <!-- Starters -->
                        @foreach ($menuCategories as $key => $category)
                            <div id="tab-{{ $key + 1 }}-content" class="cont {{ $key == 0 ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-5">
                                        @foreach ($category->menuItems as $key => $item)
                                            @if ($key % 2 == 0)
                                                <div class="menu-info">
                                                    <h5>{{ $item->title }}
                                                        <span class="price">
                                                            <x-currency></x-currency>{{ number_format($item->price, 2) }}
                                                        </span>
                                                    </h5>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                        @foreach ($category->menuItems as $key => $item)
                                            @if ($key % 2 != 0)
                                                <div class="menu-info">
                                                    <h5>{{ $item->title }}
                                                        <span class="price">
                                                            <x-currency></x-currency>{{ number_format($item->price, 2) }}
                                                        </span>
                                                    </h5>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        $('.restaurant-menu .owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            autoplay: false,
            dots: false,
            nav: true,
            navText: ["<span class='lnr ti-angle-left'></span>", "<span class='lnr ti-angle-right'></span>"],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4
                }
            }
        });

        // Restaurant Menu Tabs
        $(".restaurant-menu .tabs-icon").on("click", ".item", function() {
            $(".item").removeClass("active");
            var myID = $(this).attr("id");
            $(".restaurant-menu .cont").hide();
            $("#" + myID + "-content").fadeIn();
        });
        $(".restaurant-menu .tabs-icon").on("click", ".owl-item", function() {
            $(this).addClass("actived").siblings().removeClass("actived");
        });
    </script>
@endpush
