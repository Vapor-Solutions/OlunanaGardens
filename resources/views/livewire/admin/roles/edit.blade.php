<div>
    <div class="container-fluid">
        <x-slot:header>Edit This Role ({{ $role->title }})</x-slot:header>

        <div class="card">
            <div class="card-header">
                <h5>Edit This Role</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input wire:model.live="role.title" type="text" class="form-control" name="title"
                                id="title" aria-describedby="title" placeholder="Enter the Title of Your Role">
                            @error('role.title')
                                <small id="title" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="permissions">Select Your Permissions</label>
                        <br>
                        @foreach (App\Models\Permission::all() as $permission)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" wire:model.live="permissions" id="" value="{{ $permission->id }}">
                                <label class="form-check-label" for="">{{ $permission->title }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button wire:click="save" class="btn btn-dark text-uppercase"> Save</button>
            </div>
        </div>
    </div>
</div>
