<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;

class UsersModal extends ModalComponent
{
    public $user;
    public $userId, $userName, $userEmail, $userRoles = [];

    public $listeners = ['addRoles', 'editRoles'];

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount($user)
    {
        $user = User::find($user);
        if (!$user) $user = null;
        $this->user = $user;
        $this->userId = $user === null ? $user : $user->id;
        $this->userName = $user === null ? $user : $user->name;
        $this->userEmail = $user === null ? $user : $user->email;
        $this->userRoles = $user === null ? $user : $user->roles->pluck('id');
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function addRoles($id)
    {
        if ($this->userRoles === null) {
            $this->userRoles[] = $id;
        } else {
            $index = array_search($id, $this->userRoles);
            if ($index === true) {
                unset($this->userRoles[$index]);
            } else {
                $this->userRoles[] = $id;
            }
        }
    }

    public function editRoles($id)
    {
        if ($this->userRoles === null) {
            $this->userRoles[] = $id;
        } else {
            $roles = [];
            foreach ($this->userRoles as $key => $role) {
                if ($role === $id) {
                    unset($this->userRoles[$key]);
                }
                $roles[] = $role;
            }
            if (!in_array($id, $roles)) {
                $this->userRoles[] = $id;
            }
        }
    }

    public function addUser()
    {
        $user = User::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => bcrypt('secret')
        ]);
        $user->assignRole(Role::whereIn('id', $this->userRoles)->get());
        $this->closeModalWithEvents([
            Users::getName() => 'usersUpdated'
        ]);
    }

    public function editUser(User $user)
    {
        $user->update([
            'name' => $this->userName,
            'email' => $this->userEmail,
        ]);
        $user->roles()->detach();
        foreach ($this->userRoles as $role) {
            $user->assignRole(Role::find($role));
        }
        $this->closeModalWithEvents([
            Users::getName() => 'usersUpdated'
        ]);
    }


    public function render()
    {
        $currentRoles = [];
        if ($this->user) {
            $roles = $this->user->roles;
            foreach ($roles as $role) {
                array_push($currentRoles, $role->id);
            }
        }
        $roles = Role::all();
        return view('livewire.users-modal', [
            'user' => $this->user,
            'userRoles' => $this->userRoles,
            'roles' => $roles,
        ]);
    }
}