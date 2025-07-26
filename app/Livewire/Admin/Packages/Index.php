<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Booking;
use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;


    public function delete($id)
    {
        $package = Package::find($id);
        $bookings_with_packages = Booking::where('package_id', $package->id)->exists();

        if ($bookings_with_packages) {
            $this->dispatch('done', error: "Cannot delete " . $package->title . " Package because it has associated bookings.");
        } else {
            $package->delete();
            $this->dispatch('done', success: "Successfully deleted " . $package->title .  " Package");
        }
    }
    public function render()
    {
        return view('livewire.admin.packages.index', [
            'packages' => Package::paginate(10)
        ]);
    }
}
