<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class Create extends Component
{
    public Client $client;

    protected $rules = [
        'client.name' => 'required',
        'client.email' => 'required|unique:clients,email',
        'client.phone_number' => 'required',
        'client.address' => 'nullable',
        'client.country' => 'required',
    ];

    public function mount()
    {
        $this->client = new Client();
    }

    public function save()
    {
        $this->validate();
        $this->client->save();

        // return redirect()->route('admin.clients.index');
        $this->dispatch('done', success: " Successfully Registered a New Client To The System");
        $this->resetInput();

    }

    function resetInput(){
        $this->client = new Client();
    }
    public function render()
    {
        return view('livewire.admin.clients.create');
    }
}
