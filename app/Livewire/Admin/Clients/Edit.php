<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class Edit extends Component
{
    public Client $client;

    protected $rules = [
        'client.name' => 'required',
        'client.email' => 'required',
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
        $this->client->save();
        return redirect()->route('admin.clients.index');
    }
    public function render()
    {
        return view('livewire.admin.clients.edit');
    }
}
