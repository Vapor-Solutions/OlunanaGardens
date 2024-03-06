<?php

namespace App\Livewire\Admin\PaymentMethods;

use App\Models\PaymentMethod;
use Livewire\Component;

class Edit extends Component
{
    public PaymentMethod $payment_method;

    protected $rules = [
        'payment_method.title' => 'required'
    ];

    public function mount($id){
        $this->payment_method = PaymentMethod::find($id);
    }

    public function save(){
        $this->validate();

        $this->payment_method->save();
        return redirect()->route('admin.payment-methods.index');
    }

    public function render()
    {
        return view('livewire.admin.payment-methods.edit');
    }
}
