<div>
    <x-slot name="header">
        Edit Payment Methods
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>
                    Edit {{ $payment_method->title }} Payment Method
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-5">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" wire:model.live="payment_method.title" name="name" id="name"
                                class="form-control" placeholder="Enter Payement Method Title" aria-describedby="name">
                            <small id="name" class="text-muted">Enter Payment Method Title</small><br>
                            @error('payment_method.title')
                                <small id="name" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button wire:click='save' class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
