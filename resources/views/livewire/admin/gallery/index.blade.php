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
                            <th>Event Type</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($photos as $index => $photo)
                            <tr class="">
                                <td scope="row">{{ $index + 1 }}</td>
                                <td scope="row">{{ $photo->eventType->title }}</td>
                                <td>
                                    <img src="{{ asset($photo->image_path) }}?{{ rand() }}" alt="{{ $photo->title }}" width="100" height="100">
                                </td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1">
                                        <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="flex-col mx-1">
                                        <button wire:click='deletePhoto({{ $index }})' class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
