<div>
    <div class="booking-box">
        <div class="head-box">
            <h4>Booking Form</h4>
        </div>
        <div class="booking-inner clearfix">
            <div class="form1 clearfix">
                <div class="row">
                    <div class="col-md-12">

                        @if ($dateNotAvailable)
                            <span class="text-danger">The event choosen is not available for booking on this
                                date and time</span>
                            @endif
                        {{-- @else
                            <span class="text-success">The event choosen is available for booking on this
                                date and time</span>
                        @endif --}}

                        <div class="">
                            <div class="mb-3 input1_inner">
                                <label>Booking Date</label>
                                <input type="date" wire:model='bookingRequest.date' class="form-control"
                                    placeholder="Event Date" required>
                                @error('bookingRequest.date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <div class="mb-3">
                            <label for="" class="form-label">Event Type</label>
                            <select wire:model="bookingRequest.event_type_id" class="form-control" name="" id="">
                                <option selected>Choose the event type</option>
                                @foreach ($eventTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                            @error('bookingRequest.event_type_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="mb-3">
                        <select wire:model="bookingRequest.event_type_id" class="form-control" name="event_type_id" id="event_type_id" required>
                            <option value="">Choose the event type</option>
                            @foreach ($eventTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="col-md-6">
                        <div class="">
                            <div class=" mb-3 input1_inner">
                                <label>Adults</label>
                                <input type="number" wire:model='bookingRequest.adults' class="form-control "
                                    placeholder="Adults">
                                @error('bookingRequest.adults')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 input1_inner">
                            <label>Children</label>
                            <input type="number" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Children" wire:model='bookingRequest.children'>
                            @error('bookingRequest.children')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter Your Alias" wire:model='bookingRequest.client_name'>
                            @error('bookingRequest.client_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter Your Email Address"
                                wire:model='bookingRequest.client_email'>
                            @error('bookingRequest.client_email')
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
