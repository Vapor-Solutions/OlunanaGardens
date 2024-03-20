<div>
    <div class="booking-box">
        <div class="head-box">
            <h4>Booking Form</h4>
        </div>
        <div class="booking-inner clearfix">
            <div class="form1 clearfix">
                <div class="row">




                    <div class="col-md-12">
                        {{-- @if ($bookingIsAvailable) --}}
                            <div class="col-md-12">

                                <div class="col-12">
                                    <div class="mb-3 input1_inner">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Enter Your Name"
                                            wire:model='event.client_name'>
                                        @error('event.client_name')
                                            <small class="text-danger">{{ $message }}</small>
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
                        {{-- @endif --}}
                        
                            <div class="">
                                <div class="mb-3 input1_inner">
                                    <label for="startDate" class="form-label">Booking Date</label>
                                    <input type="datetime-local" wire:model="event.date"
                                        min="{{ Carbon\Carbon::now()->addDay()->toDateTimeString() }}"
                                        class="form-control" name="startDate" id="startDate"
                                        aria-describedby="startDate">
                                    @error('event.date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <select wire:model="eventType" class="form-control" required>
                                    <option value="">Choose the event type</option>
                                    @foreach ($eventTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->title }}</option>
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
