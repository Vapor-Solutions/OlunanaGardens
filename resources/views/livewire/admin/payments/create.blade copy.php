<div>
    <div>
        <x-slot name="header">
            Booking Payments
        </x-slot>


        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>Register a New Payment</h5>
                </div>
                <div class="card-body">


                    <form action="#" wire:submit="pushMPESA" wire:ignore.self>
                        @csrf


                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-5">
                                    <label for="client" class="form-label">Event Type</label>
                                    <select class="form-control" wire:model.live="selectedEventType" name="client" id="">
                                        <option selected>Select Event To Be Paid For</option>
                                        @foreach ($event_types as $event_type)
                                        <option value="{{ $event_type->id }}">{{ $event_type->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedEventType')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-5">
                                    <label for="client" class="form-label">Client Name</label>
                                    <select class="form-control" wire:model.live="selectedClient" name="client" id="">
                                        <option value="">Select the Client</option>
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedClient')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="package_id" class="form-label">Package</label>
                                    <select wire:model.live="selectedPackage" class="form-control" name="package_id" id="package_id">
                                        <option selected>Choose the Sections to Book</option>
                                        {{-- You can populate this dropdown based on logic --}}
                                    </select>
                                    @error('selectedPackage')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-5">
                                    <label for="client" class="form-label">Payment Method</label>
                                    <select class="form-control" wire:model.live="payment_method_id" name="client" id="">
                                        <option selected>Select a Payment Method</option>
                                        @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}">{{ $payment_method->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_method_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-5">
                                    <label for="" class="form-label">Price</label>
                                    <input type="number" min="1" step="0.05" wire:model.live="selectedPrice" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Enter Amount To Be Paid" />
                                    @error('selectedPrice')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="mb-5">
                                    <label for="name" class="form-label">Reference Code</label>
                                    <input type="text" wire:model.live="reference_code" name="name" id="name" class="form-control" placeholder="Reference Code" aria-describedby="name">
                                    @error('reference_code')
                                    <small id="name" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-5">
                                <label for="name" class="form-label">Phone Number</label>
                                <input type="text" wire:model.live="phone_number" name="name" id="name"
                                    class="form-control" placeholder="Reference Code" aria-describedby="name">
                                @error('phone_number')
                                    <small id="name" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary">Submit</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
