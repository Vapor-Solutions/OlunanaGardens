<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
    {
        $user = User::find($id);
        if ($user->id == auth()->user()->id) {
            $this->emit('done', [
                'error' => "Unafanya Nini?? You can't Delete yourself from the system"
            ]);
            return;
        }
        if ($user->id == 1) {
            $this->emit('done', [
                'error' => "This User can't be Deleted from the System"
            ]);
            return;
        }

        if ($user->hasRole(Role::find(1)->title) || auth()->user()->hasPermissionTo('Delete Admins')) {
            $user->roles()->detach();
            $user->delete();

            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'payload' => "Updated User No. " . $user->id
            ]);

            $this->emit('done', [
                'success' => "Successfully Deleted this User"
            ]);
        } else {
            $this->emit('done', [
                'error' => "You Do not have the permission to delete this User"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.users.index',[
            'users'=>User::all()
        ]);
    }
}
