<div>
    <x-slot:header>
        Blog Categories
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Blog Categories</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blog_categories as $category)
                            <tr>
                                <td scope="row">{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>

                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <a href="{{ route('admin.post-categories.edit', $category->id) }}"
                                            class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="flex-col mx-1"><button
                                            wire:click='delete({{ $category->id }})'class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $blog_categories->links() }}
            </div>
        </div>
    </div>
</div>
