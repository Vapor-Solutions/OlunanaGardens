<?php

namespace App\Livewire\Admin\EventTypes;

use App\Models\Booking;
use App\Models\EventType;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

use function Termwind\render;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;


    protected $listeners = [
        'done' => 'render'
    ];

    public function delete($id)
    {

        $event_type = EventType::find($id);
        $event_with_booking = Booking::where('event_type_id', $event_type->id)->exists();

        if ($event_with_booking) {
            $this->dispatch('done', error: "Cannot delete " . $event_type->title . " Event Type because it has associated bookings.");
        } else {
            $event_type->delete();
            $this->dispatch('done', success: "Successfully deleted " . $event_type->title . " Event Type");
        }
    }
    public function render()
    {
        return view('livewire.admin.event-types.index', [
            'event_types' => EventType::paginate(10)
        ]);
    }
}
