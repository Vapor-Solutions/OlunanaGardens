<div>
    <x-slot name="header">
        <h5>Bookings</h5>
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Add a new Booking</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="client" class="form-label">Client</label>
                            <select class="form-control" wire:model.live="booking.client_id" name="client" id="">
                                <option selected>CHOOSE YOUR CLIENT</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('booking.client_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Event Type</label>
                            <select wire:model.live="booking.event_type_id" class="form-control" name=""
                                id="">
                                <option selected>CHOOSE THE EVENT TYPE</option>
                                @foreach ($eventTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                            @error('booking.event_type_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Starting Date & Time</label>
                            <input type="datetime-local" wire:model.live="booking.start_time"
                                min="{{ Carbon\Carbon::now()->toDateTimeString() }}" class="form-control"
                                name="start_time"
                                @if ($booking->end_time) max="{{ Carbon\Carbon::parse($booking->end_time)->subDay()->toDateString() }}" @endif
                                id="start_time" aria-describedby="start_time">
                            @error('booking.start_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">Ending Date & Time</label>
                            <input type="datetime-local" wire:model.live="booking.end_time"
                                min="{{ Carbon\Carbon::now()->addDay()->toDateTimeString() }}" class="form-control"
                                name="end_time" id="end_time" aria-describedby="end_time">
                            @error('booking.end_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>



                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Number of Adults</label>
                            <input type="number" step="1" wire:model.live='booking.capacity_adults' min="1"
                                class="form-control" name="" id="" aria-describedby="helpId"
                                placeholder="Enter Your Adult Capacity" />
                            @error('booking.capacity_adults')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Number of Children</label>
                            <input type="number" step="1" wire:model.live='booking.capacity_children' min="1"
                                class="form-control" name="" id="" aria-describedby="helpId"
                                placeholder="Enter Your Child Capacity" />
                            @error('booking.capacity_children')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Sections</label>
                            <select multiple="multiple" wire:model.live="selectedSections" class="form-control"
                                name="room_id" id="room_id">
                                <option selected>Choose the Sections to Book</option>
                                @foreach ($sections as $section)
                                    <option @if ($section->isBookedBetween($booking->start_time, $booking->end_time)) disabled @endif
                                        value="{{ $section->id }}">
                                        {{ $section->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedSections')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="package_id" class="form-label">Package</label>
                            <select wire:model.live="booking.package_id" class="form-control" name="package_id"
                                id="package_id">
                                <option selected>Choose the Package to Book</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">
                                        {{ $package->title }} @ KES {{ $package->price }} per person</option>
                                @endforeach
                            </select>
                            @error('selectedSections')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Price</label>
                            <input type="number" min="1" step="0.05" wire:model.live="booking.price"
                                class="form-control" name="" id="" aria-describedby="helpId"
                                placeholder="Enter Agreed Price Per Person" />
                            @error('booking.price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" wire:click='save'>submit</button>
            </div>
        </div>
    </div>
</div>
