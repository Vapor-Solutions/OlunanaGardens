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
    </div>
</div>
