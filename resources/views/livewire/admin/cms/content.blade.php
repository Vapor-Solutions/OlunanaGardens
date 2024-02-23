<div>
    <x-slot name="header">
        <h5>Content Editing</h5>
    </x-slot>

    <div class="container-fluid">
        <div class="card my-5">
            <div class="card-header">
                <h5>Edit Content</h5>
            </div>
            <div class="card-body" wire:ignore>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">
                            Home
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="about-tab" data-toggle="tab" data-target="#about" type="button"
                            role="tab" aria-controls="about" aria-selected="false">
                            About
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="restaurant-tab" data-toggle="tab" data-target="#restaurant"
                            type="button" role="tab" aria-controls="restaurant" aria-selected="false">
                            restaurant
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="speciality-tab" data-toggle="tab" data-target="#speciality"
                            type="button" role="tab" aria-controls="speciality" aria-selected="false">
                            speciality
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact_us-tab" data-toggle="tab" data-target="#contact_us"
                            type="button" role="tab" aria-controls="contact_us" aria-selected="false">
                            contact Us
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="footer-tab" data-toggle="tab" data-target="#footer" type="button"
                            role="tab" aria-controls="footer" aria-selected="false">
                            footer
                        </button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="m-5">
                            <div id="editor_home">
                                {!! $home_content !!}
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary" wire:click='save_home_content'>submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <div class="m-5">
                            <div id="editor_about1">
                                {!! $about_content1 !!}
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary" wire:click='save_about_content1'>submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="restaurant" role="tabpanel" aria-labelledby="restaurant-tab">
                        <div class="m-5">
                            <div id="editor_restaurant">
                                {!! $restaurant_content !!}
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary" wire:click='save_restaurant_content'>submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="speciality" role="tabpanel" aria-labelledby="speciality-tab">
                        <div class="m-5">
                            <div id="editor_speciality">
                                {!! $speciality_content !!}
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary" wire:click='save_speciality_content'>submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="contact_us" role="tabpanel" aria-labelledby="contact_us-tab">
                        <div class="m-5">
                            <div id="editor_contact_us">
                                {!! $contact_us_content !!}
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary" wire:click='save_contact_us_content'>submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                        <div class="m-5">
                            <div id="editor_footer">
                                {!! $footer_content !!}
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary" wire:click='save_footer_content'>submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>



@push('scripts')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script> --}}
    <script>
        // Intros
        ClassicEditor
            .create(document.querySelector('#editor_about1'), {
                image: {
                    toolbar: ['toggleImageCaption', 'imageTextAlternative', 'ckboxImageEdit']
                }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('about_content1', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor_home'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('home_content', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor_contact_us'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('contact_us_content', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor_footer'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('footer_content', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor_restaurant'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('restaurant_content', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor_speciality'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('speciality_content', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
