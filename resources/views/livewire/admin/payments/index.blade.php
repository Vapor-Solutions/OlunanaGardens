<div>
    <x-slot:header>
        Booking Payments
    </x-slot>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Booking Payments</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Client</th>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Reference code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td scope="row">{{ $payment->id }}</td>
                                <td>{{ $payment->booking->client->name }}</td>
                                <td>{{ $payment->booking->eventType->title }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->paymentMethod->title }}</td>
                                <td>{{ $payment->reference_code }}</td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="flex-col mx-1">
                                        <button wire:click='delete({{ $payment->id }})' class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
