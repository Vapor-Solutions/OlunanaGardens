<div>
    <x-slot name="header">
        Testimonials
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add a New Testimonial
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-5">
                            <label for="client_id" class="form-label">Client</label>
                            <select wire:model.live='testimonial.client_id' class="form-control" name="client_id"
                                id="client_id">
                                <option>SELECT YOUR CLIENT</option>
                                @foreach (App\Models\Client::all() as $client)
                                    <option value="{{ $client->id }}" @disabled($client->testimonial)>{{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('testimonial.client_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-5">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" step="0.1" max="5"
                                wire:model.live='testimonial.rating' name="rating" id="rating" aria-describedby="helpId"
                                placeholder="Enter your Rating">
                            @error('testimonial.rating')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-5">
                            <label for="testimonial" class="form-label">Testimonial</label>
                            <textarea wire:model.live='testimonial.comment' class="form-control" name="comment" id="comment" rows="5"></textarea>
                            @error('testimonial.comment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button wire:click='save' class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
