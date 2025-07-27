<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\DashboardController;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class Dashboard extends Component
{
    // This component handles the admin dashboard functionalities
    // such as displaying the current date, toggling maintenance mode, etc.

    protected $listeners = [
        'done' => 'render'
    ];
    public $days = [];
    public $today;

    public function mount()
    {
        $this->today = Carbon::now();
        $this->days = CarbonPeriod::create($this->today->subMonths(2), 'now')->toArray();
    }
    public function last_month()
    {
        $this->today->subMonth();
        $this->days = CarbonPeriod::create($this->today->subMonths(2), $this->today)->toArray();
        $this->dispatch('done');
    }


    public function maintenance_switch()
    {
        if (env('MAINTENANCE_MODE')) {
            DashboardController::maintenance_false();
        } else {
            DashboardController::maintenance_true();
        }
        $this->reset();
        $this->dispatch('done', success: "Successfully Toggled The Maintenance Mode " );
    }


    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
