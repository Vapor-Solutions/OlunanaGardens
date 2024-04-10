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
                            @error('event_type.title')
                                <small id="name" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-5">
                            <label for="name" class="form-label">Price</label>
                            <input type="text" wire:model="event_type.price" name="name" id="name"
                                class="form-control" placeholder="Enter Event's Price" aria-describedby="name">
                            @error('event_type.price')
                                <small id="name" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea wire:model='event_type.description' class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Image Thumbnail <small>(Ratio = 7:4)</small></label>
                            <input type="file" wire:model='thumbnail' class="form-control" name="" id="" placeholder=""
                                aria-describedby="fileHelpId" />
                            @error('thumbnail')
                                <div id="fileHelpId" class="form-text text-danger">{{ $message }}</div>
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
