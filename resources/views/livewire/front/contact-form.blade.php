<div >
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
            <input wire:model='name' name="name" type="text" placeholder="Your Name *" required>
        </div>
        <div class="col-md-6 form-group">
            <input wire:model='email' name="email" type="email" placeholder="Your Email *" required>
        </div>
        <div class="col-md-6 form-group">
            <input wire:model='phone' name="phone" type="text" placeholder="Your Number *" required>
        </div>
        <div class="col-md-6 form-group">
            <input wire:model='subject' name="subject" type="text" placeholder="Subject *" required>
        </div>
        <div class="col-md-12 form-group">
            <textarea wire:model='body' name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
        </div>
        <div class="col-md-12">
            <button wire:click='send' class="butn-dark2"><span>Send Message</span></button>
        </div>
    </div>
</div>
