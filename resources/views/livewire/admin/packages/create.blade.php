<div>
    <x-slot:header>
        Packages
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>
                    Create a Package
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" wire:model="package.title" name="name" id="name"
                                class="form-control" placeholder="Enter Package Title" aria-describedby="name">
                            @error('package.title')
                                <small id="name" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Price</label>
                            <input type="number" step="1" wire:model='package.price' min="1"
                                class="form-control" name="" id="" aria-describedby="helpId"
                                placeholder="Enter the Price" />
                            @error('package.price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Description</label>
                            <textarea type="text" wire:model="package.description" name="description" id="description" class="form-control"
                                placeholder="Enter Package Description" aria-describedby="description"></textarea>
                            @error('package.description')
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
