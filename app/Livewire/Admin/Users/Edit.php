<?php

namespace App\Livewire\Admin\Users;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public User $user;
    public $roles = [];

    public function rules()
    {
        return [
            'user.name' => [
                'required',
            ],
            'user.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id)

            ],
            'roles' => [
                'required',

            ]
        ];
    }


    public function mount($id)
    {
        // $this->middleware('permission:Update Users');
        $this->user = User::find($id);
        foreach ($this->user->roles as $role) {
            array_push($this->roles, $role->id);
        }
    }

    public function save()
    {
        $this->validate();

        // Don't reset password on edit - password should be updated separately
        // Only save the other user fields
        $this->user->save();

        $this->user->roles()->sync($this->roles);

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'payload' => "Updated User No. " . $this->user->id
        ]);
        return redirect()->route('admin.users.index');
    }
    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
