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
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column footer-contact">
                        <h3 class="footer-title">Contact</h3>
                        <p class="footer-contact-text">121314 - 00400<br>Nairobi Kenya
                        </p>
                        <div class="footer-contact-info">
                            <p class="footer-contact-phone"><span class="flaticon-call"></span> +254 712 345 678
                            </p>
                            <p class="footer-contact-mail">info@olunanagardens.com</p>
                        </div>
                        <div class="footer-about-social-list">
                            <a href="#"><i class="ti-instagram"></i></a>
                            <a href="#"><i class="ti-twitter"></i></a>
                            <a href="#"><i class="ti-youtube"></i></a>
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
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
                            <a href="#">Vapor Technologies (www.vapor.co.ke)</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
