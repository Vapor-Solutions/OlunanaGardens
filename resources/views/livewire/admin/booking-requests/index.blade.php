<div>
    <x-slot:header>Booking Requests</x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>List of Booking Requests</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-borderless">
                <thead class="">

                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Alias</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Type of Event</th>
                        <th>No. of adults</th>
                        <th>No. of children</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @foreach ($bookingRequests as $request)
                        <tr>
                            <td scope="row">{{ $request->id }}</td>
                            <td>{{ Carbon\Carbon::parse($request->start_time)->format('jS F, Y h:i:sA') }}</td>
                            <td>{{ $request->client->name }}</td>
                            <td>{{ $request->client->email }}</td>
                            <td>{{ $request->client->phone_number }}</td>
                            <td>{{ $request->eventType->title }}</td>
                            <td>{{ $request->capacity_adults }}</td>
                            <td>{{ $request->capacity_children }}</td>
                            <td class="d-flex flex-row justify-content-center">
                                <div class="flex-col m-1">
                                    <button class="btn btn-success" data-toggle="tooltip" title="Make the Booking">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>


                            </td>
                        </tr>
                    @endforeach




                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

    </div>
</div>

{{ $bookingRequests->links() }}
</div>
