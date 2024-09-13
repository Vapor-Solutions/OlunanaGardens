<div><!-- Restaurant Menu -->
    <section id="menu" class="restaurant-menu menu section-padding bg-blck">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-subtitle"><span>OluNana Gardens</span></div>
                    <div class="section-title"><span>Restaurant Menu</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="tabs-icon col-md-10 offset-md-1 text-center mb-5">
                            <div class="d-flex flex-row justify-content-center owl-theme" wire:ignore.self>
                                @if ($menuCategories)
                                    @foreach ($menuCategories as $category)
                                        <div id="{{ $category->id }}"
                                            class="{{ $active == $category->id ? 'active' : '' }} item">
                                            <h6 wire:click="activate({{ $category->id }})">{{ $category->title }}</h6>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="restaurant-menu-content col-md-12">
                            <!-- Starters -->
                            <div id="{{ $active }}-content" class="cont active">
                                <div class="row">
                                    <div class="d-flex flex-row justify-content-center flex-wrap">
                                        @foreach ($menuItems as $key => $item)
                                            @if ($item->menu_category_id == $active)
                                                <div class="menu-info flex-col col-5 {{ $key % 2 == 0 ? '' : 'mx-5' }}">
                                                    <h5>{{ $item->title }}
                                                        <span class="price">
                                                            <x-currency></x-currency>{{ $item->price }}
                                                        </span>
                                                    </h5>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="butn-light mb-30 mt-30 text-center">
                    <a href="{{ route('menu.download') }}" class="">VIEW FULL MENU</a>
                </div> --}}
            </div>
        </div>
    </section>
</div>
