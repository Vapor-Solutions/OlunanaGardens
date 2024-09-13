<div>
    <x-slot:header>Create Menu Item</x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>Create a new Menu Item</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Menu Category</label>
                        <select class="form-control" wire:model='menuItem.menu_category_id' name="" id="">
                            <option selected>Please select your Menu Category</option>
                            @foreach (App\Models\MenuCategory::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('menuItem.menu_category_id')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" wire:model='menuItem.title' aria-describedby="helpId"
                            placeholder="Enter your Menu Item Title">
                        @error('menuItem.title')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="">Price (KES)</label>
                        <input type="number" class="form-control" wire:model='menuItem.price'
                            aria-describedby="helpId">
                        @error('menuItem.price')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="" id="" rows="3" wire:model='menuItem.description'></textarea>
                        @error('menuItem.description')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" wire:model='photo' class="form-control" name="" id=""
                            aria-describedby="helpId">
                        @error('photo')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button wire:click='save' class="btn btn-dark text-uppercase">Save</button>
        </div>
    </div>
</div>
