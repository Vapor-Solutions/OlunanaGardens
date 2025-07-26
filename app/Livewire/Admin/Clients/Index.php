<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    protected $listeners = [
        'done' => 'render'
    ];

    function delete($id)
    {
        $client = Client::find($id);

        $client->delete();

        $this->dispatch('done', success: "Successfully Deleted a Client");
    }

    public function render()
    {
        return view('livewire.admin.clients.index', [
            'clients' => Client::orderBy('id', 'DESC')->paginate(10)
        ]);
    }
}
