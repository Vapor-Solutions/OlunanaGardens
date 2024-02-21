<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-column footer-about">
                        <h3 class="footer-title">About Olunana Gardens</h3>
                        {!! File::get(public_path('/text/footer_content.txt')) !!}


                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div class="footer-column footer-explore clearfix">
                        <h3 class="footer-title">Explore</h3>
                        <ul class="footer-explore-list list-unstyled">
                            <li><a href="/">Home</a></li>
                            <li><a href="/about">About</a></li>
                            <li><a href="/blog">Our Blog</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column footer-contact">
                        <h3 class="footer-title">Contact</h3>
                        <p class="footer-contact-text">
                            {{ env('COMPANY_ADDRESS') }}<br>{{ env('COMPANY_COUNTRY') }}
                        </p>
                        <div class="footer-contact-info">
                            <p class="footer-contact-phone"><span class="flaticon-call"></span> {{ env('PHONE_NUMBER') }}
                            </p>
                            <p class="footer-contact-mail">{{ env('COMPANY_EMAIL') }}</p>
                        </div>
                        <div class="footer-about-social-list">
                            @if (env('INSTAGRAM_URL'))
                                <a href="{{ env('INSTAGRAM_URL') }}"><i class="ti-instagram"></i></a>
                            @endif
                            @if (env('TWITTER_URL'))
                                <a href="{{ env('TWITTER_URL') }}"><i class="ti-twitter"></i></a>
                            @endif
                            @if (env('YOUTUBE_URL'))
                                <a href="{{ env('YOUTUBE_URL') }}"><i class="ti-youtube"></i></a>
                            @endif
                            @if (env('FACEBOOK_URL'))
                                <a href="{{ env('FACEBOOK_URL') }}"><i class="ti-facebook"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-inner">
                        <p class="footer-bottom-copy-right">© Copyright {{ Carbon\Carbon::now()->format('Y') }} by
                            <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
