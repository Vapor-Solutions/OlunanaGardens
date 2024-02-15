<div>

    <div class="container-fluid">
        <x-slot:header name="header">System Users</x-slot:header>
        <div class="card">
            <div class="card-header">
                <h4>Create a new System user</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" wire:model='user.name' class="form-control" name=""
                                id="" aria-describedby="name" placeholder="Enter the First Name">
                            @error('user.first_name')
                                <small id="name" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" wire:model='user.email' class="form-control" name=""
                                id="" aria-describedby="email" placeholder="Enter the Email Address">
                            @error('user.email')
                                <small id="name" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="admin.role_id" class="form-label">Role</label>
                            <select multiple class="form-control" wire:model="roles" name="admin.role_id"
                                id="admin.role_id">
                                @foreach (App\Models\Role::all() as $role)
                                    <option @if (
                                        $role->id == 1 &&
                                            !auth()->user()->hasPermissionTo('Create Admins')) disabled @endif
                                        value="{{ $role->id }}">{{ $role->title }}</option>
                                @endforeach
                            </select>

                            @error('roles')
                                <small id="name" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button wire:click="save" class="btn btn-dark text-uppercase">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
