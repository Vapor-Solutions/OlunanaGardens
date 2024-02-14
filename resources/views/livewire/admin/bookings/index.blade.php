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
                            <th>Room</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Nights Spent</th>
                            <th>Total Cost</th>
                            <th>Created By</th>
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
                                <td>{{ $booking->room->room_number }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->check_in)->format('jS M, Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->check_out)->format('jS M, Y') ?? '-' }}</td>
                                <td>{{ $booking->nights_stayed }}</td>
                                <td>{{ 'KES ' . number_format($booking->total_cost_kes) }}</td>
                                <td>{{ $booking->creator->name }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->created_at)->format('jS M, Y - h:i:sA') ?? '-' }}
                                </td>
                                <td>{{ Carbon\Carbon::parse($booking->updated_at)->format('jS M, Y - h:i:sA') ?? Carbon\Carbon::parse($booking->created_at)->format('jS M, Y - h:i:sA') }}
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <div class="flex-col">
                                            <!-- Modal trigger button -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#checkout{{ $booking->id }}">
                                                <i class="fa fa-sign-out" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Early Checkout"></i>
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="checkout{{ $booking->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">Checkout
                                                {{ $booking->client->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="time" class="form-label">Check Out Time</label>
                                                <input type="time" class="form-control" name="time" id="time"
                                                    aria-describedby="helpId" placeholder="Choose the time of today">
                                                @error('checkout_time')
                                                    <small id="helpId"
                                                        class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
