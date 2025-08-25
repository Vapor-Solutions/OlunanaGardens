<div>
    <x-slot:header>
        Client's List
    </x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>List of Clients</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Search Clients...">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-borderless align-middle">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Bookings Made</th>
                            <th>Booking Requests</th>
                            <th>Comments</th>
                            <th>Testimonial</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($clients as $client)
                        <tr class="">
                            <td scope="row">{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ count($client->bookings) }}</td>
                            <td>{{ count($client->bookingRequests) }}</td>
                            <td>{{ count($client->comments) }}</td>
                            <td>{{ $client->testimonial ? $client->testimonial->comment : 'No Testimonial' }}</td>
                            <td class="d-flex flex-row">
                                <div class="flex-col mx-1">
                                    <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                <div class="flex-col mx-1">
                                    <button wire:click='delete({{ $client->id }})' class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $clients->links() }}
            </div>

        </div>
    </div>
</div>
