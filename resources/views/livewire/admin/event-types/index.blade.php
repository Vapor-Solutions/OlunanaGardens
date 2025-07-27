<div>
    <x-slot:header>
        Event Types
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Event Types</h5>
                {{-- <div class="flex-col mx-1">
                    <a href="{{ route('admin.event-types.create') }}" class="btn btn-secondary">
                        <i class="fas fa-edit"></i>
                    </a>
                </div> --}}
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail Image</th>
                            <th>Event type</th>
                            <th>Number of Photos</th>
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
                                <td scope="row">
                                    @if ($type->image_path)
                                        <img class="img-thumbnail" src="{{ asset($type->image_path) }}" alt="">
                                    @else
                                        <h5>No Image Set</h5>
                                    @endif
                                </td>
                                <td>{{ $type->title }}</td>
                                <td>{{ count($type->photos) }} photos</td>
                                <td>KES {{ number_format($type->price) }}</td>

                                <td>{{ count($type->bookings) }}</td>

                                @php
                                    $costs = $type->price;
                                    foreach ($type->bookings as $booking) {
                                        $costs += $booking->price;
                                    }

                                @endphp
                                <td>KES {{ number_format($costs) }}</td>

                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <a href="{{ route('admin.event-types.edit', $type->id) }}"
                                            class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="flex-col mx-1"><button
                                            wire:click='delete({{ $type->id }})'class="btn btn-danger"><i
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
                </table>
                {{ $event_types->links() }}
            </div>
        </div>
    </div>
</div>
