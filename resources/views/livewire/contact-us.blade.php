<div>
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="3"
        data-background="img/slider/5.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5>Get in touch</h5>
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact -->
    <section class="contact section-padding">
        <div class="container">
            <div class="row mb-90">
                <div class="col-md-6 mb-60">
                    <h3>OluNana Gardens</h3>
                    {!! File::get(public_path('/text/contact_us_content.txt')) !!}
                    <div class="reservations mb-30">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:{{ env('PHONE_NUMBER') }}">{{ env('PHONE_NUMBER') }}</a>
                        </div>
                    </div>
                    <div class="reservations mb-30">
                        <div class="icon"><span class="flaticon-envelope"></span></div>
                        <div class="text">
                            <p>Email Info</p> <a href="mailto:{{ env('COMPANY_EMAIL') }}">{{ env('COMPANY_EMAIL') }}</a>
                        </div>
                    </div>
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-location-pin"></span></div>
                        <div class="text">
                            <p>Address</p> {{ env('COMPANY_ADDRESS') }}
                            <br>{{ env('COMPANY_COUNTRY') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-30 offset-md-1">
                    <h3>Get in touch</h3>
                    <form method="post" class="contact__form" action="mail.php">
                        <!-- form message -->
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success contact__msg" style="display: none" role="alert">
                                    Your message was sent successfully.
                                </div>
                            </div>
                        </div>
                        <!-- form elements -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name="name" type="text" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="email" type="email" placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="phone" type="text" placeholder="Your Number *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="subject" type="text" placeholder="Subject *" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="butn-dark2"><span>Send Message</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Map Section -->
            <div class="row">
                <div class="col-md-12 map animate-box" data-animate-effect="fadeInUp">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7901.069050431023!2d37.21473682843527!3d-1.325571234797032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f6313f3e9f7cd%3A0x10676085ed14df4a!2sOluNana%20Gardens%20Koma!5e0!3m2!1sen!2ske!4v1708379511959!5m2!1sen!2ske"
                        width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
