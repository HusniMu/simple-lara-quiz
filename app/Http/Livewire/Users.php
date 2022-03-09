<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users, $userSearch;
    public $listeners = [
        'usersUpdated',
        'removeUser'
    ];

    public function mount()
    {
        $this->users = User::where('name', 'LIKE', '%' . $this->userSearch . '%')->get();
    }

    public function usersUpdated()
    {
        $this->users = User::all();
    }

    public function removeUser(User $user)
    {
        $user->roles()->detach();
        $user->delete();
    }

    public function render()
    {
        $this->users = User::where('name', 'LIKE', '%' . $this->userSearch . '%')->get();
        return view('livewire.users', [
            'users' => $this->users
        ]);
    }
}
