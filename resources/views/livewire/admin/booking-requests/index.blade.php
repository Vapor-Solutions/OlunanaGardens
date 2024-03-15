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
                        <th scope="row">ID</th>
                        <th>Date</th>
                        <th>Alias</th>
                        <th>Email Address</th>
                        <th>Type of Event</th>
                        <th>No. of adults</th>
                        <th>No. of children</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    <tr>
                        <td scope="row">Item</td>
                        <td>Item</td>
                        <td>Item</td>
                        <td>Item</td>
                        <td>Item</td>
                        <td>Item</td>
                        <td>Item</td>
                    </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

    </div>
</div>

{{ $bookingRequests->links() }}
</div>
