<div>
    <div>
        <x-slot:header>
            Booking Payments
        </x-slot>


        <div class="container-fluid col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Register a New Payment</h5>
                </div>
                <div class="card-body">


                    <form action="#" wire:submit="pushMPESA" wire:ignore.self>
                        @csrf

                        <div class="col-md-12 col-12">
                            <div class="mb-5">
                                <label for="name" class="form-label">Reference Code</label>
                                <input type="text" wire:model="reference_code" name="name" id="name"
                                    class="form-control" placeholder="Reference Code" aria-describedby="name">
                                @error('reference_code')
                                    <small id="name" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="mb-5">
                                <label for="name" class="form-label">Phone Number</label>
                                <input type="text" wire:model="phone_number" name="name" id="name"
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
</div>
