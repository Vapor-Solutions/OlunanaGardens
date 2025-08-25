<div>
    <x-slot:header>General Settings</x-slot:header>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header bg-transparent border-0">
                    <h5>Company Details</h5>
                </div>
                <div class="card-body">
                    <form wire:submit="saveCompanyDetails">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="" wire:model='companyName'
                                        id="" aria-describedby="helpId" placeholder="">
                                    @error('companyName')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Company Email</label>
                                    <input type="text" class="form-control" name="" wire:model='companyEmail'
                                        id="" aria-describedby="helpId" placeholder="">
                                    @error('companyEmail')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class=" col-12 mb-3">
                                <div class="mb-3 d-flex align-items-center">
                                    <label for="" class="form-label">Company Logo</label>
                                    <img width="200" src="/company_logo.png?{{ random_int(1, 56123) }}" alt=""
                                        class="img-fluid img-thumbnail ml-auto ">

                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="file" class="form-control" name="" wire:model='companyLogo'
                                    id="" aria-describedby="helpId" placeholder="">
                                @error('companyLogo')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Social Media Links</h5>
                </div>
                <div class="card-body">
                    <form wire:submit="saveSocialLinks">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="" wire:model='facebookLink'
                                        id="" aria-describedby="helpId" placeholder="Enter your Facebook link">
                                    @error('facebookLink')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Twitter</label>
                                    <input type="text" class="form-control" name="" wire:model='twitterLink'
                                        id="" aria-describedby="helpId" placeholder="Enter your Twitter link">
                                    @error('twitterLink')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Instagram</label>
                                    <input type="text" class="form-control" name="" wire:model='instagramLink'
                                        id="" aria-describedby="helpId" placeholder="Enter your Instagram link">
                                    @error('instagramLink')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">YouTube</label>
                                    <input type="text" class="form-control" name="" wire:model='youtubeLink'
                                        id="" aria-describedby="helpId" placeholder="Enter your YouTube link">
                                    @error('youtubeLink')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">WhatsApp</label>
                                    <input type="text" class="form-control" name="" wire:model='whatsappLink'
                                        id="" aria-describedby="helpId" placeholder="Enter your WhatsApp link">
                                    @error('whatsappLink')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
