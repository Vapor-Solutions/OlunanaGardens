<div>
    <x-slot:header>
        List of Photos
    </x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>Photos</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-borderless align-middle">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($photos as $index => $photo)
                            <tr class="">
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('gallery/' . $photo->getFilename()) }}" alt="{{ $photo->getFilename() }}" width="100" height="100">
                                </td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="flex-col mx-1">
                                        <button wire:click='delete()' class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $photos->links() }} --}}
            </div>
        </div>
    </div>
</div>
