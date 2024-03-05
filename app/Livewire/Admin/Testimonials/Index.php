<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('livewire.admin.testimonials.index', [
            'testimonials' => Testimonial::paginate(10)
        ]);
    }
}
