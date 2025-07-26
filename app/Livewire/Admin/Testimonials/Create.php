<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use Livewire\Component;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Create extends Component
{
    public Testimonial $testimonial;

    protected $rules = [
        'testimonial.client_id' => 'required',
        'testimonial.rating' => 'required',
        'testimonial.comment' => 'required'
    ];

    public function mount()
    {
        $this->testimonial = new Testimonial();
    }

    public function save()
    {
        $this->validate();
        $this->testimonial->save();

        $this->dispatch('done', success: 'Successfully Added a New Testimonial');
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->testimonial = new Testimonial();
    }

    public function render()
    {
        return view('livewire.admin.testimonials.create');
    }
}
