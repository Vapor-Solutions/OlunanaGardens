<div>
    <x-slot:header>
        Payment Methods
    </x-slot>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Payment Methods</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payment_methods as $method)
                            <tr>
                                <td scope="row">{{ $method->id }}</td>
                                <td>{{ $method->title }}</td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <a href="{{ route('admin.payment-methods.edit', $method->id) }}"
                                            class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="flex-col mx-1"><button
                                            wire:click='delete({{ $method->id }})'class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $payment_methods->links() }}
            </div>
        </div>
    </div>
</div>
