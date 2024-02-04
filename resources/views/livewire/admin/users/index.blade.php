<div>
    <div class="container-fluid">
        <x-slot:header>
            Users list
        </x-slot:header>
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="">
                                <td scope="row">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td><strong>{{ $user->email }}</strong></td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <li>{{ $role->title }}</li>
                                    @endforeach
                                </td>
                                <td class="d-flex flex-row justify-content-center">
                                    <div class="flex-col mx-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="flex-col mx-2">
                                        <button class="btn btn-danger"
                                            onclick="confirm('Are you Sure You want to delete this User?')||event.stopImmediatePropagation()"
                                            wire:click="delete({{ $user->id }})"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
