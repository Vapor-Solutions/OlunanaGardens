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
                            <th>Event Type</th>
                            <th>Client</th>
                            <th>Booking Reference Code</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>No. of Adults</th>
                            <th>No. of Children</th>
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
                                <td scope="row">{{ $booking->eventType->title }}</td>
                                <td>{{ $booking->client->name }}</td>
                                <td>{{ $booking->booking_ref }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->start_time)->format('jS M, Y \a\t h:i A') }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->end_date)->format('jS M, Y \a\t h:i A') ?? '-' }}
                                </td>
                                <td>{{ number_format($booking->capacity_adults) }}</td>
                                <td>{{ number_format($booking->capacity_children) }}</td>
                                <td>{{ 'KES ' . number_format($booking->total_cost, 2) }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->created_at)->format('jS M, Y - h:i:sA') ?? '-' }}
                                </td>
                                <td>{{ Carbon\Carbon::parse($booking->updated_at)->format('jS M, Y - h:i:sA') ?? Carbon\Carbon::parse($booking->created_at)->format('jS M, Y - h:i:sA') }}
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <div class="flex-col mx-1">
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                                class="btn btn-secondary">
                                                <i class="fas fa-edit" title="Edit"></i>
                                            </a>
                                        </div>

                                        <div class="flex-col mx-1">
                                            <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
                                                <i class="fas fa-credit-card" title="Payment"></i>
                                            </a>
                                        </div>

                                        <div class="flex-col mx-1">
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash" title="Delete"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer">
                {{ $bookings->links() }}
            </div>
        </div>

    </div>
</div>
