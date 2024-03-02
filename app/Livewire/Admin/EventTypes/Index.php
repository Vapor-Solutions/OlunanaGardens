<?php

namespace App\Livewire\Admin\EventTypes;

use App\Models\EventType;
use Livewire\Component;
use Livewire\WithPagination;

use function Termwind\render;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'done' => 'render'
    ];

    function delete($id){
        
        $event_type = EventType::find($id);
        $event_type->delete();

        $this->emit('done', ['success' => "Successfully deleted this event type"]);
    }

    public function render()
    {
        return view('livewire.admin.event-types.index',[
            'event_types' => EventType::paginate(5)
        ]);
    }
}
