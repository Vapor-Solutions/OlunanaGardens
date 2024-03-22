{{-- <div>
    <div class="booking-box">
        <div class="head-box">
            <h4>Booking Form</h4>
        </div>
        <div class="booking-inner clearfix">
            <div class="form1 clearfix">
                <div class="row">
                    <div class="col-md-12">
                        @if ($bookingIsAvailable)
                            <div class="col-md-12">
                                <div class="col-12">
                                    <div class="mb-3 input1_inner">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Enter Your Name"
                                            wire:model='event.name'>
                                        @error('event.name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-5">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input wire:model="client.phone_number" type="text" name="phone_number" id=""
                                            class="form-control" placeholder="Enter Client's Phone Number" aria-describedby="name">
                                        <small id="phone_number" class="text-muted">Enter Client's Phone Number</small><br>
                                        @error('client.phone_number')
                                            <small id="phone_number" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-5">
                                        <label for="country" class="form-label">Country/Nationality</label>
                                        <input wire:model="client.country" type="text" name="country" id=""
                                            class="form-control" placeholder="Enter Client's Country" aria-describedby="name">
                                        <small id="country" class="text-muted">Enter Client's Residing Country</small><br>
                                        @error('client.country')
                                            <small id="country" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-5">
                                        <label for="address" class="form-label">Physical Address</label>
                                        <textarea wire:model='client.address' placeholder="Enter Client's Physical Address" class="form-control" name="address2" id="address2" rows="2"></textarea>
                                        @error('client.address')
                                            <small id="address2" class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                            aria-describedby="helpId" placeholder="Children"
                                            wire:model='event.children'>
                                        @error('event.children')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="">
                            <div class="mb-3 input1_inner">
                                <label for="startDate" class="form-label">Booking Date</label>
                                <input type="datetime-local" wire:model="event.start_time"
                                    min="{{ Carbon\Carbon::now()->addDay()->toDateTimeString() }}" class="form-control"
                                    name="startTime" id="startTime" aria-describedby="startTime">
                                @error('event.start_time')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <select wire:model="event.event_type_id" class="form-control" required>
                                <option value="">Choose the event type</option>
                                @foreach ($eventTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select wire:model="event.event_type_id" class="form-control" required>
                                <option value="">Choose your package</option>
                                @foreach ($packageTypes as $package)
                                    <option value="{{ $package->id }}">{{ $package->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="mb-3 input1_inner">
                                <label for="" class="form-label">Email Address</label>
                                <input type="text" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="Enter Your Email Address"
                                    wire:model='event.email'>
                                @error('event.email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if ($bookingIsAvailable)
                        <div class="col-md-12">
                            <button wire:click='book' class="btn-form1-submit mt-15">Book now
                            </button>
                        </div>
                    @else
                        <div class="col-md-12">
                            <button wire:click='checkAvailability' class="btn-form1-submit mt-15">Check
                                Availability</button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div> --}}

<div>
    <div class="booking-box">
        <div class="head-box">
            <h4>Booking Form</h4>
        </div>
        <div class="booking-inner clearfix">
            <div class="form1 clearfix">
            
                @if ($noBooking)
                    <p class="text-danger">no booking</p>
                @endif
                @if ($bookingIsAvailable)
                    {{-- give  me a booking form --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 input1_inner">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="helpId" placeholder="Enter Your Name" wire:model='event.name'>
                                @error('event.name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 input1_inner">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number"
                                    aria-describedby="helpId" placeholder="Enter Your Phone Number"
                                    wire:model='event.phone_number'>
                                @error('event.phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="mb-3 input1_inner">
                                    <label for="" class="form-label">Email Address</label>
                                    <input type="text" class="form-control" name="" id=""
                                        aria-describedby="helpId" placeholder="Enter Your Email Address"
                                        wire:model='event.email'>
                                    @error('event.email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3 input1_inner">
                                    <label for="country" class="form-label">Country/Nationality</label>
                                    <input wire:model="client.country" type="text" name="country" id=""
                                        class="form-control" placeholder="Enter Client's Country"
                                        aria-describedby="name">
                                    <small id="country" class="text-muted">Enter Client's Residing Country</small><br>
                                    @error('client.country')
                                        <small id="country" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3 input1_inner">
                                    <label for="address" class="form-label">Physical Address</label>
                                    <textarea wire:model='client.address' placeholder="Enter Client's Physical Address" class="form-control" name="address2"
                                        id="address2" rows="2"></textarea>
                                    @error('client.address')
                                        <small id="address2" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 input1_inner">
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

                            <div class="mb-3 input1_inner">
                                <select wire:model="event.event_type_id" class="form-control" required>
                                    <option value="">Choose your package</option>
                                    @foreach ($packageTypes as $package)
                                        <option value="{{ $package->id }}">{{ $package->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    @if ($bookingIsAvailable)
                        <button wire:click="book" class="btn-form1-submit mt-15">Book Now</button>
                    @endif
                @else
                    {{-- form to check for availability of a booking --}}
                 
                    <div class="mb-3 input1_inner">
                        <label for="startDate" class="form-label">Booking Date</label>
                        <input type="datetime-local" wire:model="event.start_time"
                            min="{{ Carbon\Carbon::now()->addDay()->toDateTimeString() }}" class="form-control"
                            name="startTime" id="startTime" aria-describedby="startTime">
                        @error('event.start_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 input1_inner">
                        <label for="End Date" class="form-label">Booking Date</label>
                        <input type="datetime-local" wire:model="event.end_time"
                            min="{{ Carbon\Carbon::now()->addDay()->toDateTimeString() }}" class="form-control"
                            name="startTime" id="startTime" aria-describedby="startTime">
                        @error('event.end_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select wire:model="event.event_type_id" class="form-control" required>
                            <option value="">Choose the event type</option>
                            @foreach ($eventTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                        @error('event.event_type_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <select wire:model="event.section" class="select2" required>
                            <option value="">Choose your section</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('event.section')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <button wire:click="checkAvailability" class="btn-form1-submit mt-15">Check Availability</button>
                @endif
            </div>
        </div>
    </div>
</div>
