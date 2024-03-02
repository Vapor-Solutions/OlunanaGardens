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
                            <th>Price</th>
                            <th>Number of Bookings</th>
                            <th>Total Earned</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event_types as $type)
                            <tr>
                                <td scope="row">{{ $type->id }}</td>
                                <td>{{ $type->title }}</td>
                                <td>KES {{ number_format($type->price_kes) }}</td>

                                <td>{{ count($type->bookings) }}</td>

                                @php
                                    $costs = 0;
                                    foreach ($type->bookings as $booking) {
                                        $costs += $booking->price;
                                    }

                                @endphp
                                <td>KES {{ number_format($costs) }}</td>

                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1"><button class="btn btn-secondary"><i
                                                class="fas fa-edit"></i></button></div>
                                    <div class="flex-col mx-1"><button wire:click='delete({{ $type->id }})'class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button></div>
                                </td>
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
                                    $booking_earnings += $booking->price;
                                }
                            @endphp
                            <td><strong>KES {{ number_format($booking_earnings) }}</strong></td>
                        </tr>
                    </tbody>
                    {{-- {{ $event_types->links() }} --}}
                </table>
                {{ $event_types->links() }}
            </div>
        </div>
    </div>
</div>
