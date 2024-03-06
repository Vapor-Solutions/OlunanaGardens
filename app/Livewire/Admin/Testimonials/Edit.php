<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use Livewire\Component;

class Edit extends Component
{
    public Testimonial $testimonial;

    protected $rules = [
        'testimonial.client_id' => 'required',
        'testimonial.rating' => 'required',
        'testimonial.comment' => 'required'
    ];

    public function mount($id)
    {
        $this->testimonial = Testimonial::find($id);
    }

    public function update()
    {
        $this->validate();

        $this->testimonial->save();
        return redirect()->route('admin.testimonials.index');
    }

    public function render()
    {
        return view('livewire.admin.testimonials.edit');
    }
}
