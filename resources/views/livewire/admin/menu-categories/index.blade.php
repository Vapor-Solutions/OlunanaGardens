<div>
    <x-slot:header>Menu Categories</x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>List of Menu Categories</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Category Title</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menuCategories as $category)
                        <tr>
                            <td scope="row">{{ $category->id }}</td>
                            <td>{{ $category->title }}</td>
                            <td class="d-flex flex-row justify-content-center">
                                <div class="flex-col mx-1">
                                    <a href="{{ route('admin.menu-categories.edit', $category->id) }}"
                                        class="btn btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                <div class="flex-col mx-1">
                                    <button class="btn btn-danger">
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
