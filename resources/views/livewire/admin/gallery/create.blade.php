<div>
    <x-slot name="header">
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
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" wire:model.live='title' name="title" id="title"
                                aria-describedby="title" placeholder="Enter the Title of the Photos" />
                            @error('title')
                                <small id="title" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="event_type" class="form-label">Event Type</label>
                            <select class="form-control" name="event_type" id="event_type" wire:model.live='event_type_id'>
                                <option selected>Select one</option>
                                @foreach ($event_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-12">

                        <div class="mb-3">
                            <label for="photos" class="form-label">Photos</label>
                            <input type="file" multiple wire:model.live='photos' class="form-control" name="image"
                                id="blogPhoto" aria-describedby="helpId" placeholder="" />
                            @if ($photos)
                                <div class="row">
                                    @foreach ($photos as $key => $photo)
                                        <div class="col-3 mt-2 me-1 mb-2 ">
                                            <img src="{{ $photo->temporaryUrl() }}" width="150">
                                        </div>
                                        @error('photos.' . $key)
                                            <small id="photos" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    @endforeach
                                </div>
                            @endif

                            @error('photos')
                                <small id="photos" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
                <button wire:click='store' class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
