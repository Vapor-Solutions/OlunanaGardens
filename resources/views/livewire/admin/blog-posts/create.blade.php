<div>
    <x-slot:header>Blog Posts</x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>Create a Blog Post</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="post.title" class="form-label">Title</label>
                <input wire:model='post.title' type="text" class="form-control" name="post.title" id="post.title"
                    aria-describedby="post.title" placeholder="Enter the Title of Your Post" />
                @error('post.title')
                    <small id="post.title" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="post.content" class="form-label">Content</label>
                <textarea class="form-control" name="post.content" id="post-content" rows="5"></textarea>
                @error('post.content')
                    <small id="post.content" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="headerPhoto" class="form-label">Header Photo</label>
                        <input type="file" wire:model='headerPhoto' class="form-control" name="headerPhoto"
                            id="headerPhoto" aria-describedby="helpId" placeholder="" />
                        @error('headerPhoto')
                            <small id="headerPhoto" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="blogPhoto" class="form-label">Thumbnail</label>
                        <input type="file" wire:model='' class="form-control" name="blogPhoto"
                            id="blogPhoto" aria-describedby="helpId" placeholder="" />
                        @error('blogPhoto')
                            <small id="blogPhoto" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#post-content'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('post.content', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
