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

        $this->user->password = Hash::make('1234567890');
        $this->user->save();

        $this->user->roles()->detach();
        $this->user->roles()->attach($this->roles);

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
