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
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <img src="{{ asset($aboutImagePath) }}?{{ time() }}" style="max-height: 150px; object-fit: cover;" class="card-img-top" alt="{{ $aboutImagePath }}">
                        <h5>About Image</h5>
                        <div class="d-flex justify-content-between">
                            <input type="file" name="about_image" wire:model="aboutImage" id="">
                        </div>
                        @error('aboutImage') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if (isset($aboutImage))
                    <button class="btn btn-primary btn-sm" wire:click="replaceAboutImage">Save</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <img src="{{ asset($contactUsImagePath) }}?{{ time() }}" style="max-height: 150px; object-fit: cover;" class="card-img-top" alt="{{ $contactUsImagePath }}">
                        <h5>Contact Us Image</h5>
                        <div class="d-flex justify-content-between">
                            <input type="file" name="contact_image" wire:model="contactUsImage" id="">
                        </div>
                        @error('contactUsImage') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if (isset($contactUsImage))
                    <button class="btn btn-primary btn-sm" wire:click="replaceContactUsImage">Save</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <img src="{{ asset($galleryImagePath) }}?{{ time() }}" style="max-height: 150px; object-fit: cover;" class="card-img-top" alt="{{ $galleryImagePath }}">
                        <h5>Gallery Image</h5>
                        <div class="d-flex justify-content-between">
                            <input type="file" name="gallery_image" wire:model="galleryImage" id="">
                        </div>
                        @error('galleryImage') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if (isset($galleryImage))
                    <button class="btn btn-primary btn-sm" wire:click="replaceGalleryImage">Save</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <img src="{{ asset($restaurantImagePath) }}?{{ time() }}" style="max-height: 150px; object-fit: cover;" class="card-img-top" alt="{{ $restaurantImagePath }}">
                        <h5>Restaurant Image</h5>
                        <div class="d-flex justify-content-between">
                            <input type="file" name="restaurant_image" wire:model="restaurantImage" id="">
                        </div>
                        @error('restaurantImage') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if (isset($restaurantImage))
                    <button class="btn btn-primary btn-sm" wire:click="replaceRestaurantImage">Save</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <img src="{{ asset($blogImagePath) }}?{{ time() }}" style="max-height: 150px; object-fit: cover;" class="card-img-top" alt="{{ $blogImagePath }}">
                        <h5>Blog Image</h5>
                        <div class="d-flex justify-content-between">
                            <input type="file" name="blog_image" wire:model="blogImage" id="">
                        </div>
                        @error('blogImage') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if (isset($blogImage))
                    <button class="btn btn-primary btn-sm" wire:click="replaceBlogImage">Save</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <img src="{{ asset($faqImagePath) }}?{{ time() }}" style="max-height: 150px; object-fit: cover;" class="card-img-top" alt="{{ $faqImagePath }}">
                        <h5>FAQ Image</h5>
                        <div class="d-flex justify-content-between">
                            <input type="file" name="faq_image" wire:model="faqImage" id="">
                        </div>
                        @error('faqImage') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if (isset($faqImage))
                    <button class="btn btn-primary btn-sm" wire:click="replaceFaqImage">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
