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

    public function mount($id)
    {
        $this->client = Client::find($id);
    }

    public function save()
    {
        $this->client->save();
        $this->dispatch('done', success: "Successfully Updated Client Details");
        return redirect()->route('admin.clients.index');
    }
    public function render()
    {
        return view('livewire.admin.clients.edit');
    }
}
