<div>
    <x-slot name="header">
        <h5>
            Bookings
        </h5>
    </x-slot>

    <div class="container-fluid my-2">
        <div class="card">
            <div class="card-header">
                <h5>List of recent Bookings</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Capacity</th>
                            <th>Total Cost</th>
                            <th>Created On</th>
                            <th>Last Update</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td scope="row">{{ $booking->id }}</td>
                                <td>{{ $booking->client->name }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->start_time)->format('jS M, Y \a\t h:i A') }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->end_date)->format('jS M, Y \a\t h:i A') ?? '-' }}</td>
                                <td>{{ number_format($booking->capacity) }}</td>
                                <td>{{ 'KES ' . number_format($booking->total_cost, 2) }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->created_at)->format('jS M, Y - h:i:sA') ?? '-' }}
                                </td>
                                <td>{{ Carbon\Carbon::parse($booking->updated_at)->format('jS M, Y - h:i:sA') ?? Carbon\Carbon::parse($booking->created_at)->format('jS M, Y - h:i:sA') }}
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <div class="flex-col mx-1">
                                            <button class="btn btn-secondary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="flex-col mx-1">
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        {{ $bookings->links() }}
                    </tfoot>
                </table>

            </div>

            <div class="card-footer">
                {{ $bookings->links() }}
            </div>
        </div>

    </div>
</div>
