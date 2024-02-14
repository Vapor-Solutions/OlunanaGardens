<div>
    <x-slot name="header">
        Bookings
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Edit This Booking</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="client" class="form-label">Client</label>
                            <select class="form-control" wire:model="booking.client_id" name="client" id="">
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
                            <label for="check_in" class="form-label">Check In Date</label>
                            <input type="date" wire:model="booking.check_in"
                                min="{{ Carbon\Carbon::now()->toDateString() }}" class="form-control" name="check_in"
                                @if ($booking->check_out) max="{{ Carbon\Carbon::parse($booking->check_out)->subDay()->toDateString() }}" @endif
                                id="check_in" aria-describedby="check_in">
                             @error('booking.check_in')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check Out Date</label>
                            <input type="date" wire:model="booking.check_out"
                                min="{{ Carbon\Carbon::now()->addDay()->toDateString() }}" class="form-control"
                                name="check_out" id="check_out" aria-describedby="check_out">
                             @error('booking.check_out')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">City</label>
                            <select wire:model="type_id" class="form-control" name="" id="">
                                <option selected>CHOOSE THE ROOM TYPE</option>
                                @foreach ($room_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                             @error('type_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Room</label>
                            <select wire:model="booking.room_id" class="form-control" name="room_id" id="room_id">
                                <option selected>CHOOSE THE ROOM TO BOOK</option>
                                @foreach ($rooms as $room)
                                        @if (isset($type_id) && $room->room_type_id == $type_id)
                                            <option @if($room->isBookedBetween($booking->check_in, $booking->check_out)) disabled @endif value="{{ $room->id }}">
                                                {{ $room->room_number }}</option>
                                        @endif
                                @endforeach
                            </select>
                             @error('booking.room_id')
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
