<div>
    <x-slot name="header">
        Event Types
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Event Types</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event type</th>
                            <th>Number of Events</th>
                            <th>Price</th>
                            <th>Number of Bookings</th>
                            <th>Total Earned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event_types as $type)
                            <tr>
                                <td scope="row">{{ $type->id }}</td>
                                <td>{{ $type->title }}</td>
                                <td>{{ count($type->events) }}</td>
                                <td>KES {{ number_format($type->price_kes) }}</td>
                                @php
                                    $bookings = 0;

                                    foreach ($type->events as $event) {
                                        $bookings += count($event->bookings);
                                    }
                                @endphp
                                <td>{{ $bookings }}</td>

                                @php
                                    $costs = 0;
                                    foreach ($type->events as $event) {
                                        foreach ($event->bookings as $booking) {
                                            $costs += $booking->total_cost_kes;
                                        }
                                    }
                                @endphp
                                <td>KES {{ number_format($costs) }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <strong>TOTAL:</strong>
                            </td>
                            @php
                                $booking_earnings = 0;

                                foreach (App\Models\Booking::all() as $booking) {
                                    $booking_earnings += $booking->total_cost_kes;
                                }
                            @endphp
                            <td><strong>KES {{ number_format($booking_earnings) }}</strong></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>