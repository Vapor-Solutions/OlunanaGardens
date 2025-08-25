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
        try {
            $client = Client::find($id);
            if ($client->bookings->count() > 0) {
                throw new \Exception("Cannot delete client with existing bookings. Delete the bookings first.", 1);

            }
            if ($client->bookingRequests->count() > 0) {
                throw new \Exception("Cannot delete client with existing booking requests. Delete the booking requests first.", 1);

            }
            if ($client->comments->count() > 0) {
                throw new \Exception("Cannot delete client with existing comments. Delete the comments first.", 1);

            }
            if ($client->testimonial->count() > 0) {
                throw new \Exception("Cannot delete client with an existing testimonial. Delete the testimonial first.", 1);

            }
            $client->delete();

            $this->dispatch('done', success: "Successfully Deleted a Client");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Failed to Delete a Client. " . $th->getMessage());
        }
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
