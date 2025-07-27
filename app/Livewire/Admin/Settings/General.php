<?php

namespace App\Livewire\Admin\Settings;

use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class General extends Component
{

    public $companyName;
    public $companyEmail;
    public $companyLogo;

    use WithFileUploads;

    protected $rules = [
        'companyName' => 'required',
        'companyEmail' => 'required',
        'companyLogo' => 'nullable|mimes:png|max:512',
    ];


    protected $listeners = [
        'done' => 'render'
    ];

    public function mount()
    {
        $this->companyName = env('COMPANY_NAME');
        $this->companyEmail = env('COMPANY_EMAIL');
    }

    public function saveCompanyDetails()
    {

        $this->validate();

        $envData = [
            'COMPANY_NAME' => $this->companyName,
            'COMPANY_EMAIL' => $this->companyEmail,
        ];

        $envFile = base_path('.env');
        $oldEnvContent = File::get($envFile);

        foreach ($envData as $key => $value) {
            $oldEnvContent = preg_replace("/$key=.*$/m", "$key=\"$value\"", $oldEnvContent);
        }

        File::put($envFile, $oldEnvContent);

        if ($this->companyLogo) $this->companyLogo->storeAs('/', 'company_logo.png', 'public');

        $this->dispatch(
            'done',
            success: 'Successfully Saved the Company Details Settings'

        );
    }

    public function render()
    {
        return view('livewire.admin.settings.general');
    }
}
