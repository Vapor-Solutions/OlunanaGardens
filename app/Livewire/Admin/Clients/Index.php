<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = "bootstrap";
    public $search = '';

    protected $listeners = [
        'done' => 'render'
    ];

    public function delete($id)
    {
        $client = Client::find($id);
        if($client->bookings->count() > 0) {
            $this->dispatch('done', error: "Cannot delete client with existing bookings. Delete the bookings first.");
            return;
        }
        $client->delete();

        $this->dispatch('done', success: "Successfully Deleted a Client");
    }

    public function render()
    {
        return view('livewire.admin.clients.index', [
            'clients' => Client::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10)
        ]);
    }
}
