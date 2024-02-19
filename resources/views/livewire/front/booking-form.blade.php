<div>
    <div class="booking-box">
        <div class="head-box">
            <h4>Booking Form</h4>
        </div>
        <div class="booking-inner clearfix">
            <div class="form1 clearfix">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="mb-3 input1_inner">
                                <label>Booking Date</label>
                                <input type="date" wire:model='event.date' class="form-control"
                                    placeholder="Event Date" required>
                                @error('event.date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            <div class=" mb-3 input1_inner">
                                <label>Adults</label>
                                <input type="number" wire:model='event.adults' class="form-control "
                                    placeholder="Adults">
                                @error('event.adults')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 input1_inner">
                            <label>Children</label>
                            <input type="number" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Children" wire:model='event.children'>
                            @error('event.children')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter Your Alias" wire:model='event.client_name'>
                            @error('event.client_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter Your Email Address"
                                wire:model='event.client_email'>
                            @error('event.client_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button wire:click='checkAvailability' class="btn-form1-submit mt-15">Check
                            Availability</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
