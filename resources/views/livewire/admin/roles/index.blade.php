<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">List of Roles </div>
            <div class="card-body table-responsive" style="max-height:600px">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Role Title</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Number of Users</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr class="">
                                <td scope="row">{{ $role->id }}</td>
                                <td>{{ $role->title }}</td>
                                <td>
                                    <ul class="row">
                                        @foreach ($role->permissions as $permission)
                                            <li class="col-2"><small>{{ $permission->title }}</small></li>
                                        @endforeach

                                    </ul>
                                </td>
                                <td>
                                    {{ count($role->users) }} Users
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <a href="{{ route('admin.roles.edit', $permission->id) }}"
                                            class="btn btn-dark flex-col mx-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button
                                            onclick="confirm('Are you Sure you want to delete this Role?')||event.stopImmediatePropagation()"
                                            wire:click="delete({{ $role->id }})"
                                            class="btn btn-danger flex-col mx-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
