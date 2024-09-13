<div>
    <x-slot:header>Menus</x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>List of Menu Items</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menuItems as $item)
                        <tr>
                            <td scope="row">{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->menuCategory->title }}</td>
                            <td>KES {{ number_format($item->price) }}</td>
                            <td class="d-flex flex-row justify-content-center">
                                <div class="flex-col mx-1">
                                    <a href="{{ route('admin.menus.edit', $item->id) }}" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="flex-col mx-1">
                                    <button href="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $menuItems->links() }}
        </div>
    </div>
</div>
