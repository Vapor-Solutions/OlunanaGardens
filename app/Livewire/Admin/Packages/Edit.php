<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Package;
use Livewire\Component;

class Edit extends Component
{
    public Package $package;

    protected $rules = [
        'package.title' => 'required',
        'package.price' => 'required'
    ];

    public function mount($id){
        $this->package = Package::find($id);
    }

    public function update(){
        $this->validate();

        $this->package->update();

        return redirect()->route('admin.packages.index');
    }

    public function render()
    {
        return view('livewire.admin.packages.edit');
    }
}
