<div>
    <x-slot:header>
        Gallery
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add a New Image
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" wire:model='image' class="form-control" name="image" id="blogPhoto"
                                aria-describedby="helpId" placeholder="" />
                            @if ($image)
                                <div class="row">
                                    <div class="col-3  mt-2 me-1 mb-2 ">
                                        <img src="{{ $image->temporaryUrl() }}" height="200" width="200">
                                    </div>
                                </div>
                            @endif
                            @error('image')
                                <small id="Image" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
                <button wire:click.prevent='store' class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>

    {{-- <div>
        <h2>Photos Gallery</h2>
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('storage/' . $photo) }}" class="img-fluid" alt="{{ $photo }}">
                </div>
            @endforeach
        </div>
    </div> --}}
