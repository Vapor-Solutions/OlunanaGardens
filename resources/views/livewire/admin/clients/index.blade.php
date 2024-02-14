<div>
    <x-slot:header>
        Client's List
    </x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>List of Clients</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-borderless align-middle">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Bookings Made</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($clients as $client)
                            <tr class="">
                                <td scope="row">{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ count($client->bookings) }}</td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1"><button class="btn btn-secondary"><i
                                                class="fas fa-edit"></i></button></div>
                                    <div class="flex-col mx-1"><button wire:click='delete({{ $client->id }})' class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{ $clients->links() }}
                </table>
                {{ $clients->links() }}
            </div>

        </div>
    </div>
</div>
