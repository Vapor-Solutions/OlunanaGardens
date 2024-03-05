<?php

namespace App\Livewire\Admin\PaymentMethods;

use App\Models\PaymentMethod;
use Livewire\Component;

class Create extends Component
{
    public PaymentMethod $payment_method;

    protected $rules = [
        'payment_method.title' => 'required'
    ];

    public function mount()
    {
        $this->payment_method = new PaymentMethod();
    }

    public function save()
    {
        $this->validate();
        $this->payment_method->save();

        $this->emit('done', ['success' => "Successfully Added a New Payment Method"]);
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->payment_method = new PaymentMethod();
    }

    public function render()
    {
        return view('livewire.admin.payment-methods.create');
    }
}
