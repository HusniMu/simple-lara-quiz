<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class RolesModal extends ModalComponent
{
    public $role;
    public $roleId, $roleName, $rolePermissions = [];

    public $listeners = ['addPermissions', 'editPermissions'];

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount($role)
    {
        $role = Role::find($role);
        if (!$role) $role = null;
        $this->role = $role;
        $this->roleId = $role === null ? $role : $role->id;
        $this->roleName = $role === null ? $role : $role->name;
        $this->rolePermissions = $role === null ? $role : $role->permissions->pluck('id');
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function addPermissions($id)
    {
        if ($this->rolePermissions === null) {
            $this->rolePermissions[] = $id;
        } else {
            $index = array_search($id, $this->rolePermissions);
            if ($index === true) {
                unset($this->rolePermissions[$index]);
            } else {
                $this->rolePermissions[] = $id;
            }
        }
    }

    public function editPermissions($id)
    {
        if ($this->rolePermissions === null) {
            $this->rolePermissions[] = $id;
        } else {
            $permissions = [];
            foreach ($this->rolePermissions as $key => $permission) {
                if ($permission === $id) {
                    unset($this->rolePermissions[$key]);
                }
                $permissions[] = $permission;
            }
            if (!in_array($id, $permissions)) {
                $this->rolePermissions[] = $id;
            }
        }
    }

    public function addRole()
    {
        $role = Role::create([
            'name' => $this->roleName
        ]);
        $role->givePermissionTo(Permission::whereIn('id', $this->rolePermissions)->get());
        $this->closeModalWithEvents([
            Roles::getName() => 'rolesUpdated'
        ]);
    }

    public function editRole(Role $role)
    {
        $role->update([
            'name' => $this->roleName
        ]);
        $role->revokePermissionTo(Permission::all());
        foreach ($this->rolePermissions as $permission) {
            $role->givePermissionTo(Permission::find($permission));
        }
        $this->closeModalWithEvents([
            Roles::getName() => 'rolesUpdated'
        ]);
    }

    public function render()
    {
        $currentPermissions = [];
        if ($this->role) {
            $permissions = $this->role->permissions;
            foreach ($permissions as $permission) {
                array_push($currentPermissions, $permission->id);
            }
        }
        $permissions = Permission::all();
        return view('livewire.roles-modal', [
            'role' => $this->role,
            'rolePermissions' => $this->rolePermissions,
            'permissions' => $permissions,
        ]);
    }
}