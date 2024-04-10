<div>
    <div class="booking-box">
        <div class="head-box">
            <h4>Booking Form</h4>
        </div>
        <div class="booking-inner clearfix mb = 5" >
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
                                <input type="datetime-local" wire:model='bookingRequest.start_time' class="form-control"
                                    placeholder="Event Date" required>
                                @error('bookingRequest.start_time')
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



                    <div class="col-md-6">
                        <div class="">
                            <div class=" mb-3 input1_inner">
                                <label>Adults</label>
                                <input type="number" wire:model='bookingRequest.capacity_adults' class="form-control "
                                    placeholder="Adults">
                                @error('bookingRequest.capacity_adults')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 input1_inner">
                            <label>Children</label>
                            <input type="number" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Children"
                                wire:model='bookingRequest.capacity_children'>
                            @error('bookingRequest.capacity_children')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <select wire:model="bookingRequest.event_type_id" class="form-control" name="event_type_id"
                            id="event_type_id" required>
                            <option value="">Choose the event type</option>
                            @foreach ($eventTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                        @error('bookingRequest.event_type_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select wire:model="bookingRequest.package_id" class="form-control" name="package_id"
                            id="package_id" required>
                            <option value="">Choose the Menu Package</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->title }} -
                                    <x-currency></x-currency>{{ number_format($package->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('bookingRequest.package_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter Your Alias" wire:model='client_name'>
                            @error('client_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter Your Email Address"
                                wire:model='client_email'>
                            @error('client_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Country/Nationality</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter your Residing Country"
                                wire:model='client_country'>
                            @error('client_country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3 input1_inner">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="Enter Your Phone Number"
                                wire:model='client_phone_number'>
                            @error('client_phone_number')
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