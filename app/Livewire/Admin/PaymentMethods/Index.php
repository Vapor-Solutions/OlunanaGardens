<?php

namespace App\Livewire\Admin\PaymentMethods;

use App\Models\Payment;
use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;


    protected $listeners = [
        'done' => 'render'
    ];

    public function delete($id){
        $payment_method = PaymentMethod::find($id);

        $payment_with_payment_method = Payment::where('payment_method_id', $payment_method->id)->exists();

        if ($payment_with_payment_method) {
            $this->dispatch('done', error: "Cannot delete " . $payment_method->title . " Payment Method because it has associated payments.");
        } else {
            $payment_method->delete();
            $this->dispatch('done', success: "Successfully deleted " . $payment_method->title . " Payment method");
        }

    }
    public function render()
    {
        return view('livewire.admin.payment-methods.index', [
            'payment_methods' => PaymentMethod::paginate(10)
        ]);
    }
}
