<div>
    <x-slot:header>
        {{ __('Image Center') }}
    </x-slot:header>

    <div class="card">
        <div class="card-header">
            List of Images
        </div>
        <div class="card-body">
            <div class="container">
                <h5>Cover Images</h5>
                <div class="row">
                    @foreach($coverImages ?? [] as $image)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset($image) }}?{{ time() }}" style="max-height: 150px; object-fit: cover;" class="card-img-top" alt="{{ $image }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $image }}</h5>
                                <p class="card-text">No description available</p>
                                <div class="d-flex justify-content-between">
                                    <input type="file" name="cover_image" wire:model="imageReplacement.{{ $loop->index }}" id="">
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                Last updated: {{ \Carbon\Carbon::now()->diffForHumans() }}
                            </div>
                            @if (isset($imageReplacement[$loop->index]))
                            <button class="btn btn-primary btn-sm" wire:click="replaceImage({{ $loop->index }})">Save</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>


                <!-- Image Upload/Edit Modal will go here -->
            </div>
        </div>
    </div>
</div>
