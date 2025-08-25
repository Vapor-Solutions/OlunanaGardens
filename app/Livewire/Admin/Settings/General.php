<?php

namespace App\Livewire\Admin\Settings;

use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class General extends Component
{
    use WithFileUploads;

    public $companyName;
    public $companyEmail;
    public $companyLogo;
    public $facebookLink = '';
    public $twitterLink = '';
    public $instagramLink = '';
    public $youtubeLink = '';
    public $whatsappLink = '';

    protected $rules = [
        'companyName' => 'required',
        'companyEmail' => 'required',
        'companyLogo' => 'nullable|mimes:png|max:512',
        'facebookLink' => 'nullable|url',
        'twitterLink' => 'nullable|url',
        'instagramLink' => 'nullable|url',
        'youtubeLink' => 'nullable|url',
        'whatsappLink' => 'nullable|url',
    ];


    protected $listeners = [
        'done' => 'render'
    ];

    public function mount()
    {
        $this->companyName = env('COMPANY_NAME');
        $this->companyEmail = env('COMPANY_EMAIL');
        $this->facebookLink = env('FACEBOOK_URL');
        $this->twitterLink = env('TWITTER_URL');
        $this->instagramLink = env('INSTAGRAM_URL');
        $this->youtubeLink = env('YOUTUBE_URL');
        $this->whatsappLink = env('WHATSAPP_URL');
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

    public function saveSocialLinks()
    {
        $this->validate();

        $envData = [
            'FACEBOOK_URL' => $this->facebookLink,
            'TWITTER_URL' => $this->twitterLink,
            'INSTAGRAM_URL' => $this->instagramLink,
            'YOUTUBE_URL' => $this->youtubeLink,
            'WHATSAPP_URL' => $this->whatsappLink,
        ];

        $envFile = base_path('.env');
        $oldEnvContent = File::get($envFile);

        foreach ($envData as $key => $value) {
            $oldEnvContent = preg_replace("/$key=.*$/m", "$key=\"$value\"", $oldEnvContent);
        }

        File::put($envFile, $oldEnvContent);

        $this->dispatch(
            'done',
            success: 'Successfully Saved the Social Media Links Settings'

        );
    }

    public function render()
    {
        return view('livewire.admin.settings.general');
    }
}
