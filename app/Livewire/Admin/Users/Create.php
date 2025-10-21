<?php

namespace App\Livewire\Admin\Users;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
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
                Rule::unique('users', 'email')

            ],
            'roles' => [
                'required',

            ]
        ];
    }


    public function mount()
    {
        // $this->middleware('permission:Create users');
        $this->user = new User();
    }

    public function save()
    {
        $this->validate();

        // Fixed operator precedence bug - added parentheses
        if (in_array(1, $this->roles) && auth()->user()->id != 1) {
            $this->dispatch(
                'done',
                error: "You can't create a Super Administrator. Only Super Administrators can create other Super Administrators."
            );
            return;
        }

        // Use configured default password from .env
        $defaultPassword = config('auth.default_password', env('DEFAULT_PASSWORD', '1234567890'));
        $this->user->password = Hash::make($defaultPassword);
        $this->user->save();


        $this->user->roles()->attach($this->roles);
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'payload' => "Created User No. " . $this->user->id
        ]);

        return redirect()->route('admin.users.index');
    }
    public function render()
    {
        return view('livewire.admin.users.create');
    }
}
