<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $roles, $roleSearch;
    public $listeners = [
        'rolesUpdated',
        'removeRole'
    ];

    public function mount()
    {
        $this->roles = Role::where('name', 'LIKE', '%' . $this->roleSearch . '%')->get();
    }

    public function rolesUpdated()
    {
        $this->roles = Role::all();
    }

    public function removeRole(Role $role)
    {
        $role->revokePermissionTo(Permission::all());
        $role->delete();
    }

    public function render()
    {
        $this->roles = Role::where('name', 'LIKE', '%' . $this->roleSearch . '%')->get();
        return view('livewire.roles', [
            'roles' => $this->roles
        ]);
    }
}