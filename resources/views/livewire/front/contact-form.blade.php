<div>
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
            <input wire:model.live='name' name="name" type="text" placeholder="Your Name *" required>
            @error('name')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <input wire:model.live='email' name="email" type="email" placeholder="Your Email *" >
            @error('email')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <input wire:model.live='phone' name="phone" type="text" placeholder="Your Number *" >
            @error('phone')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <input wire:model.live='subject' name="subject" type="text" placeholder="Subject *" >
            @error('subject')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-12 form-group">
            <textarea wire:model.live='body' name="message" id="message" cols="30" rows="4" placeholder="Message *"></textarea>
            @error('body')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-12">
            <button wire:click='send' class="butn-dark2"><span>Send Message</span></button>
        </div>
    </div>
</div>
