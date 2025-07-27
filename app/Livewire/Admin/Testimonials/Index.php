<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $listeners = [
        'done' => '$refresh',
    ];

    public function delete($id)
    {
        $testimonial = Testimonial::find($id);

        if ($testimonial) {
            $testimonial->delete();
            $this->dispatch('done', success: "Successfully Deleted a Testimonial");
        } else {
            $this->dispatch('done', error: "Testimonial not found");
        }
    }



    public function render()
    {
        return view('livewire.admin.testimonials.index', [
            'testimonials' => Testimonial::paginate(10)
        ]);
    }
}
