<div>
    <x-slot:header>
        Testimonials
    </x-slot>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Testimonials</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $testimonial)
                            <tr>
                                <td scope="row">{{ $testimonial->id }}</td>
                                <td>{{ $testimonial->client->name }}</td>
                                <td>{{ $testimonial->rating }}</td>
                                <td>{{ $testimonial->comment }}</td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                            class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="flex-col mx-1"><button
                                            wire:click='delete({{ $testimonial->id }})'class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</div>
