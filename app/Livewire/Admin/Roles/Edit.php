<?php

namespace App\Livewire\Admin\Roles;

use App\Models\ActivityLog;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public Role $role;
    public $permissions = [];

    public function rules()
    {
        return [
            'role.title' => [
                'required',
                Rule::unique('roles', 'title')->ignore($this->role->id),
            ],
            'permissions' => [
                'required',
            ]
        ];
    }


    public function mount($id)
    {
        $this->role = Role::find($id);
        $this->permissions = $this->role->permissions()->pluck('id');
    }

    public function save()
    {
        $this->validate();

        if ($this->role->id == 1) {
            $this->dispatch(
                'done',
                warning: "This is the Primary Role! You can\'t Edit it or Delete It!"
            );
            return;
        }
        $this->role->save();

        $this->role->permissions()->detach();
        $this->role->permissions()->attach($this->permissions);

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'payload' => "Updated Role No. " . $this->role->id
        ]);

        return redirect()->route('admin.roles.index');
    }

    public function render()
    {
        return view('livewire.admin.roles.edit');
    }
}
