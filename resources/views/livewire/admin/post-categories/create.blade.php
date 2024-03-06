<div>
    <x-slot name="header">
        Blog Categories
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>
                    Create a New Blog Category
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-5">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" wire:model="blog_category.title" name="name" id="name"
                                class="form-control" placeholder="Enter Blog Category Title" aria-describedby="name">
                            <small id="name" class="text-muted">Enter Blog Category Title</small><br>
                            @error('blog_category.title')
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
