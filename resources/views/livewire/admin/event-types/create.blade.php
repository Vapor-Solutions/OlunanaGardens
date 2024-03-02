<div>
    <x-slot name="header">
        Event Types
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>
                    Create a New Event Type
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-5">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" wire:model="event_type.title" name="name" id="name"
                                class="form-control" placeholder="Enter Event's Title" aria-describedby="name">
                            <small id="name" class="text-muted">Enter Event's Title</small><br>
                            @error('event_type.title')
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
