<?php

namespace App\Livewire\Admin\Roles;

use App\Models\ActivityLog;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public Role $role;
    public $permissions = [];

    public function rules()
    {
        return [
            'role.title' => [
                'required',
                Rule::unique('roles', 'title'),
            ],
            'permissions' => [
                'required',
            ]
        ];
    }


    public function mount()
    {
        // $this->middleware('permission:Create Roles');
        $this->role = new Role();
    }

    public function save()
    {
        $this->validate();
        $this->role->save();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'payload' => "Created Role No. " . $this->role->id
        ]);

        $this->role->permissions()->attach($this->permissions);

        return redirect()->route('admin.roles.index');
    }
    public function render()
    {
        return view('livewire.admin.roles.create');
    }
}
