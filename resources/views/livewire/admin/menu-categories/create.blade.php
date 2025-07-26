<div>
    <x-slot:header>Create Menu Category</x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>Create a Menu Category</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" wire:model.live='menuCategory.title' aria-describedby="helpId"
                            placeholder="Enter your Menu Category Title">
                        @error('menuCategory.title')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button wire:click='save' class="btn btn-dark text-uppercase">Save</button>
        </div>
    </div>
</div>
