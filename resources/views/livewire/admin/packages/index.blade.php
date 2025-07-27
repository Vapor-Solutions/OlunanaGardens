<div>
    <x-slot:header>
        Packages
    </x-slot>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Packages</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price(Ksh)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td scope="row">{{ $package->id }}</td>
                                <td>{{ $package->title }}</td>
                                <td>{{ $package->description }}</td>
                                <td>{{ $package->price }}</td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="flex-col mx-1"><button
                                            wire:click='delete({{ $package->id }})'class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $packages->links() }}
            </div>
        </div>
    </div>
</div>
