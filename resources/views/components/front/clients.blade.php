<section class="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="owl-carousel owl-theme">
                    @foreach ($partners as $partner)
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ $partner->logo_url }}" alt=""></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
